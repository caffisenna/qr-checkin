<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateParticipantsRequest;
use App\Http\Requests\UpdateParticipantsRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Participants;
use App\Models\Events;
use App\Repositories\ParticipantsRepository;
use Illuminate\Http\Request;
use Flash;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ParticipantImport;
use Event;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ParticipantsController extends AppBaseController
{
    /** @var ParticipantsRepository $participantsRepository*/
    private $participantsRepository;

    public function __construct(ParticipantsRepository $participantsRepo)
    {
        $this->participantsRepository = $participantsRepo;
    }

    /**
     * Display a listing of the Participants.
     */
    public function index(Request $request)
    {
        $event_id = $request['event_id'];
        if (isset($event_id)) {
            $participants = Participants::where('event_id', $event_id)->with('event')->get();
        } else {
            // whereHas('event') で relationのeventを持つ参加者レコードのみを引っ張るように修正
            $participants = Participants::whereHas('event')->with('event')->get();
        }

        // $events = Events::all();

        return view('participants.index')
            ->with(compact('participants'));
    }

    /**
     * Show the form for creating a new Participants.
     */
    public function create()
    {
        $events = Events::all();
        return view('participants.create')->with(compact('events'));
    }

    /**
     * Store a newly created Participants in storage.
     */
    public function store(CreateParticipantsRequest $request)
    {
        $input = $request->all();

        // UUID生成
        $input['uuid'] = Uuid::uuid4();

        $participants = $this->participantsRepository->create($input);

        Flash::success('参加者を登録しました');

        return redirect(route('participants.index'));
    }

    /**
     * Display the specified Participants.
     */
    public function show($id)
    {
        // $participants = $this->participantsRepository->find($id);
        $participants = Participants::where('uuid', $id)->with('event')->first();

        if (empty($participants)) {
            Flash::error('Participants not found');

            return redirect(route('participants.index'));
        }

        return view('participants.show')->with('participants', $participants);
    }

    /**
     * Show the form for editing the specified Participants.
     */
    public function edit($id)
    {
        $participants = $this->participantsRepository->find($id);

        if (empty($participants)) {
            Flash::error('Participants not found');

            return redirect(route('participants.index'));
        }

        $events = Events::all();

        return view('participants.edit')->with(compact('participants', 'events'));
    }

    /**
     * Update the specified Participants in storage.
     */
    public function update($id, UpdateParticipantsRequest $request)
    {
        $participants = $this->participantsRepository->find($id);

        if (empty($participants)) {
            Flash::error('Participants not found');

            return redirect(route('participants.index'));
        }

        $participants = $this->participantsRepository->update($request->all(), $id);

        Flash::success('参加者を更新しました');

        return redirect(route('participants.index'));
    }

    /**
     * Remove the specified Participants from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $participants = $this->participantsRepository->find($id);

        if (empty($participants)) {
            Flash::error('Participants not found');

            return redirect(route('participants.index'));
        }

        $this->participantsRepository->delete($id);

        Flash::success('参加者を削除しました');

        return redirect(route('participants.index'));
    }

    public function upload_view(Request $request)
    {
        // upload画面に遷移
        $uuid = $request['event_id'];

        // イベント名、uuidを取得してviewに渡す
        $event = Events::where('uuid', $uuid)->first();

        return view('upload')->with(compact('event'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv|max:2048', // Assuming max file size is 2MB
        ]);

        // Save uploaded file
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('uploads', $fileName);

        // Process uploaded file
        $filePath = storage_path('app/uploads/' . $fileName);
        $data = $this->parseFile($filePath);

        // Insert records into database
        foreach ($data as $input) {
            $input['uuid'] = Uuid::uuid4()->toString(); // Generate UUID
            $input['event_id'] = $request['event_id'];
            Participants::create($input);
        }

        Flash::success('参加者を登録しました。当該イベントの参加者一覧で確認してください');
        return redirect()->back();
    }

    private function parseFile($filePath)
    {
        $data = [];
        // Assuming first row contains headers
        $headers = ['name', 'furigana', 'bsid', 'prefecture', 'district', 'role', 'field1', 'field2', 'field3'];

        $spreadsheet = IOFactory::load($filePath);
        $worksheet = $spreadsheet->getActiveSheet();

        foreach ($worksheet->getRowIterator() as $row) {
            $rowData = [];
            foreach ($row->getCellIterator() as $cell) {
                $rowData[] = $cell->getValue();
            }
            // Fill missing values with null to ensure equal length of $headers and $rowData
            $filledRow = array_pad($rowData, count($headers), null);
            $data[] = array_combine($headers, $filledRow);
        }

        return $data;
    }

    public function revert(Request $request)
    {
        // チェックイン取消処理
        $input = $request->all();

        $id = $input['id'];
        $event_id = $input['event_id'];
        $person = Participants::where('bsid', $id)->where('event_id', $event_id)->firstOrFail();

        if ($person) {
            // チェックインを初期化
            $person->checked_in_at = null;
            $person->save();

            $event = Events::where('uuid', $event_id)->first();

            flash::success($person->name . 'さんのチェックインを取り消しました');
            return view('checkin')->with(compact('event'));
        } else {
            dd('not found');
        }
    }

    public function confirm(Request $request)
    {
        dd($request);
    }
}
