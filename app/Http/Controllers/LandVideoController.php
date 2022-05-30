<?php

namespace App\Http\Controllers;

use App\Models\LandVideo;
use App\Http\Requests\StoreLandVideoRequest;
use App\Http\Requests\UpdateLandVideoRequest;

class LandVideoController extends Controller
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

    public function byLand($land_id){
        $videos = LandVideo::where('land_id', $land_id)->orderBy('created_at', 'asc')->get();
        if(!empty($videos)){
            return response([
                'status' => 'success',
                'message' => 'Videos fetched successfully',
                'data' => $videos
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Video was fetched for thia land',
                'data' => []
            ], 404);
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
     * @param  \App\Http\Requests\StoreLandVideoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLandVideoRequest $request)
    {
        $video =  LandVideo::create($request->all());
        if($video){
            return response([
                'status' => 'success',
                'message' => 'Land Video saved successfully',
                'data' => $video
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Land Video was not saved'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LandVideo  $landVideo
     * @return \Illuminate\Http\Response
     */
    public function show(LandVideo $landVideo, $id)
    {
        $video = LandVideo::where('id', $id)->first();
        if(!empty($video)){
            $video->land = $video->land();
            return response([
                'status' => 'success',
                'message' => 'Land Video fetched successfully',
                'data' => $video
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Land Video not found',
                'data' => []
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LandVideo  $landVideo
     * @return \Illuminate\Http\Response
     */
    public function edit(LandVideo $landVideo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLandVideoRequest  $request
     * @param  \App\Models\LandVideo  $landVideo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLandVideoRequest $request, $id)
    {
        $video = LandVideo::find($id);
        if($video->update($request->all())){
            return response([
                'status' => 'success',
                'message' => 'Land Video updated successfully',
                'data' => $video
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Land Video Update Failed',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LandVideo  $landVideo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $video = LandVideo::find($id);
        if($video->delete()){
            return response([
                'status' => 'success',
                'message' => 'Land Video deleted successfully',
                'data' => $video
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Land Video delete failed'
            ], 500);
        }
    }
}
