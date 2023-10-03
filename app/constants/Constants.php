<?php
namespace App\Constants;

class Constants {
    const STATUS_NOT_ACTIVE=0;
    const STATUS_ACTIVE = 1;
    const TYPE_PASSJEUNES = "passjeunes";
    const TYPE_ASSOCIATION = "association";
    const BOOKING_TRAVAUX = "travaux";
    const BOOKING_UNAVAILABLE = "unavailable";
    const BOOKING_SERVICE = "service";

    public static function getAllStatus(){
        return collect([
            ["name"=>"Active","value"=>Constants::STATUS_ACTIVE],
            ["name"=>"Desactive","value"=>Constants::STATUS_NOT_ACTIVE],
        ]);
    }

    public static function getClientTypes(){
        return collect([
            ["name"=>"Pass Jeunes","value"=>Constants::TYPE_PASSJEUNES],
            ["name"=>"Association","value"=>Constants::TYPE_ASSOCIATION],
        ]);
    }

    public static function getBookingTypes(){
        return collect([
            ["name"=>"Indisponible","value"=>Constants::BOOKING_UNAVAILABLE],
            ["name"=>"Travaux","value"=>Constants::BOOKING_TRAVAUX],
        ]);
    }
}