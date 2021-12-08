<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HotelBranchesResource;
use App\Models\Branch;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index($slug)
    {
        $hotel = Hotel::whereHotelSlug($slug)->with('branches')->first();
        return HotelBranchesResource::make($hotel);
    }


    public function rooms($slug,$id)
    {
        $branch = Branch::whereId($id)->with('rooms')->first();
        return view('hotel_branch_rooms')->with(['branch'=>$branch]);
    }

}
