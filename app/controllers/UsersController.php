<?php

class UsersController extends Controller {


    public function __construct()
    {
        $this->beforeFilter('csrf', ['only' => []]);   
    }


    public function index()
    {
        return User::all();
    }


    public function register()
    {

    }

    public function login()
    {
        
    }

    public function store()
    {
        User::create(['email' => 'test@email.com', 'username' => 'test username']);
    }


    public function update()
    {
        // User::where('id', 2)->update(['title' => 'test title 2']);
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
