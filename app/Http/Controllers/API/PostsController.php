<?php

namespace App\Http\Controllers\API;

use App\Group;
use function foo\func;
use Illuminate\Http\Request;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::whereHas('users', function ($q) {
            $q->where('user_id', auth()->id());
        })->get();
        $users = User::whereHas('groups', function ($q) use ($groups) {
            $q->whereIn('id', $groups->pluck('id')->all());
        })->get();
        $posts = Post::where('active', 1)
            ->whereIn('user_id', $users->pluck('id'))
            ->orWhere('user_id', auth()->id())->get();
        return response()->json($posts);
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
                $q->where('name', 'post_make');
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
    public function store(Request $request)
    {
        $post = new Post();
        $post->titlu = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->id();
        if ( ! $request->has('activ'))
            $post->active = '0';
        else if ($request->has('activ') == true)
            $post->active = '1';
        else
            $post->active = '0';
        $post->save();
        return response()->json('Add Post with succes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return response()->json($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        if (Group::whereHas('users', function ($q){
                $q->where('user_id', auth()->id());
            })->whereHas('permissions', function ($q){
                $q->where('name', 'post_edit');
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
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $post->titlu = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->id();
        if ( ! $request->has('activ'))
            $post->active = '1';
        else
            $post->active = $request->input('activ');
        $post->save();
        return response()->json('Was modified by succesful');
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
                $q->where('name', 'post_delete');
            })->count() == 0)
            return response()->json(['permission' => 'false']);
        $post = Post::find($id);
        $post->delete();
        return response()->json(['message' => 'Was succesful deleted']);
    }
}
