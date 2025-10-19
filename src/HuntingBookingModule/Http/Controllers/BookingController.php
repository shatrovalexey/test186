<?php
namespace test186\HuntingBookingModule\Http\Controllers;

use Illuminate\Http\{JsonResponse, Request};
use test186\HuntingBookingModule\Http\Requests\{CreateBookingRequest, CreateGuideRequest, GetGuidesRequest, CreateServiceRequest};
use test186\HuntingBookingModule\Models\{Guide, HuntingBooking, Service};
use App\Http\Controllers\Controller;

/**
* Бронирование
*/
class BookingController extends Controller
{
    /**
    * Создать новое бронирование
    */
    public function getList()
    {
        return HuntingBooking::get();
    }

    /**
    * Создать новое бронирование
    */
    public function createItem(CreateBookingRequest $request)
    {
        return HuntingBooking::create($request->validated());
    }
}