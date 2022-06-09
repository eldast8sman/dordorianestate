<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::orderBy('blog_date', 'desc')->orderBy('created_at', 'desc')->get();
        if(!empty($blogs)){
            foreach($blogs as $blog){
                $blog->filepath = url($blog->filepath);
                $blog->compressed = url($blog->compressed);
            }
            return response([
                'status' => 'success',
                'message' => 'Blog Posts found',
                'data' => $blogs
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No blog was fetched',
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
     * @param  \App\Http\Requests\StoreBlogRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogRequest $request)
    {
        $all = $request->all();
        if(!empty($all['filepath'])){
            $image = $all['filepath'];
            unset($all['filepath']);
            if($image instanceof UploadedFile){
                $filename = Str::random().time();
                $extension = $image->getClientOriginalExtension();
                $filepath = $filename.'.'.$extension;
                $image->move(public_path('img'), $filepath);
                $all['filepath'] = 'img/'.$filepath;
                $Image = Image::make($all['filepath']);
                $Image->resize(50, null, function($constraint){
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save(public_path('img/compressed/'.$filepath));
                $all['compressed'] = 'img/compressed/'.$filepath;
            }
        }
        $blog = Blog::create($all);
        if($blog){
            $blog->filepath = url($blog->filepath);
            $blog->compressed = url($blog->compressed);
            return response([
                'status' => 'success',
                'message' => 'Blog created successfully',
                'data' => $blog
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Blog Post Upload Failed',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog, $id)
    {
        $blog = Blog::where('id', $id)->first();
        if(!empty($blog)){
            if(!empty($blog->filepath)){
                $blog->filepath = url($blog->filepath);
                $blog->compressed = url($blog->compressed);
            }
            return response([
                'status' => 'success',
                'message' => 'Blog was fetched successfully',
                'data' => $blog
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Blog was not found'
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBlogRequest  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlogRequest $request, $id)
    {
        $blog = Blog::find($id);
        if(!empty($blog)){
            $all = $request->all();
            if(!empty($all['filepath'])){
                $image = $all['filepath'];
                unset($all['filepath']);
                if ($image instanceof UploadedFile) {
                    if (File::exists($blog->filepath)) {
                        File::delete($blog->filepath);
                    }
                    if (File::exists($blog->compressed)) {
                        File::delete($blog->compressed);
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
            if($blog->update($all)){
                $blog->filepath = url($blog->filepath);
                $blog->compressed = url($blog->compressed);
                return response([
                    'status' => 'success',
                    'message' => 'Blog updated successfully',
                    'data' => $blog
                ], 200);
            } else {
                return response([
                    'status' => 'failed',
                    'message' => 'There was an error in updating the Blog'
                ], 500);
            }
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Blog Photo was found',
                'data' => []
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog, $id)
    {
        $blog = Blog::find($id);
        if($blog->delete()){
            if(File::exists($blog->filepath)){
                File::delete($blog->filepath);
            }
            if(File::exists($blog->compressed)){
                File::delete($blog->compressed);
            }
            return response([
                'status' => 'success',
                'message' => 'Blog deleted successfully',
                'data' => $blog
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Blog was not successfully deleted'
            ], 500);
        }
    }
}
