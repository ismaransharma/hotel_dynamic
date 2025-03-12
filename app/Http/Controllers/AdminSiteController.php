<?php

namespace App\Http\Controllers;

use App\Models\Map;
use App\Models\Room;
use App\Models\Gallery;
use App\Models\CheckedIn;
use App\Models\ContactUs;
use App\Models\BookedRoom;
use App\Models\PreBooking;
use Illuminate\Http\Request;
use App\Models\CancelledRoom;

class AdminSiteController extends Controller
{

    public function adminHome()
    {
        $data = [
            'preBookings' => PreBooking::get(),
        ];
        
        return view('admin.preBooking', $data);
    }


    public function adminMaps()
    {
        $data = [
            'maps' => Map::where('deleted_at', null)->limit(1)->first(),
        ];


        return view('admin.map', $data);
    }

    public function adminRooms()
    {
        $data = [
            'rooms' => Room::where('deleted_at', null)->get(),
        ];

        return view('admin.rooms', $data);
    }

    public function adminGallery()
    {
        $data = [
            'galleries' => Gallery::where('deleted_at', null)->get(),
        ];

        return view('admin.gallery', $data);
    }

    public function adminContactUs()
    {
        $data = [
            'contactUs' => ContactUs::limit(1)->first(),
        ];

        return view('admin.contactUs', $data);
    }

    public function adminPreBooking()
    {
        $data = [
            'preBookings' => PreBooking::get(),
        ];

        return view('admin.preBooking', $data);
    }

    public function adminSearchPreBooking(Request $request)
    {
        if ($request->input('searchPreBooking') === null) {
            return back()->with('error', 'Please valid enter booking id');
        } else {
            $searchedPreBooking = $request->input('searchPreBooking');
            
            session(['searchedItem' => $searchedPreBooking]);
    
            $matches = PreBooking::where('booking_id', $searchedPreBooking)->get();
            $likelyMatches = PreBooking::where('booking_id', 'like', '%' . $searchedPreBooking . '%')->get();
    
            $preBookings = $matches->merge($likelyMatches)->unique('id');
    
            $booked = PreBooking::where('status', 'Booked')->get();
            $waiting = PreBooking::where('status', 'Waiting')->get();
            $cancelled = PreBooking::where('status', 'Cancelled')->get();
            $arrived = PreBooking::where('status', 'Arrived')->get();
            $checkedIn = PreBooking::where('status', 'Checked-In')->get();
    
            if ($preBookings->isNotEmpty()) {
                return view('admin.searchPreBooking', [
                    'searchedPreBooking' => $searchedPreBooking,
                    'PreBookings' => $preBookings,
                    'booked' => $booked,
                    'waiting' => $waiting,
                    'cancelled' => $cancelled,
                    'arrived' => $arrived,
                    'checkedIn' => $checkedIn,
                ]);
            } else {
                return redirect()->back()->with('error', 'No Pre Booking Found');
            }
        }
    }

    public function adminBooked()
    {
        $data = [
            'Booked' => BookedRoom::get(),
        ];
        
        return view('admin.booked', $data);
    }

    public function adminRoomCancelled()
    {
        $data = [
            'Cancelleds' => CancelledRoom::get(),
        ];
        
        return view('admin.cancelled', $data);
    
    }



    
    
    public function adminCheckedIn()
    {
        $data = [
            'checkedIns' => CheckedIn::get(),
        ];
        
        return view('admin.checkedIn', $data);
    }
    
    public function adminSearchBooked(Request $request)
    {
        if ($request->input('searchBooked') === null) {
            return back()->with('error', 'Please valid enter booking id');
        } else {
            $searchedBooked = $request->input('searchBooked');
            
            session(['searchedItem' => $searchedBooked]);
    
            $matches = BookedRoom::where('booking_id', $searchedBooked)->get();
            $likelyMatches = BookedRoom::where('booking_id', 'like', '%' . $searchedBooked . '%')->get();
    
            $Booked = $matches->merge($likelyMatches)->unique('id');
    
    
            if ($Booked->isNotEmpty()) {
                return view('admin.searchBooked', [
                    'Booked' => $Booked,
                    'searchedBooked' => $searchedBooked,
                ]);
            } else {
                return redirect()->back()->with('error', 'No Checked In Found');
            }
        }
    }
    
    public function adminSearchCheckedIn(Request $request)
    {
        if ($request->input('searchCheckedIn') === null) {
            return back()->with('error', 'Please valid enter booking id');
        } else {
            $searchedCheckedIn = $request->input('searchCheckedIn');
            
            session(['searchedItem' => $searchedCheckedIn]);
    
            $matches = CheckedIn::where('booking_id', $searchedCheckedIn)->get();
            $likelyMatches = CheckedIn::where('booking_id', 'like', '%' . $searchedCheckedIn . '%')->get();
    
            $checkedIn = $matches->merge($likelyMatches)->unique('id');
    
    
            if ($checkedIn->isNotEmpty()) {
                return view('admin.searchCheckedIn', [
                    'searchedCheckedIn' => $searchedCheckedIn,
                    'checkedIns' => $checkedIn,
                ]);
            } else {
                return redirect()->back()->with('error', 'No Checked In Found');
            }
        }
    }
    
    public function adminSearchCancelledRooms(Request $request)
    {
        if ($request->input('searchCheckedIn') === null) {
            return back()->with('error', 'Please valid enter booking id');
        } else {
            $searchedCancelled = $request->input('searchCheckedIn');
            
            session(['searchedItem' => $searchedCancelled]);
    
            $matches = CancelledRoom::where('booking_id', $searchedCancelled)->get();
            $likelyMatches = CancelledRoom::where('booking_id', 'like', '%' . $searchedCancelled . '%')->get();
    
            $Cancelled = $matches->merge($likelyMatches)->unique('id');
    
            // dd($searchedCancelled);
    
            if ($Cancelled->isNotEmpty()) {
                return view('admin.searchCancelled', [
                    'searchedCancelled' => $searchedCancelled,
                    'Cancelled' => $Cancelled,
                ]);
            } else {
                return redirect()->back()->with('error', 'No Cancelled Room In Found');
            }
        }
    }
    
    
}