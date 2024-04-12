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
            $participants = Participants::where('event_id', $event_id)->get();
        } else {
            $participants = $this->participantsRepository->paginate(100);
        }

        $events = Events::all();

        return view('participants.index')
            ->with(compact('participants', 'events'));
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
        $participants = Participants::where('uuid', $id)->first();

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

        return view('participants.edit')->with('participants', $participants);
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
}
