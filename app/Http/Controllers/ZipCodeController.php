<?php

namespace App\Http\Controllers;

use App\Models\ZipCode;
use App\Services\ZipCodeService;
use Illuminate\Http\Request;

class ZipCodeController extends Controller
{

    private $zipCode;

    function __construct(ZipCodeService $zipCode)
    {
        $this->zipCode = $zipCode;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function findZipCode($cep)
    {
        return $this->zipCode->findZipCode($cep);
    }
}
