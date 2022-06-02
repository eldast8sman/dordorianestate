<?php

namespace App\Http\Controllers;

use App\Models\LandInstallment;
use App\Http\Requests\StoreLandInstallmentRequest;
use App\Http\Requests\UpdateLandInstallmentRequest;

class LandInstallmentController extends Controller
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
        $installments = LandInstallment::where('land_id', $land_id)
        ->orderBy('duration_type', 'asc')->orderBy('duration', 'asc')
        ->get();
        if(!empty($installments)){
            return response([
                'status' => 'success',
                'message' => 'Installments fetched',
                'data' => $installments
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Installment found',
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
     * @param  \App\Http\Requests\StoreLandInstallmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLandInstallmentRequest $request)
    {
        $installment = LandInstallment::create($request->all());
        if($installment){
            return response([
                'status' => 'success',
                'message' => 'Installment done successfully',
                'data' => $installment
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Error uploading Installment'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LandInstallment  $landInstallment
     * @return \Illuminate\Http\Response
     */
    public function show(LandInstallment $landInstallment, $id)
    {
        $installment = LandInstallment::where('id', $id)->first();
        if(!empty($installment)){
            return response([
                'status' => 'success',
                'message' => 'Installment found',
                'data' => $installment
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Installment found',
                'data' => []
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LandInstallment  $landInstallment
     * @return \Illuminate\Http\Response
     */
    public function edit(LandInstallment $landInstallment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLandInstallmentRequest  $request
     * @param  \App\Models\LandInstallment  $landInstallment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLandInstallmentRequest $request, $id)
    {
        $installment = LandInstallment::find($id);
        if($installment->update($request->all())){
            return response([
                'status' => 'success',
                'message' => 'Land Installment fetched',
                'data' => $installment
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Installment Update Failed',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LandInstallment  $landInstallment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $installment = LandInstallment::find($id);
        if($installment->delete()){
            return response([
                'status' => 'success',
                'message' => 'Installment delete success',
                'data' => $installment
            ], 200);
        } return response([
            'status' => 'failed',
            'message' => 'Installment Delete Failed'
        ], 500);
    }
}
