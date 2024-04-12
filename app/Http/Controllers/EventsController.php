<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEventsRequest;
use App\Http\Requests\UpdateEventsRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Events;
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

        return view('events.index')
            ->with('events', $events);
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
        // $events = $this->eventsRepository->find($id);
        $events = Events::where('uuid', $id)->first();

        if (empty($events)) {
            Flash::error('Events not found');

            return redirect(route('events.index'));
        }

        return view('events.show')->with('events', $events);
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
}
