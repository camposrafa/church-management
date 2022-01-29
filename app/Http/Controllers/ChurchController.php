<?php

namespace App\Http\Controllers;

use App\Models\Church;
use App\Services\ChurchService;
use Illuminate\Http\Request;

class ChurchController extends Controller
{
    private $churchService;

    function __construct(ChurchService $churchService)
    {
        $this->churchService = $churchService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->churchService->index($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->churchService->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  Church $Church
     * @return \Illuminate\Http\Response
     */
    public function show(Church $Church)
    {
        return $this->churchService->show($Church);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Church  $Church
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Church $Church, Request $request)
    {
        return $this->churchService->update($Church, $request);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  Church $Church
     * @return \Illuminate\Http\Response
     */
    public function destroy(Church $Church)
    {
        return $this->churchService->destroy($Church);
    }
}
