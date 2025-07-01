<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\OfficeSpaceResource;
use App\Models\OfficeSpace;
use Illuminate\Http\Request;

class OfficeSpaceController extends Controller
{
    public function index()
    {
        $officeSpaces = OfficeSpace::with(['city'])->get();
        return OfficeSpaceResource::collection($officeSpaces); //jika menampilkan banyak data
    }

    public function show($slug)
    {
        $officeSpace = OfficeSpace::with(['city', 'photos', 'benefits'])->where('slug', $slug)->first();
        return new OfficeSpaceResource($officeSpace); //hanya menampilkan 1 data 
    }
}
