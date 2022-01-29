<?php

namespace App\Http\Controllers;

use App\Models\Occupation;
use App\Services\OccupationService;
use Illuminate\Http\Request;

class OccupationController extends Controller
{
    private $occupationService;

    function __construct(OccupationService $occupationService)
    {
        $this->occupationService = $occupationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->occupationService->index($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->occupationService->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  Occupation $occupation
     * @return \Illuminate\Http\Response
     */
    public function show(Occupation $occupation)
    {
        return $this->occupationService->show($occupation);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Occupation  $occupation
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Occupation $occupation, Request $request)
    {
        return $this->occupationService->update($occupation, $request);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  Occupation $occupation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Occupation $occupation)
    {
        return $this->occupationService->destroy($occupation);
    }
}
