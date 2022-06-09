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
        $videos = LandVideo::where('land_id', $land_id)->orderBy('created_at', 'asc');
        if($videos->count() > 0){
            return response([
                'status' => 'success',
                'message' => 'Videos fetched successfully',
                'data' => $videos->get()
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Video was fetched for this land',
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
        $all = $request->all();
        $all['output_link'] = $this->output_link($all['platform'], $all['link']);
        $video =  LandVideo::create($all);
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
        $all = $request->all();
        if(!empty($all['link'])){
            $all['output_link'] = $this->output_link($all['platform'], $all['link']);
        }
        if($video->update($all)){
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

    public function output_link($platform, $link){
        $platform = strtolower($platform);
        if($platform == "youtube"){
            $extract = substr($link, 17);
            $output = "https://youtube.com/embed/".$extract;
        } else {
            $output = "";
        }
        return $output;
    }
}
