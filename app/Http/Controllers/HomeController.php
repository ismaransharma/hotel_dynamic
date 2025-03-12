<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Room;
use App\Models\ContactUs;
use App\Models\BookedRoom;
use App\Models\PreBooking;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function postAddPreBooking(Request $request, $id)
    {
        $request->validate([
            'arrival' => 'required|string',
            'departure' => 'required|string',
            'adult' => 'required',
            'children' => 'required',
            'user_name' => 'required|string',
            'user_email' => 'required',
            'user_number' => 'required|integer'
        ]);
    
        $arrival = $request->input('arrival');
        $departure = $request->input('departure');
    
        $arrival = Carbon::parse($arrival);
        $departure = Carbon::parse($departure);
        
        if ($arrival > $departure) {
            return back()->with('error', 'Please select the date correctly');
        }
    
        $stayed = $arrival->diffInDays($departure) + 1;

        $bookingId = '#' . Str::random(8);
    
        $checkRoom = Room::where('id', $id)->limit(1)->first();
        $price = $checkRoom->price;
        $total_price = $price * $stayed;
        // dd($total_price);



        $preBooking = new PreBooking;
        
        $preBooking->booking_id = $bookingId;
        $preBooking->room_id = $id;
        $preBooking->arrival_date = $arrival;
        $preBooking->departure_date = $departure;
        $preBooking->adult = $request->input('adult');
        $preBooking->children = $request->input('children');
        $preBooking->name = $request->input('user_name');
        $preBooking->email = $request->input('user_email');
        $preBooking->number = $request->input('user_number');
        $preBooking->total_price = $total_price;
        $preBooking->stayed = $stayed;
    
        $preBooking->save();
    
        // Soft delete the room by using the delete method (this will set 'deleted_at')
        $searchRoom = Room::where('id', $id)->first();
        if ($searchRoom) {
            $searchRoom->delete();
        }
    
        return redirect()->route('getHome')->with('success', 'Your pre-booking is received. We will review it and confirm via email.');
    }
    


    public function postAddCheckAvailability(Request $request)
    {
        $arrival = $request->input('arrival');
        $departure = $request->input('departure');

        $arrival = Carbon::parse($arrival);
        $departure = Carbon::parse($departure);
        
        
        $checkRoomPre = PreBooking::where('arrival_date', $arrival)->where('departure_date', $departure)->get();
        $checkRoomBook = BookedRoom::where('arrival_date', $arrival)->where('departure_date', $departure)->get();
        
        if(!$checkRoomPre->isEmpty() || !$checkRoomBook->isEmpty())
        {
            return redirect()->back()->with('error', 'No Rooms are available for the selected date');
        }else{

            $data = [
                'rooms' => Room::where('deleted_at', null)->where('status', 'active')->get(),
                'contactUs' => ContactUs::limit(1)->first(), 
            ];

            return view('site.rooms', ['activePage' => 'rooms'] , $data);
        }
        
        
    }
}