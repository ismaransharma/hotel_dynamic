<?php

namespace App\Models;

use App\Models\BookedRoom;
use Illuminate\Database\Eloquent\Model;

class PreBooking extends Model
{
    protected $fillable = [
        'name',
        'arrival_date',
        'departure_date',
        'adult',
        'children',
        'email',
        'number',
        'status',
        'stayed'
    ];


    protected static function boot()
    {
        parent::boot();

        // Listen to the 'updated' event to check for status change
        static::updated(function ($preBooking) {
            // Check if the status has changed to 'Booked', 'Arrived', or 'Checked-In'
            if (in_array($preBooking->status, ['Booked', 'Arrived', 'Checked-In']) && $preBooking->getOriginal('status') != $preBooking->status) {
                // Transfer to the booked_rooms table
                BookedRoom::create([
                    'name' => $preBooking->name,
                    'arrival_date' => $preBooking->arrival_date,
                    'departure_date' => $preBooking->departure_date,
                    'adult' => $preBooking->adult,
                    'children' => $preBooking->children,
                    'email' => $preBooking->email,
                    'number' => $preBooking->number,
                    'status' => $preBooking->status,
                    'stayed' => $preBooking->stayed,
                ]);

                // Delete the record from the pre_bookings table
                $preBooking->delete();
            }
        });
    }
}