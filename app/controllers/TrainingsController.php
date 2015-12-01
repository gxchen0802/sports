<?php

class TrainingsController extends Controller {


    // protected $layout = 'layouts.default';

    public function __construct()
    {
        $this->beforeFilter('csrf', ['only' => []]);   
    }


    // public function index()
    // {
    //     return Trainings::all();
    // }


    // public function store()
    // {
    //     Trainings::create(['title' => 'test title', 'content' => 'test content']);
    // }


    public function update()
    {
        Trainings::where('id', 2)->update(['title' => 'test title 2']);
    }


    public function show($id)
    {
        $training = Trainings::findOrFail($id);

        $data = ['training' => $training];

        return View::make('trainings.show', $data); // return View('pages.about');
        
        // $this->layout->content = View::make('pages.about');
        // echo $id;
    }
}
