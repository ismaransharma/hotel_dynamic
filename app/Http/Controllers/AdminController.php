<?php

namespace App\Http\Controllers;

use App\Models\Map;
use App\Models\Room;
use App\Models\Gallery;
use App\Models\CheckedIn;
use App\Models\ContactUs;
use App\Models\BookedRoom;
use App\Models\PreBooking;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CancelledRoom;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function postMap(Request $request)
    {
        $request->validate([
            'map' => 'required|string'
        ]);

        $mapInp = $request->input('map');

        $map = Map::first();
        if($map){
            $map->update(['map' => $mapInp]);
        }
        else{
            Map::create(['map' => $mapInp]);
        }
        
        return redirect()->back()->with('success', 'Map embed code saved Successfully!');

    }


    public function postRoom(Request $request)
    {
        $request->validate([
            'room_title' => 'required|string',
            'room_description' => 'required|string',
            'price' => 'required',
            'room_image' => 'required|image|mimes:jpeg,jpg,png' 
        ]);
        
        $room_title = $request->input('room_title');
        $slug = Str::slug($room_title);
        

        $image = $request->file('room_image');
        if($image){
            $unique_name = sha1(time());
            $extension = $image->getClientOriginalExtension();
            $room_image = $unique_name . '.' . $extension;

            $image->move('uploads/room_images/', $room_image);
        }

        $status = "active";


        $room = new Room;
        $room->room_title = $room_title;
        $room->room_description = $request->input('room_description');
        $room->price = $request->input('price');
        $room->room_image = $room_image;
        $room->slug = $slug;

        $room->save();

        return redirect()->back()->with('success', 'Room Added Successfully.');
    }


    public function postGallery(Request $request)
    {
        

        $request->validate = ([
            'image' => 'required|string|mimes:jpeg,jpg,png'
        ]);

        $image = $request->file('image');
        
        if($image)
        {
            $unique_name = sha1(time());
            $extension = $image->getClientOriginalExtension();
            $galleryImage = $unique_name . '.' . $extension;
            
            $image->move('uploads/gallery/', $galleryImage);
            
        }
        
        $gallery = new Gallery;
        
        if($image){
            $gallery->image=$galleryImage;
        }
        
        $gallery->save();
        return redirect()->back()->with('success', 'Image Added Successfully.');
        
    }

    public function deleteGalleryImage(Request $request, $id)
    {
        $image = Gallery::where('id', $id)->where('deleted_at', null)->limit(1)->first();
        if(is_null($image)){
            return redirect()->back()->with('error', 'Image Not Found');
        }

        dd("hi");

        $image->delete();
        return redirect()->back()->with('success', 'Chosen Image Deleted Successfully');

    }

    public function adminAddContactUs(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'number' => 'required',
            'address' => 'required|string',
            'email' => 'required'
        ]);

        $contactUs = ContactUs::first();

        if(!$contactUs){
            $contactUs = new ContactUs();
        }

        $contactUs->number = $request->input('number');
        $contactUs->address = $request->input('address');
        $contactUs->email = $request->input('email');

        $contactUs->save();
        
        return redirect()->back()->with('success', 'Contact Us Update Successfully');
    }

    public function editPreBooking(Request $request, $id)
    {
        $request->validate([
            'name' => 'string',
            'status' => 'string',
            'adult' => 'integer',
            'children' => 'integer',
            'email' => 'string',
            'number' => 'integer',
            'stayed' => 'integer',
        ]);

        // dd($request->all());
        
        // Fetch the pre-booking entry
        $checkPB = PreBooking::where('id', $id)->where('deleted_at', null)->limit(1)->first();
    
        if (!$checkPB) {
            return redirect()->back()->with('error', 'Pre-Booking not found.');
        }
    
        $stayed = $request->input('stayed');
        // dd($stayed);
        $status = $request->input('status');

        $room_id = $checkPB->room_id;
        $room = Room::withTrashed()->where('id', $room_id)->first();
        $priceP = $room->price;
        $total_price = $stayed * $priceP;
        
        if ($status == "Booked" || $status == "Arrived") {
            // Prepare booked room entry
            $booked = new BookedRoom;
    
            if (!$room) {
                return redirect()->back()->with('error', 'Room not found.');
            }
            
            // Prepare mail data
            $maildata = [
                'name' => $request->input('name'),
                'booking_id' => $checkPB->booking_id,
                'room' => $room->room_title,
                'arrival_date' => $checkPB->arrival_date,
                'departure_date' => $checkPB->departure_date,
                'adult' => $request->input('adult'),
                'children' => $request->input('children'),
                'stayed' => $stayed,
                'total_price' => $checkPB->total_price,
                'email' => $request->input('email'),
                'number' => $request->input('number'),
            ];

            // dd($maildata['number']);
            
            
            // Send email
            Mail::send('email.booked', $maildata, function ($message) use ($maildata) {
                $message->from('smaransharma90@gmail.com', 'Siddhartha Park Regency');
                $message->sender('smaransharma90@gmail.com', 'Siddhartha Park Regency');
                $message->to($maildata['email'], $maildata['name']);
                $message->subject('Your Room has been Successfully Booked!');
                $message->priority(1);
            });
    
            // Booking logic
   
            $booked->booking_id = $checkPB->booking_id;
            $booked->room_id = $checkPB->room_id;
            $booked->name = $request->input('name');
            $booked->arrival_date = $checkPB->arrival_date;
            $booked->departure_date = $checkPB->departure_date;
            $booked->adult = $request->input('adult');
            $booked->children = $request->input('children');
            $booked->email = $request->input('email');
            $booked->number = $request->input('number');
            $booked->status = $status;
            $booked->stayed = $stayed;
            $booked->total_price = $total_price;
            $booked->save();
    
            $checkPB->delete();
    
            // Return success message
            return redirect()->back()->with('success', 'Room Booked Successfully. Mail Sent Successfully to ' . $checkPB->email);
        }
    
        elseif($status == "Checked-In") {
            // Logic for checked-in status
            $room_id = $checkPB->room_id;
            $room = Room::withTrashed()->where('id', $room_id)->first();
    
            if ($room && $room->trashed()) {
                $room->restore();
            }

            $maildata = [
                'name' => $request->input('name'),
                'booking_id' => $checkPB->booking_id,
                'room' => $room->room_title,
                'arrival_date' => $checkPB->arrival_date,
                'departure_date' => $checkPB->departure_date,
                'adult' => $request->input('adult'),
                'children' => $request->input('children'),
                'stayed' => $stayed,
                'total_price' => $checkPB->total_price,
                'email' => $request->input('email'),
                'number' => $request->input('number'),
            ];

            
            
            // Send email
            Mail::send('email.checkedIn', $maildata, function ($message) use ($maildata) {
                $message->from('smaransharma90@gmail.com', 'Siddhartha Park Regency');
                $message->sender('smaransharma90@gmail.com', 'Siddhartha Park Regency');
                $message->to($maildata['email'], $maildata['name']);
                $message->subject('Your Room Booking Has Been Checked-In!');
                $message->priority(1);
            });
    
            if ($room) {
                $priceP = $room->price;
                $total_price = $stayed * $priceP;
    
                $checkedIn = new CheckedIn;
                $checkedIn->booking_id = $checkPB->booking_id;
                $checkedIn->room_id = $checkPB->room_id;
                $checkedIn->name = $checkPB->name;
                $checkedIn->arrival_date = $checkPB->arrival_date;
                $checkedIn->departure_date = $checkPB->departure_date;
                $checkedIn->adult = $checkPB->adult;
                $checkedIn->children = $checkPB->children;
                $checkedIn->email = $checkPB->email;
                $checkedIn->number = $checkPB->number;
                $checkedIn->status = $status;
                $checkedIn->stayed = $checkPB->stayed;
                $checkedIn->total_price = $total_price;
                $checkedIn->save();
    
                $checkPB->delete();
    
                return redirect()->back()->with('success', 'Checked In Successfully.');
            } else {
                return redirect()->back()->with('error', 'Room not found.');
            }
        }
        elseif($status == "Cancelled") {
            $room_id = $checkPB->room_id;
            $room = Room::withTrashed()->where('id', $room_id)->first();
            
            if ($room && $room->trashed()) {
                $room->restore();
            }
            
            $maildata = [
                'name' => $request->input('name'),
                'booking_id' => $checkPB->booking_id,
                'room' => $room->room_title,
                'arrival_date' => $checkPB->arrival_date,
                'departure_date' => $checkPB->departure_date,
                'adult' => $request->input('adult'),
                'children' => $request->input('children'),
                'stayed' => $stayed,
                'total_price' => $checkPB->total_price,
                'email' => $request->input('email'),
                'number' => $request->input('number'),
            ];
            
            
            
            // Send email
            Mail::send('email.cancelled', $maildata, function ($message) use ($maildata) {
                $message->from('smaransharma90@gmail.com', 'Siddhartha Park Regency');
                $message->sender('smaransharma90@gmail.com', 'Siddhartha Park Regency');
                $message->to($maildata['email'], $maildata['name']);
                $message->subject('Your Room Booking Has Been Cancelled!');
                $message->priority(1);
            });

            $cancelled = new CancelledRoom;
            $cancelled->booking_id = $checkPB->booking_id;
            $cancelled->room_id = $checkPB->room_id;
            $cancelled->name = $checkPB->name;
            $cancelled->arrival_date = $checkPB->arrival_date;
            $cancelled->departure_date = $checkPB->departure_date;
            $cancelled->adult = $checkPB->adult;
            $cancelled->children = $checkPB->children;
            $cancelled->email = $checkPB->email;
            $cancelled->number = $checkPB->number;
            $cancelled->status = $status;
            $cancelled->stayed = $checkPB->stayed;
            $cancelled->total_price = $total_price;
            $cancelled->save();

            $checkPB->delete();
    
            return redirect()->back()->with('success', 'Room Booking Cancelled Successfully!');
        }
    
        $room_id = $checkPB->room_id;
        $room = Room::withTrashed()->where('id', $room_id)->first();
    
        if ($room) {
            $priceP = $room->price;
            $total_price = $stayed * $priceP;
        } else {
            return redirect()->back()->with('error', 'Room not found.');
        }
    
        // Update pre-booking information
        $checkPB->name = $request->input('name');
        $checkPB->status = $request->input('status');
        $checkPB->adult = $request->input('adult');
        $checkPB->children = $request->input('children');
        $checkPB->email = $request->input('email');
        $checkPB->number = $request->input('number');
        $checkPB->stayed = $stayed;
        $checkPB->total_price = $total_price;
        $checkPB->save();
    
        return redirect()->back()->with('success', 'Pre-Booking Updated Successfully');
    }
    

    public function editBooked(Request $request, $id)
    {
        $request->validate([
            'name' => 'string',
            'status' => 'string',
            'adult' => 'integer',
            'children' => 'integer',
            'email' => 'string',
            'number' => 'integer',
            'stayed' => 'integer',
        ]);
        
        $booked = BookedRoom::where('id', $id)->where('deleted_at', null)->limit(1)->first();

        
        $stayed = $request->input('stayed');
        
        $status = $request->input('status');
        
        if($status == "Checked-In") {
            $room_id = $booked->room_id;
            $room = Room::withTrashed()->where('id', $room_id)->first();  
        
            if ($room && $room->trashed()) {
                $room->restore();
            }
        
            if ($room) {
                $priceP = $room->price;
                $total_price = $stayed * $priceP; 

                $maildata = [
                    'name' => $request->input('name'),
                    'booking_id' => $booked->booking_id,
                    'room' => $room->room_title,
                    'arrival_date' => $booked->arrival_date,
                    'departure_date' => $booked->departure_date,
                    'adult' => $request->input('adult'),
                    'children' => $request->input('children'),
                    'stayed' => $stayed,
                    'total_price' => $booked->total_price,
                    'email' => $request->input('email'),
                    'number' => $request->input('number'),
                ];
    
                
                
                // Send email
                Mail::send('email.checkedIn', $maildata, function ($message) use ($maildata) {
                    $message->from('smaransharma90@gmail.com', 'Siddhartha Park Regency');
                    $message->sender('smaransharma90@gmail.com', 'Siddhartha Park Regency');
                    $message->to($maildata['email'], $maildata['name']);
                    $message->subject('Your Room Booking Has Been Checked-In!');
                    $message->priority(1);
                });
                
                $checkedIn = new CheckedIn;
                $checkedIn->booking_id = $booked->booking_id;
                $checkedIn->room_id = $booked->room_id;
                $checkedIn->name = $request->input('name');
                $checkedIn->arrival_date = $booked->arrival_date;
                $checkedIn->departure_date = $booked->departure_date;
                $checkedIn->adult = $request->input('adult');
                $checkedIn->children = $request->input('children');
                $checkedIn->email = $request->input('email');
                $checkedIn->number = $request->input('number');
                $checkedIn->status = $status;
                $checkedIn->stayed = $stayed;
                $checkedIn->total_price = $total_price; 
                $checkedIn->save();
        
                $booked->delete();
        
                return redirect()->back()->with('success', 'Checked In Successfully.');
            } else {
                return redirect()->back()->with('error', 'Room not found.');
            }
        }

        $room_id = $booked->room_id;
        $room = Room::withTrashed()->where('id', $room_id)->first();  
        
        $priceP = $room->price;
        $total_price = $stayed * $priceP; 
        
        // dd($status);
        $booked->booking_id = $booked->booking_id;
        $booked->room_id = $booked->room_id;
        $booked->name = $request->input('name');
        $booked->arrival_date = $booked->arrival_date;
        $booked->departure_date = $booked->departure_date;
        $booked->adult = $request->input('adult');
        $booked->children = $request->input('children');
        $booked->email = $request->input('email');
        $booked->number = $request->input('number');
        $booked->status = $status;
        $booked->stayed = $stayed;
        $booked->total_price = $total_price;
        $booked->save();
        return redirect()->back()->with('success', 'Booked Room Updated Successfully');

    }






}