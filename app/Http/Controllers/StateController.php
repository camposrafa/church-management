<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Services\StateService;
use Illuminate\Http\Request;

class StateController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(StateService $stateService)
    {
        $this->stateService = $stateService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->stateService->index($request);
    }

    /**

     * @return \Illuminate\Http\Response
     */
    public function show(State $state)
    {
        return $this->stateService->show($state);
    }
    //
}
