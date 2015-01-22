<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserController
 *
 * @author igor
 */
class UserController extends BaseController {
    
    protected $layout = 'layouts.master';
    
    public function __construct() {
        $this->beforeFilter('@filterRequests');
    }
    
    public function filterRequests($route, $request) {
        if(!Auth::check() && !$request->is('user/login')) {
            return Redirect::to('user/login');
        } else if(Auth::check() && $request->is('user/login')) {
            return Redirect::to('user');
        }
    }
    
    public function anyLogin() {
        if(Request::isMethod('post')) {
            if(Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('password')))) {
                Session::forget('login_error_message');
                return Redirect::to('/');
            } else {
                return Redirect::to('user/login')->with('login_error_message', 'Login or password is incorrect')->withInput(Input::except('password'));
            }
        }
        View::share('page_title', "Sign In");
        $this->layout->content = View::make('user.login-form');
        $this->layout->content->error_message = Session::get('login_error_message', '');
    }
    
    public function getLogout() {
        Auth::logout();
        return Redirect::to('/');
    }
    
    public function getIndex() {
        View::share('page_key', 'profile');
        View::share('page_title', "Hello my friend!");
        $this->layout = View::make('home');
        $this->layout->header = View::make('header');
        $this->layout->main_content = View::make('user.greeting');
        $this->layout->main_content->user = Auth::user();
    }
    
    public function getUpdateToken() {
        $comet_token = Auth::user()->createCometToken();
        Cookie::queue('comet_token', $comet_token);
        return Response::json(array('status' => TRUE));
    }
    
}
