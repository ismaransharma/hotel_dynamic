<?php

namespace App\Http\Controllers;

use App\Models\Map;
use App\Models\Room;
use App\Models\Gallery;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function template()
    {
        $data = [
            'contactUs' => ContactUs::limit(1)->first(),

        ];

        return view('template.template', $data);
    }

    public function home()
    {
        $data = [
            'maps' => Map::where('deleted_at', null)->limit(1)->first(),
            'galleries' => Gallery::where('deleted_at', null)->limit(8)->get(),
            'rooms' => Room::where('deleted_at', null)->limit(3)->get(),
            'contactUs' => ContactUs::limit(1)->first(),

        ];

        return view('site.home', ['activePage' => 'home'], $data);
    }
    
    public function rooms()
    {
        $data = [
            'rooms' => Room::where('deleted_at', null)->where('status', 'active')->get(),
            'contactUs' => ContactUs::limit(1)->first(),


        ];

        return view('site.rooms', ['activePage' => 'rooms'], $data);
    }
    
    public function aboutUs()
    {
        $data = [
            'contactUs' => ContactUs::limit(1)->first(),


        ];

        return view('site.aboutUs', ['activePage' => 'aboutUs'], $data);
    }
    
    public function gallery()
    {

        $data = [
            'galleries' => Gallery::where('deleted_at', null)->get(),
            'contactUs' => ContactUs::limit(1)->first(),

        ];

        return view('site.gallery', ['activePage' => 'gallery'], $data);
    }
    
    public function contactUs()
    {
        $data = [
            'maps' => Map::where('deleted_at', null)->limit(1)->first(),
            'contactUs' => ContactUs::limit(1)->first(),
        ];

        return view('site.contactUs', ['activePage' => 'contactUs'], $data);
    }  
      
    public function roomDetail($slug)
    {
        $data = [
            'roomDetail' => Room::where('slug', $slug)->where('deleted_at', null)->where('status', 'active')->limit(1)->first(),
            'contactUs' => ContactUs::limit(1)->first(),


        ];

        return view('site.roomDetails', ['activePage' => 'rooms'], $data);
    }
}