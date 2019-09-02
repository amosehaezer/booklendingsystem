<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = DB::table('users')->get();
        return view('user.index', ['users' => $users]);
    }
    public function create()
    {
        return view('user.create');
    }
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request['password']);

        $user->save();
        return redirect('/user');
    }
    public function edit($id)
    {
        return view('');
    }
    public function update(Request $request)
    {
        
    }
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('user')->with('success', 'User deleted!');
    }
}
