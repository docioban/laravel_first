<?php

namespace App\Http\Controllers\API;

use App\Group;
use App\Http\Requests\UserUpdateRequest;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\UserNewRequest;
use Illuminate\Support\Facades\Hash;

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
        return response()->json($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Group::whereHas('users', function ($q) {
                $q->where('user_id', auth()->id());
            })->whereHas('permissions', function ($q) {
                $q->where('name', 'user_make');
            })->count() == 0)
            return response()->json(['permission' => 'false']);
        return response()->json(['permission' => 'true']);
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
        $user->save();
        if ($groups = $request->input('groups'))
            foreach ($groups as $group)
                Group::find($group)->users()->attach($user);
        return response()->json('User was added with success');
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
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Group::whereHas('users', function ($q) {
                $q->where('user_id', auth()->id());
            })->whereHas('permissions', function ($q) {
                $q->where('name', 'user_edit');
            })->count() == 0)
            return response()->json(['permission' => 'false']);
        return response()->json(['permission' => 'true']);
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
        if ($request->input('password'))
            $user->password = Hash::make($request->input('password'));
        $user->groups()->detach();
        if ($groups = $request->input('groups'))
            foreach ($groups as $group)
                Group::find($group)->users()->attach($user);
        $user->save();
        return response()->json('User was update with success');
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
            return response()->json(['permission' => 'false']);
        $user = User::find($id);
        $user->groups()->detach();
        Post::where('user_id', $id)->delete();
        $user->delete();
        return response()->json(['message' => 'User was deleted by success']);
    }
}
