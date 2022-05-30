<?php

namespace App\Http\Controllers;

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
     * @param  \App\Http\Requests\StoreInspectionVisitRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInspectionVisitRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InspectionVisit  $inspectionVisit
     * @return \Illuminate\Http\Response
     */
    public function show(InspectionVisit $inspectionVisit)
    {
        //
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
    public function update(UpdateInspectionVisitRequest $request, InspectionVisit $inspectionVisit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InspectionVisit  $inspectionVisit
     * @return \Illuminate\Http\Response
     */
    public function destroy(InspectionVisit $inspectionVisit)
    {
        //
    }
}
