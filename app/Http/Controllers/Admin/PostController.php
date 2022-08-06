<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

class PostController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::whereAdminId(\Auth::guard('admin')->user()->id)->get();

        return view('admin.posts.index', [ 'posts' => $posts ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // return view('admin.posts.edit', ['post' => $post ]);
        // dd($post);
        // // If check if the first method to check the authentication by if check admin guard
        // if(\Auth::guard('admin')->user()->id == $post->admin_id)
        // {
        //     return view('admin.posts.edit',['post'=>$post]);
        // }
        // abort(403);

        // // If check if the second method to check the authentication by admin guard post policy
        // if(\Auth::guard('admin')->user()->can('view', $post))
        // {
        //     return view('admin.posts.edit',['post'=>$post]);
        // }
        // abort(403);

        // // If check if the second method to check the authentication by admin guard post policy authorize 
        $this->authorize('view', $post);
        return view('admin.posts.edit',['post'=>$post]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);
        $post->update([
            'title' => $request->title,
            'description' => $request->description
        ]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
