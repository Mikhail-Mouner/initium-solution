<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Booking_Room;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function addToCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'room_no' => 'required|numeric|min:1',
            'room_id' => 'required|numeric'
        ]);

        if ($validator->fails()) {

            session()->flash('mssg',
                ['status' => 'danger', 'data' => "Something Goes Wrong"]);
            return redirect()->back();
        }

        session()->flash('mssg', ['status' => 'success', 'data' => 'Add To Cart Successfully']);

        session()->push('booking', ['room_id' => $request->room_id, 'room_no' => $request->room_no, 'total' => ($request->room_price * $request->room_no)]);
        return redirect()->back();
    }

    public function removeToCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'index' => 'required|numeric|min:1',
        ]);

        session()->remove('booking.' . $request->index);
        return ['data' => 'Remove from Cart Successfully'];
    }

    public function cart()
    {
        $booking = session()->get('booking');
        $cart = [];
        if (isset($booking)) {
            foreach ($booking as $item) {
                $cart[] = [
                    'room' => Room::whereId($item['room_id'])->with('roomType')->with(["branch" => function ($q) {
                        return $q->with('hotel:id,hotel_name')->with('location:id,location_name');
                    }])->first()->toArray(),
                    'no' => $item['room_no'],
                ];
            }
        }
        return view('cart', compact('cart'));
    }

    public function booking()
    {
        $cart = session()->get('booking');
        if (isset($cart)) {
            $booking = Booking::create([
                'user_id' => auth()->user()->getAuthIdentifier(),
                'start_date' => now(),
                'end_date' => now(),
                'total_price' => 0,
            ]);
            $total = 1;
            foreach ($cart as $item) {
                Booking_Room::create([
                    'booking_id' => $booking->id,
                    'room_id' => $item['room_id'],
                    'room_no' => $item['room_no'],
                ]);
                $total += $item['total'];
            }
            $booking->total_price = $total;
            $booking->save();
            session()->flash('mssg', ['status' => 'success', 'data' => 'Checkout Successfully']);
        }
        session()->remove('booking');
        return redirect()->back();
    }
}
