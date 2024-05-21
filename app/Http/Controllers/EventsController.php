<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEventsRequest;
use App\Http\Requests\UpdateEventsRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Events;
use App\Models\Participants;
use App\Repositories\EventsRepository;
use Event;
use Illuminate\Http\Request;
use Flash;
use Ramsey\Uuid\Uuid;
use Maatwebsite\Excel\Facades\Excel; // excel export用
use App\Exports\ExcelExport; // excel export用
use Illuminate\Support\Facades\DB;

class EventsController extends AppBaseController
{
    /** @var EventsRepository $eventsRepository*/
    private $eventsRepository;

    public function __construct(EventsRepository $eventsRepo)
    {
        $this->eventsRepository = $eventsRepo;
    }

    /**
     * Display a listing of the Events.
     */
    public function index(Request $request)
    {
        $events = $this->eventsRepository->paginate(10);

        // イベント別人数カウント
        $participantCounts = Participants::selectRaw('event_id, count(*) as count')
            ->groupBy('event_id')
            ->get();

        return view('events.index')
            ->with(compact('events', 'participantCounts'));
    }

    /**
     * Show the form for creating a new Events.
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created Events in storage.
     */
    public function store(CreateEventsRequest $request)
    {
        $input = $request->all();

        // UUID生成
        $input['uuid'] = Uuid::uuid4();

        $events = $this->eventsRepository->create($input);

        Flash::success('イベントを登録しました');

        return redirect(route('events.index'));
    }

    /**
     * Display the specified Events.
     */
    public function show($id)
    {
        $events = Events::where('uuid', $id)->first();

        $members = Participants::where('event_id', $id)->get();

        $checkedInCount = $members->whereNotNull('checked_in_at')->count();
        $totalMembersCount = $members->count();

        if (empty($events)) {
            Flash::error('Events not found');
            return redirect(route('events.index'));
        }

        return view('events.show')->with(compact('events', 'checkedInCount', 'totalMembersCount'));
    }

    /**
     * Show the form for editing the specified Events.
     */
    public function edit($id)
    {
        $events = $this->eventsRepository->find($id);

        if (empty($events)) {
            Flash::error('Events not found');

            return redirect(route('events.index'));
        }

        return view('events.edit')->with('events', $events);
    }

    /**
     * Update the specified Events in storage.
     */
    public function update($id, UpdateEventsRequest $request)
    {
        $events = $this->eventsRepository->find($id);

        if (empty($events)) {
            Flash::error('Events not found');

            return redirect(route('events.index'));
        }

        $events = $this->eventsRepository->update($request->all(), $id);

        Flash::success('イベント情報を更新しました');

        return redirect(route('events.index'));
    }

    /**
     * Remove the specified Events from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $events = $this->eventsRepository->find($id);

        if (empty($events)) {
            Flash::error('Events not found');

            return redirect(route('events.index'));
        }

        // 関連する参加者削除
        $event_id = Events::where('id', $id)->value('uuid');
        DB::transaction(function () use ($event_id) {
            $members = Participants::where('event_id', $event_id)->get();
            $members->each->delete();
        });

        // イベント削除
        $this->eventsRepository->delete($id);

        Flash::success('イベントを削除しました');

        return redirect(route('events.index'));
    }


    public function checkin(Request $request)
    {
        if ($request->isMethod('get')) {
            $event = Events::where('uuid', $request['event_id'])->first();
            return view('checkin')->with(compact('event'));
        } elseif ($request->isMethod('post')) {
            $bsid = $request->input('bsid');

            // 受け取ったrequestの末尾11桁を取得
            $bsid = substr($bsid, -11);
            $event_id = $request['event_id'];

            // 対象者サーチ
            $user = Participants::where('bsid', $bsid)->where('event_id', $event_id)->first();
            if ($user) {
                if ($user->checked_in_at) {
                    Flash::warning($user->name . 'さん 重複チェックインです');
                    $event = Events::where('uuid', $event_id)->first();
                    return view('confirm')->with(compact('user', 'event'));
                } else {
                    $user->checked_in_at = now();
                    $user->save();
                    Flash::success($user->name . 'さんをチェックインしました');
                    $event = Events::where('uuid', $event_id)->first();
                    return view('confirm')->with(compact('user', 'event'));
                }
            } else {
                $event = Events::where('uuid', $event_id)->first();
                Flash::error('対象の登録番号が見つかりません ' . $bsid);
                return view('confirm')->with(compact('event'));
            }

            // try {
            //     $user = Participants::where('bsid', $bsid)->where('event_id', $event_id)->first();
            //     if ($user) {
            //         $user->checked_in_at = now();
            //         $user->save();
            //         if ($request->input('redirect') == 'true') {
            //             Flash::success($user->name . 'さんをチェックインしました');
            //             // return back();
            //             return view('checkin')->with(compact('user', 'event'));
            //         } else {
            //             $event = Events::where('uuid', $event_id)->first();
            //             return view('checkin')->with(compact('user', 'event'));
            //         }
            //     } else {
            //         $event = Events::where('uuid', $event_id)->first();
            //         Flash::error('対象の登録番号が見つかりません ' . $bsid);
            //         return view('checkin')->with(compact('event'));
            //     }
            // } catch (Exception $e) {
            //     // その他の例外が発生した場合の処理
            //     return back()->with('error', '予期せぬエラーが発生しました。')->withInput(request()->all());
            // }
        }
    }

    public function export_members(Request $request)
    {
        // イベントID取得
        $eventId = $request->input('event_id');

        // 対象イベント取得
        $event = Events::where('uuid', $eventId)->firstOrFail();
        $eventName = $event->name;
        $eventDate = $event->date->format('Y-m-d'); // format()

        // 参加者取得
        $members = Participants::where('event_id', $eventId)->get();

        // ファイル名指定
        $filename = 'QRチェックイン_' . $eventDate . '_' . $eventName . '.xlsx';

        // ヘッダー設定
        $headings = [
            'ID',
            '氏名',
            'フリガナ',
            '登録番号',
            '県連',
            '地区',
            '役務',
            '自由欄1',
            '自由欄2',
            '自由欄3',
            'チェックイン',
        ];

        //ExcelExportにデータを渡す
        return Excel::download(new ExcelExport($members, $headings), $filename);
    }
}
