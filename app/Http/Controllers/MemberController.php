<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Services\MemberService;
use Illuminate\Http\Request;

class MemberController extends Controller
{

    private $memberService;

    function __construct(MemberService $memberService)
    {
        $this->memberService = $memberService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->memberService->index($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->memberService->store($request);
    }

    /**

     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        return $this->memberService->show($member);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Member  $member
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Member $member, Request $request)
    {
        return $this->memberService->update($member, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Member $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        return $this->memberService->destroy($member);
    }
}
