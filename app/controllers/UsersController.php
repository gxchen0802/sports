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

    public function doLogin()
    {
        $worker_id = trim(Input::get('worker_id'));
        $password  = trim(Input::get('password'));
        $refer_url = trim(Input::get('refer'));

        $user = User::where('worker_id', $worker_id)->first();

        $password_encrypted = md5(md5($password).$user->salt);

        if ($user->password !== $password_encrypted) return Redirect::to("/login?error=Password incorrect.");

        Session::put('user_id', $user->id);
        Session::put('user_name', $user->worker_id);
        Session::put('user_role', $user->role);

        $redirect_url = $refer_url ? $refer_url : '/';

        return Redirect::to($redirect_url);
    }

    public function register()
    {
        $worker_id = trim(Input::get('worker_id'));
        $email     = trim(Input::get('email'));
        $name      = trim(Input::get('name'));
        $cellphone = trim(Input::get('cellphone'));
        $company   = trim(Input::get('company'));
        $refer_url = trim(Input::get('refer'));

        $check_exists = User::where('worker_id', $worker_id)->first();

        if ($check_exists) return Redirect::to("/login?error=User already exists.");

        $salt = str_random(10);

        $password_encrypted = md5(md5(Input::get('password')).$salt);

        $user = User::create([
            'email'     => $email,
            'worker_id' => $worker_id,
            'password'  => $password_encrypted,
            'salt'      => $salt,
            'name'      => $name,
            'cellphone' => $cellphone,
            'company'   => $company,
            ]); 

        Session::put('user_id', $user->id);

        $redirect_url = $refer_url ? $refer_url : '/';

        return Redirect::to($redirect_url);
    }

    public function login()
    {
        $data = [];
    
        return View::make('pages.login', $data);
    }

    public function logout()
    {
        Session::flush();

        return Redirect::to('/');
    }

    public function lists()
    {
        $data['users'] = User::all();

        return View::make('cms.users.list', $data);
    }
}
