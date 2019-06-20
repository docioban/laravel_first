<?php

namespace App\Http\Controllers;

use App\Group;
use App\User;
use App\Legatura;
use Illuminate\Http\Request;
use DB;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(auth()->id());
        return view("pages.show_groups")->with('user', $user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("pages.create_group");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response2
     */
    public function store(Request $request)
    {
        $group = new Group();
        $group->name = $request->input('name');
        $group->save();
        User::find(auth()->id())->groups()->attach($group);
        return redirect('group')->with('success', 'Group was created');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $group = Group::find($id);
        return view('pages.show_group')->with('group', $group);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group = Group::find($id);
        $users = User::all();
        return view("pages.edit_group")->with('val', ['group' => $group, 'users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->has('email')) {
            $user = User::where('email', '=', $request->input('email'))->first();
            Group::find($id)->users()->attach($user);
            return redirect('group')->with('success', 'User was added');
        } else {
            Group::find($id)->users()->detach(auth()->id());
            if (count(Group::find($id)->users()->get()) == 0) {
                Group::destroy($id);
                return redirect('group')->with('success', 'You successful left the group and group was deleted');
            }
        return redirect('group')->with('success', 'You successful left the group');


        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $group = Group::find($id);
        $group->users()->detach();
        $group->delete();
        return redirect('group')->with('success', 'Group wad deleted');
    }
}
