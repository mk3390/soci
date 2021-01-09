<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use Illuminate\Http\Request;

class FollowingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            $follow = New Follow();
            $follow->followed_by = auth()->user()->id;
            $follow->following_to = $request->user_id;
            $follow->save();
            $success['data'] = $follow;
            $success['success'] = true;
            $success['message'] = "Follow Created";
            return $this->sendResponse($success);
        } catch (\Exception $e) {
            $success['success'] = false;
            $success['error'] = "Error to create follow";
            return $this->sendResponse($success, 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Follow  $follow
     * @return \Illuminate\Http\Response
     */
    public function show(Follow $follow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Follow  $follow
     * @return \Illuminate\Http\Response
     */
    public function edit(Follow $follow)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Follow  $follow
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Follow $follow)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Follow  $follow
     * @return \Illuminate\Http\Response
     */
    public function destroy(Follow $follow)
    {
        //
    }

    public function approve(Request $request)
    {
        try {
            $follow = Follow::find($request->id);
            $follow->status = 1;
            $follow->save();
            $success['data'] = $follow;
            $success['success'] = true;
            $success['message'] = "Following request Approved";
            return $this->sendResponse($success);
        } catch (\Exception $e) {
            $success['success'] = false;
            $success['error'] = "Error to approved request";
            return $this->sendResponse($success, 401);
        }
    }

    public function reject(Request $request)
    {
        try {
            $follow = Follow::find($request->id);
            $follow->status = 2;
            $follow->save();
            $success['data'] = $follow;
            $success['success'] = true;
            $success['message'] = "Following request Rejected";
            return $this->sendResponse($success);
        } catch (\Exception $e) {
            $success['success'] = false;
            $success['error'] = "Error to reject request";
            return $this->sendResponse($success, 401);
        }
    }
}
