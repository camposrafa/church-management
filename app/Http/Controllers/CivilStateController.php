<?php

namespace App\Http\Controllers;

use App\Models\CivilState;
use App\Services\CivilStateService;
use Illuminate\Http\Request;

class CivilStateController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CivilStateService $civilStateService)
    {
        $this->civilStateService = $civilStateService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->civilStateService->index($request);
    }

    /**

     * @return \Illuminate\Http\Response
     */
    public function show(CivilState $civilState)
    {
        return $this->civilStateService->show($civilState);
    }
    //
}
