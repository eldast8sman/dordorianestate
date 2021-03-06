<?php

namespace App\Http\Controllers;

use App\Models\Land;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use App\Http\Resources\LandResource;
use Illuminate\Support\Facades\File;
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
        $lands = Land::orderBy('created_at', 'DESC')->get();
        if(!empty($lands)){
            foreach($lands as $land){
                $land->filepath = url($land->filepath);
                $land->videos = $land->landVideos();
                $photos = $land->landPhotos();
                if(!empty($photos)){
                    foreach($photos as $photo){
                        $photo->filepath = url($photo->filepath);
                        $photo->compressed = url($photo->compressed);
                    }
                }
                $land->photos = $photos;
                $land->installments = $land->installments();
            }
            return response([
                'status' => 'success',
                'message' => 'Lands found successfully',
                'data' => $lands
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
        $all = $request->all();
        $image = $all['filepath'];
        unset($all['filepath']);
        if($image instanceof UploadedFile){
            $filename = Str::random().time();
            $extension = $image->getClientOriginalExtension();
            $filepath = $filename.".".$extension;
            $image->move(public_path('img'), $filepath);
            $all['filepath'] = 'img/'.$filepath;
        }
        $land = Land::create($all);
        if($land){
            $land->filepath = url($land->filepath);
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
            $land->videos = $land->landVideos()->get();
            $land->filepath = url($land->filepath);
            $photos = $land->landPhotos()->get();
            if(!empty($photos)){
                foreach($photos as $photo){
                    $photo->filepath = url($photo->filepath);
                    $photo->compressed = url($photo->compressed);
                }
            }
            $land->installments = $land->installments()->get();
            $land->photos = $photos;
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
            $land->videos = $land->landVideos()->get();
            $land->filepath = url($land->filepath);
            $photos = $land->landPhotos()->get();
            if(!empty($photos)){
                foreach($photos as $photo){
                    $photo->filepath = url($photo->filepath);
                    $photo->compressed = url($photo->compressed);
                }
            }
            $land->photos = $photos;
            $land->installments = $land->installments()->get();
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
        $land = Land::find($id);
        if($land){
            $all = $request->all();
            if(!empty($all['filepath'])){
                $image = $all['filepath'];
                unset($all['filepath']);
                if($image instanceof UploadedFile){
                    if(File::exists($land->filepath)){
                        File::delete($land->filepath);
                    }
                    $filename = Str::random().time();
                    $extension = $image->getClientOriginalExtension();
                    $filepath = $filename.".".$extension;
                    $image->move(public_path('img'), $filepath);
                    $all['filepath'] = 'img/'.$filepath;
                }
            } else {
                unset($all['filepath']);
            }
            if($land->update($all)){
                $land->filepath = url($land->filepath);
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
                if(File::exists($land->filepath)){
                    File::delete($land->filepath);
                }
                $videos = $land->landVideos();
                if(!empty($videos)){
                    foreach($videos as $video){
                        $video->delete();
                    }
                }
                $visits = $land->inspectionVisits();
                if(!empty($visits)){
                    foreach($visits as $visit){
                        $visit->delete();
                    }
                }
                $photos = $land->landPhotos();
                if(!empty($photos)){
                    foreach($photos as $photo){
                        $photo->delete();
                        if(File::exists($photo->filepath)){
                            File::delete($photo->filepath);
                        }
                        if(File::exists($photo->compressed)){
                            File::delete($photo->compressed);
                        }
                    }
                }
                $installments = $land->installments();
                if(!empty($installments)){
                    foreach($installments as $installment){
                        $installment->delete();
                    }
                }
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
