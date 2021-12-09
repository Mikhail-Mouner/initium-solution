<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function hotelRooms($slug, $id, $type)
    {
        $branch_rooms = Branch::whereId($id)->with(["rooms" => function ($q) use ($type) {
            return $q->whereHas('roomType', function ($q) use ($type) {
                if ($type == 'all')
                    return $q;
                return $q->whereType($type);
            });
        }])->with('hotel')->first();

        return view('hotel-rooms', compact('branch_rooms'));
    }
}
