<?php

class TrainingsAttendeesController extends Controller {


    private $worker_id;

    public function __construct()
    {
        $this->worker_id = Input::get('worker_id');

        $this->beforeFilter('csrf', ['only' => ['store']]);   
    }

    public function index()
    {
        $records = TrainingsAttendees::join('trainings', 'trainings_attendees.training_id', '=', 'trainings.id')->select(
            'trainings_attendees.id', 
            'trainings_attendees.worker_id', 
            'trainings_attendees.status', 
            'trainings.title'
            // 'trainings.score'
            )->get();

        $data = [];

        $data['records'] = $records;

        return View::make('trainingsattendees.index', $data);
    }


    public function approve($id)
    {
        // Auth::admin

        $record = TrainingsAttendees::find($id);

        if ($record->status == 'auditing')
        {
            $training = Trainings::find($record->training_id);

            Workers::where('worker_id', $record->worker_id)->increment('accumulated_scores', $training->score);

            TrainingsAttendees::where('id', $id)->update(['status' => 'approved']);

            $message = 'Operation Successful';
        }
        else
        {
            $message = 'Already audited!';
        }

        return Redirect::back()->with('message', $message);
    }

    public function disapprove($id)
    {
        // Auth::admin

        $record = TrainingsAttendees::find($id);

        if ($record->status == 'auditing')
        {
            Trainings::where('id', $record->training_id)->increment('seats_left', 1);

            TrainingsAttendees::where('id', $id)->update(['status' => 'disapproved']);

            $message = 'Operation Successful';
        }
        else
        {
            $message = 'Already audited!';
        }

        return Redirect::back()->with('message', $message);
    }

    public function store($training_id)
    {
        if ( ! $this->worker_id) 
        {
            // Check for flash data :http://www.golaravel.com/laravel/docs/4.2/requests/
            return Redirect::to("trainings/{$training_id}")->with('message', 'Needs worker_id!');
        }

        if ( ! Workers::where('worker_id', $this->worker_id)->first())
        {
            return Redirect::to("trainings/{$training_id}")->with('message', 'No such worker_id found!');
        }

        $record = TrainingsAttendees::firstOrNew([
            'worker_id'   => $this->worker_id, 
            'training_id' => $training_id,
            ]);

        $record->save();

        Trainings::where('id', $training_id)->decrement('seats_left');

        // Flash Data : http://www.golaravel.com/laravel/docs/4.2/responses/#redirects
        return Redirect::to('trainings')->with('message', 'register success!');
    }

}
