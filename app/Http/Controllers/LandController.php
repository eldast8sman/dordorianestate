<?php

namespace App\Http\Controllers;

use App\Models\Land;
use App\Http\Resources\LandResource;
use App\Http\Requests\StoreLandRequest;
use App\Http\Requests\UpdateLandRequest;

class LandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return LandResource::collection(Land::orderBy('created_at', 'DESC'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLandRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLandRequest $request)
    {
        $land = Land::create($request->all());
        return new LandResource($land);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Land  $land
     * @return \Illuminate\Http\Response
     */
    public function show(Land $land, $id)
    {
        $land = Land::find($id);
        return new LandResource($land);
    }

    public function bySlug(Land $land, $slug)
    {
        $land = Land::where('slug', $slug)->first();
        return new LandResource($land);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Land  $land
     * @return \Illuminate\Http\Response
     */
    public function edit(Land $land)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLandRequest  $request
     * @param  \App\Models\Land  $land
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLandRequest $request, $id)
    {
        $land = Land::find_id($id);
        if($land){
            $land->update($request->all());
            return new LandResource($land);
        } else {
            return response('Land Not found', 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Land  $land
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $land = Land::find($id);
        if($land){
            $land->delete();
            return new LandResource($land);
        } else {
            return response("Land Not Found", 404);
        }
    }
}
