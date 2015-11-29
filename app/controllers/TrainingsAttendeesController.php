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
        return TrainingsAttendees::all();
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
