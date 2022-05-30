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
        $lands = Land::orderBy('created', 'DESC');
        if($lands->count() > 0){
            return response([
                'status' => 'success',
                'message' => 'Lands found successfully',
                'data' => $lands->get()
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Land found',
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
        if($land){
            return response([
                'status' => 'success',
                'message' => 'Land Created successfully',
                'data' => $land
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Error in Land Creation'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Land  $land
     * @return \Illuminate\Http\Response
     */
    public function show(Land $land, $id)
    {
        $land = Land::where('id', $id)->first();
        if(!empty($land)){
            return response([
                'status' => 'success',
                'message' => 'Land found successfully',
                'data' => $land
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Land Not Found'
            ], 404);
        }
    }

    public function bySlug(Land $land, $slug)
    {
        $land = Land::where('slug', $slug)->first();
        if(!empty($land)){
            return response([
                'status' => 'success',
                'message' => 'Land found successfully',
                'data' => $land
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Land Not Found'
            ], 404);
        }
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
            if($land->update($request->all())){
                return response([
                    'status' => 'success',
                    'message' => 'Land updated successfully',
                    'data' => $land
                ], 200);
            } else {
                return response([
                    'status' => 'failed',
                    'message' => 'Land Update failed'
                ], 500);
            }
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Land Not found'
            ], 404);
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
            if($land->delete()){
                return response([
                    'status' => 'success',
                    'message' => 'Land Delete Successful',
                    'data' => $land
                ]);
            } else {
                return response([
                    'status' => 'failed',
                    'message' => 'Land Delete failed'
                ], 500);
            }
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Land was found'
            ], 404);
        }
    }
}
