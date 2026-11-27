<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Notification;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request){

    $request->validate([
        "date"=>"required|date|after:today",
        "time"=>"required|date_format:H:i",
        "guests"=>"required|integer|min:1|max:20",
        'notes' => 'nullable|string|max:500'
    ]);

    $booking = Booking::create([
            "user_id" => $request->user()->id,
            'date'    => $request->date,
            'time'    => $request->time,
            'guests'  => $request->guests,
            'notes'   => $request->notes,
            "status"  => "pending"
    ]);
    return response()->json($booking,201);

    }

    public function mybookings(Request $request){
        $bookings = Booking::where("user_id",$request->user()->id)->orderBy('created_at', 'desc')->get();

        return response()->json($bookings);
    }

    public function index(){
        $bookings = Booking::with("user")->orderBy("created_at","desc")->get();

        return response()->json($bookings);
    }

    public function UpdateStatus(Request $request,$id)
    {

    $request->validate([
        "status"=>"required|in:confirmed,rejected"
    ]);

    $booking = Booking::with("user")->findOrFail($id);
    $booking-> update(["status"=>$request->status]);

Notification::create([
    "user_id"=>$booking->user_id,
    "booking_id"=>$booking->id,
    "message"=>"your booking on {$booking->date} has been {$booking->status}",
    "is_read"=>false
]);

return response()->json($booking);
    }
}
