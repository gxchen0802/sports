<?php

class TrainingsAttendeesController extends Controller {


    private $worker_id;

    public function __construct()
    {
        $this->worker_id = Input::get('worker_id');

        $this->beforeFilter('csrf', ['only' => ['store', 'search']]);   
    }

    public function index()
    {
        $records = TrainingsAttendees::join('trainings', 'trainings_attendees.training_id', '=', 'trainings.id')->select(
            'trainings_attendees.id', 
            'trainings_attendees.worker_id', 
            'trainings_attendees.status', 
            'trainings.title',
            'trainings.content',
            'trainings.date'
            // 'trainings.score'
            )->get();

        $trainings = Trainings::notDeleted()->lists('title', 'id');

        $data = [];

        $data['records']   = $records;
        $data['trainings'] = $trainings;

        return View::make('cms.trainingsattendees.index', $data);
    }


    public function approve($id)
    {
        // Auth::admin

        $record = TrainingsAttendees::find($id);

        if ($record->status == 'auditing')
        {
            $training = Trainings::find($record->training_id);

            User::where('worker_id', $record->worker_id)->increment('accumulated_scores', $training->score);

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
            return Redirect::to("trainings/{$training_id}?error=需要工号！");
        }

        if ( ! User::where('worker_id', $this->worker_id)->first())
        {
            return Redirect::to("trainings/{$training_id}?error=工号 {$this->worker_id} 不存在!");
        }

        $history = TrainingsAttendees::where('worker_id', $this->worker_id)->where('training_id', $training_id)->first();

        if ($history) 
            return Redirect::to("trainings/{$training_id}?error={$this->worker_id} 已经注册此培训!");

        TrainingsAttendees::create([
            'worker_id'   => $this->worker_id, 
            'training_id' => $training_id,
            ]);

        Trainings::where('id', $training_id)->decrement('seats_left');

        // Flash Data : http://www.golaravel.com/laravel/docs/4.2/responses/#redirects
        return Redirect::to("trainings/{$training_id}?success=注册成功")->with('message', 'register success!');
    }

    public function search()
    {
        $query = TrainingsAttendees::join('trainings', 'trainings_attendees.training_id', '=', 'trainings.id')->select(
            'trainings_attendees.id', 
            'trainings_attendees.worker_id', 
            'trainings_attendees.status', 
            'trainings.title',
            'trainings.content',
            'trainings.date'
            );

        if (Input::get('worker_id')) $query = $query->where('trainings_attendees.worker_id', Input::get('worker_id'));

        if (Input::get('training_id')) $query = $query->where('trainings_attendees.training_id', Input::get('training_id'));
        
        $records = $query->get();

        $trainings = Trainings::notDeleted()->lists('title', 'id');

        $data = [];

        $data['records']   = $records;
        $data['trainings'] = $trainings;

        return View::make('cms.trainingsattendees.index', $data);
    }

}
