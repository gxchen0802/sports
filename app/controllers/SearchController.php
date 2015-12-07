<?php

class SearchController extends Controller {

    private $worker_id;
    private $start_date;
    private $end_date;
    private $training_title;
    private $training_speaker;
    private $training_score;

    public function __construct()
    {
        // $this->worker_id        = Input::get('worker_id');
        $this->start_date       = Input::get('start_date');
        $this->end_date         = Input::get('end_date');
        $this->training_title   = Input::get('training_title');
        $this->training_speaker = Input::get('training_speaker');
        $this->training_score   = Input::get('training_score');

        $this->beforeFilter('csrf', ['only' => ['attendees']]);   
    }

    public function show($worker_id)
    {
        // Auth::check

        $data = ['worker_id' => $worker_id];

        return View::make('cms.search.show', $data); // return View('pages.about');
    }

    public function attendees($worker_id)
    {
        // Auth::check
        
        $query = TrainingsAttendees::join('trainings', 'trainings_attendees.training_id', '=', 'trainings.id')->where('trainings_attendees.worker_id', $worker_id);

        $query = $this->start_date ? $query->where('trainings.date', '>=', $this->start_date) : $query;

        $query = $this->end_date ? $query->where('trainings.date', '<=', $this->end_date) : $query;

        $query = $this->training_title ? $query->where('trainings.title', 'like', "%{$this->training_title}%") : $query;

        $records = $query->get();

        return $records;
    }

}
