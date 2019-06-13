<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;
use App\Post;
use App\User;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$groups = Group::find(1);//Group::with('users')->whereId(auth()->id())->get();
        $users = Group::find(1)->users()->where('user_id', auth()->id())->get();
        foreach ($users as $user) {
            print_r($user->name);
        }
        $posts = User::find(1)->post()->whereIn('user_id', $users)->get();
        foreach ($posts as $post) {
            print_r($post);
        }
        return view('pages.posts')->with('posts', $posts);
//        exit;
//        $users = array();
//        $posts = array();
////        foreach (Group::with('users')->get() as $group)
////            foreach ($group->users as $user)
////                $users[] = $user->id;
//        $users = array_unique($users);
//        foreach($users as $user)
//            foreach (Post::find(1)->user()->where('id', $user)->get() as $post)
//                if($post->user()->id == auth()->id() or $post->active == 1)
//                    $posts[] = $post;
//        return view('pages.posts')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.new_post')->with('success', 'Post was created');
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
        if ( ! $request->has('activ'))
            $post->active = '0';
        else if ($request->has('activ') == true)
            $post->active = '1';
        else
            $post->active = '0';
        User::find(auth()->id())->post()->save($post);
        $post->save();
        return redirect('/posts')->with('success', 'Add Post with succes');
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
        return view('pages.post_show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        if ($post->user()->id == auth()->id())
            return view('pages.post_edit')->with('post', $post);
        else
            return redirect('posts')->with('error', 'You can not edit another post');
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
        if ( ! $request->has('activ'))
            $post->active = '1';
        else
            $post->active = $request->input('activ');
        $post->save();
        return redirect('/posts')->with('success', 'Was modified by succesful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect('/posts')->with('success', 'Was succesful deleted');
    }
}
