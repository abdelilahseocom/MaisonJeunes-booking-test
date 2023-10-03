<?php
namespace App\Services;

use App\Booking;

class BookingService {

    public function saveUnavailability($booking_id, $data){
       $booking = Booking::updateOrCreate(
        [ 'id' => $booking_id],
        [
            'start_time' => $data['start_time'],
            'end_time'   => $data['start_time'],
            'comment'    => $data['comment'],
            'type'       => $data['type']
        ]);
       return $booking;
    }
}