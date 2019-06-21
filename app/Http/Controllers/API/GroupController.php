<?php

namespace App\Http\Controllers\API;

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
        $groups = Group::with('users')->whereId(auth()->id())->paginate();
        return response()->json($groups);
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
                $q->where('name', 'group_make');
            })->count() == 0)
            return response()->json(['permission' => 'false']);
        return response()->json(['permission' => 'true']);
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
        return response()->json($group);
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
        return response()->json($group);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Group::whereHas('users', function ($q){
                $q->where('user_id', auth()->id());
            })->whereHas('permissions', function ($q){
                $q->where('name', 'group_edit');
            })->count() == 0)
            return response()->json(['permission' => 'false']);
        return response()->json(['permission' => 'true']);
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
        $group = Group::find($id);
        $group->name = $request->input('name');
        $group->save();
        return response()->json($group);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Group::whereHas('users', function ($q){
                $q->where('user_id', auth()->id());
            })->whereHas('permissions', function ($q){
                $q->where('name', 'group_delete');
            })->count() == 0)
            return response()->json(['permission' => 'false']);
        $group = Group::find($id);
        $group->users()->detach();
        $group->permissions()->detach();
        $group->delete();
        return response()->json(['message' => 'Group was deleted']);
    }
}
