<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;




class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function getSendersList()
{
    $list = User::where('id', '!=', Auth::user()->id)->get();
    return $data = array('status' => 'success', 'message' => 'List got successfully', 'data' => $list);

}

}
