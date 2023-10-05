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
    const BOOKING_STATUS_CANCELED = "canceled";
    const BOOKING_STATUS_COMPLETED = "completed";
    const BOOKING_STATUS_CONFIRMED = "confirmed";

    public static function getAllStatus(){
        return collect([
            ["name"=>"Actif","value"=>Constants::STATUS_ACTIVE],
            ["name"=>"Inactif","value"=>Constants::STATUS_NOT_ACTIVE],
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

    public static function getBookingStatus(){
        return collect([
            ["name"=>"Annulé","value"=>Constants::BOOKING_STATUS_CANCELED],
            ["name"=>"Complété","value"=>Constants::BOOKING_STATUS_COMPLETED],
            ["name"=>"Confirmé","value"=>Constants::BOOKING_STATUS_CONFIRMED],
        ]);
    }
}