<?php

class UsersController extends Controller {


    public function __construct()
    {
        $this->beforeFilter('csrf', ['only' => ['signin', 'register']]);   
    }


    // public function index()
    // {
    //     return User::all();
    // }

    public function signin()
    {

    }

    public function register()
    {

    }

    public function login()
    {
        $data = [];
        
        return View::make('pages.login', $data);
    }
}
