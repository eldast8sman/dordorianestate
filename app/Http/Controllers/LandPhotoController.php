<?php

namespace App\Http\Controllers;

use App\Models\LandPhoto;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\Http\Requests\StoreLandPhotoRequest;
use App\Http\Requests\UpdateLandPhotoRequest;

class LandPhotoController extends Controller
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
        $photos = LandPhoto::where('land_id', $land_id)->orderBy('created_at', 'asc')->get();
        if(!empty($photos)){
            foreach($photos as $photo){
                $photo->filepath = url($photo->filepath);
                $photo->compressed = url($photo->compressed);
            }
            return response([
                'status' => 'success',
                'message' => 'Photos fetched successfully',
                'data' => $photos
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Photo was fetched for thia land',
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
     * @param  \App\Http\Requests\StoreLandPhotoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLandPhotoRequest $request)
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
            //Using Image Intervention to Resize Image and save it to Compressed
            $Image = Image::make($all['filepath']);
            $Image->resize(50, null, function($constraint){
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save(public_path('img/compressed/'.$filepath));
            $all['compressed'] = 'img/compressed/'.$filepath;

            $photo = LandPhoto::create($all);
            if($photo){
                $photo->filepath = url($photo->filepath);
                $photo->compressed = url($photo->compressed);
                return response([
                    'status' => 'success',
                    'message' => 'Land Photo Uploaded successfully',
                    'data' => $photo
                ], 200);
            } else {
                return response([
                    'status' => 'failed',
                    'message' => 'Error in uploading Photo'
                ], 500);
            }
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Not an Uploaded File'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LandPhoto  $landPhoto
     * @return \Illuminate\Http\Response
     */
    public function show(LandPhoto $landPhoto, $id)
    {
        $photo = LandPhoto::where('id', $id)->first();
        if(!empty($photo)){
            $photo->filepath = url($photo->filepath);
            $photo->compressed = url($photo->compressed);
            return response([
                'status' => 'success',
                'message' => 'Land Photo fetched successfully',
                'data' => $photo
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Land Photo was not found'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LandPhoto  $landPhoto
     * @return \Illuminate\Http\Response
     */
    public function edit(LandPhoto $landPhoto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLandPhotoRequest  $request
     * @param  \App\Models\LandPhoto  $landPhoto
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLandPhotoRequest $request, $id)
    {
        $photo = LandPhoto::find($id);
        if(!empty($photo)){
            $all = $request->all();
            if(!empty($all['filepath'])){
                $image = $all['filepath'];
                unset($all['filepath']);
                if ($image instanceof UploadedFile) {
                    if (File::exists($photo->filepath)) {
                        File::delete($photo->filepath);
                    }
                    if (File::exists($photo->compressed)) {
                        File::delete($photo->compressed);
                    }
                    $filename = Str::random().time();
                    $extension = $image->getClientOriginalExtension();
                    $filepath = $filename.".".$extension;
                    $image->move(public_path('img'), $filepath);
                    $all['filepath'] = 'img/'.$filepath;
                    $Image = Image::make($all['filepath']);
                    $Image->resize(50, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })->save(public_path('img/compressed/'.$filepath));
                    $all['compressed'] = 'img/compressed/'.$filepath;
                }
            } else {
                unset($all['filepath']);
            }
            if($photo->update($all)){
                $photo->filepath = url($photo->filepath);
                $photo->compressed = url($photo->compressed);
                return response([
                    'status' => 'success',
                    'message' => 'Land Photo updated successfully',
                    'data' => $photo
                ], 200);
            } else {
                return response([
                    'status' => 'failed',
                    'message' => 'There was an error in updating the Photo'
                ], 500);
            }
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Land Photo was found',
                'data' => []
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LandPhoto  $landPhoto
     * @return \Illuminate\Http\Response
     */
    public function destroy(LandPhoto $landPhoto, $id)
    {
        $photo = LandPhoto::find($id);
        if($photo->delete()){
            if(File::exists($photo->filepath)){
                File::delete($photo->filepath);
            }
            if(File::exists($photo->compressed)){
                File::delete($photo->compressed);
            }
            return response([
                'status' => 'success',
                'message' => 'Land Photo deleted successfully',
                'data' => $photo
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Land Photo was not successfully deleted'
            ], 500);
        }
    }
}
