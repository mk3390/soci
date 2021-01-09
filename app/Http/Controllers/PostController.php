<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $post = auth()->user()->timeline->getAllPost();
            $success['data'] = $post;
            $success['success'] = true;
            $success['message'] = "Successfully logged out.";
            return $this->sendResponse($success);
        } catch (\Exception $e) {
            $success['success'] = false;
            $success['error'] = "Successfully logged out.";
            return $this->sendResponse($success, 401);
        }
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
        try {
            $post = New Post();
            $post->validate($request);
            $post->store();
            $success['data'] = $post;
            $success['success'] = true;
            $success['message'] = "Post Created";
            return $this->sendResponse($success);
        } catch (\Exception $e) {
            $success['success'] = false;
            $success['error'] = "Error to create post";
            return $this->sendResponse($success, 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
