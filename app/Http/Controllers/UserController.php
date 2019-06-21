<?php

namespace App\Http\Controllers;

use App\Group;
use App\Http\Requests\UserUpdateRequest;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\UserNewRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('pages/index_users')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Group::whereHas('users', function ($q){
                $q->where('user_id', auth()->id());
            })->whereHas('permissions', function ($q){
                $q->where('name', 'user_make');
            })->count() == 0)
            return redirect('user')->with('error', 'You can not make an user');
        $groups = Group::all();
        return view('pages/user_create')->with('groups', $groups);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(UserNewRequest $request)
    {
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->age = $request->input('age');
        $user->password = Hash::make($request->input('password'));
        $user->api_token = Str::random(60);
        $user->save();
        if ($groups = $request->input('groups'))
            foreach ($groups as $group)
                Group::find($group)->users()->attach($user);
        return redirect('user')->with('success', 'User was added with success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('pages/user_show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Group::whereHas('users', function ($q){
                $q->where('user_id', auth()->id());
            })->whereHas('permissions', function ($q){
                $q->where('name', 'user_edit');
            })->count() == 0)
            return redirect('user')->with('error', 'You can not edit an user');
        $user = User::find($id);
        $groups = Group::all();
        return view('pages/user_edit')->with('user_groups', ['user' => $user, 'groups' => $groups]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->age = $request->input('age');
        $user->password = Hash::make($request->input('password'));
        $user->groups()->detach();
        if ($groups = $request->input('groups'))
            foreach ($groups as $group)
                Group::find($group)->users()->attach($user);
        $user->save();
        return redirect('user')->with('success', 'User was updated with success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Group::whereHas('users', function ($q){
                $q->where('user_id', auth()->id());
            })->whereHas('permissions', function ($q){
                $q->where('name', 'user_make');
            })->count() == 0)
            return redirect('user')->with('error', 'You can not delete an user');
        $user = User::find($id);
        $user->groups()->detach();
        Post::where('user_id', $id)->delete();
        $user->delete();
        return redirect('user')->with('success', 'User was deleted by success');
    }
}
