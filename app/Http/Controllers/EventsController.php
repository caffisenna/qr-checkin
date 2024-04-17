<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEventsRequest;
use App\Http\Requests\UpdateEventsRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Events;
use App\Models\Participants;
use App\Repositories\EventsRepository;
use Illuminate\Http\Request;
use Flash;
use Ramsey\Uuid\Uuid;

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
            $bsid = substr($bsid, -11);
            dd($bsid);
            $event_id = $request['event_id'];

            // 対象者サーチ
            $user = Participants::where('bsid', $bsid)->where('event_id', $event_id)->firstorfail();
            if ($user) {
                $user->checked_in_at = now();
                $user->save();
                if (($request['redirect'] == 'true')) {
                    Flash::success($user->name . 'さんをチェックインしました');
                    return back();
                } else {
                    $event = Events::where('uuid', $event_id)->first();
                    return view('checkin')->with(compact('user', 'event'));
                }
            }
        }
    }
}
