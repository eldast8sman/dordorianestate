<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InspectionVisit;
use App\Http\Requests\StoreInspectionVisitRequest;
use App\Http\Requests\UpdateInspectionVisitRequest;

class InpectionVisitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = date('Y-m-d');
        $visits = InspectionVisit::where('inspection_date', '>=', $today)
        ->orderBy('inspection_date', 'asc')
        ->orderBy('inspection_time', 'asc')
        ->orderBy('created_at', 'asc');
        if($visits->count() > 0){
            return response([
                'status' => 'success',
                'message' => 'Upcoming Inspections fetched successfully',
                'data' => $visits->get()
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'There are no Upcoming Inspections',
                'data' => []
            ], 404);
        }
    }

    public function previousInspections(){
        $today = date('Y-m-d');
        $visits = InspectionVisit::where('inspection_date', '<', $today)
        ->orderBy('inspection_date', 'desc')
        ->orderBy('inspection_time', 'desc')
        ->orderBy('created_at', 'desc');
        if($visits->count() > 0){
            return response([
                'status' => 'success',
                'message' => 'Previous Inspections fetched successfully',
                'data' => $visits->get()
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'There are no Previous Inspections',
                'data' => []
            ], 404);
        }
    }

    public function upcomingByLand($land_id){
        $today = date('Y-m-d');
        $visits = InspectionVisit::where('land_id', $land_id)
        ->where('inspection_date', '>=', $today)
        ->orderBy('inspection_date', 'asc')
        ->orderBy('inspection_time', 'asc')
        ->orderBy('created_at', 'asc');
        if($visits->count){
            return response([
                'status' => 'success',
                'message' => 'Upcoming Inspections fetched successfully',
                'data' => $visits->get()
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'There are no Upcoming Inspections',
                'data' => []
            ], 404);
        }
    }

    public function previousByLand($land_id){
        $today = date('Y-m-d');
        $visits = InspectionVisit::where('land_id', $land_id)
        ->where('inspection_date', '<', $today)
        ->orderBy('inspection_date', 'desc')
        ->orderBy('inspection_time', 'desc')
        ->orderBy('created_at', 'desc');
        if($visits->count){
            return response([
                'status' => 'success',
                'message' => 'Previous Inspections fetched successfully',
                'data' => $visits->get()
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'There are no Previous Inspections',
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
     * @param  \App\Http\Requests\StoreInspectionVisitRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInspectionVisitRequest $request)
    {
        $inspection = InspectionVisit::create($request->all());
        if($inspection){
            return response([
                'status' => 'success',
                'message' => 'Inspection Visit Created successfully',
                'data' => $inspection
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Error in creating Inspection Visits'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InspectionVisit  $inspectionVisit
     * @return \Illuminate\Http\Response
     */
    public function show(InspectionVisit $inspectionVisit, $id)
    {
        $visit = InspectionVisit::where('id', $id)->first();
        if($visit){
            return response([
                'status' => 'success',
                'message' => 'Inspection Visit Found successfully',
                'data' => $visit
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Inspection Visit was fetched'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InspectionVisit  $inspectionVisit
     * @return \Illuminate\Http\Response
     */
    public function edit(InspectionVisit $inspectionVisit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInspectionVisitRequest  $request
     * @param  \App\Models\InspectionVisit  $inspectionVisit
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInspectionVisitRequest $request, $id)
    {
        $visit = InspectionVisit::find($id);
        if($visit){
            if($visit->update($request->all())){
                return response([
                    'status' => 'success',
                    'message' => 'Inspection Visit updated successfully',
                    'data' => $visit
                ], 200);
            } else {
                return response([
                    'status' => 'failed',
                    'message' => 'There was an Error in updating Inspection Visit'
                ], 500);
            }
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Inspection Visit was not fetched'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InspectionVisit  $inspectionVisit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $visit = InspectionVisit::find($id);
        if($visit->delete()){

        } else {
            return response([
                'status' => 'failed',
                'message' => 'Error in deleting Inspection Visit',
                'data' => $visit
            ], 500);
        }
    }
}
