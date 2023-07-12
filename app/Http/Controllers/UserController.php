<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('admin');
        return view('users.index', [
            'title' => 'Data Pengguna',
            'users' => User::all()
        ]);
    }
}