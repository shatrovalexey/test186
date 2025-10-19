<?php
namespace test186\HuntingBookingModule\Http\Controllers;

use Illuminate\Http\{JsonResponse, Request};
use test186\HuntingBookingModule\Http\Requests\{CreateServiceRequest, GetServiceRequest};
use test186\HuntingBookingModule\Models\Service;
use App\Http\Controllers\Controller;

/**
* Услуга
*/
class ServiceController extends Controller
{
    /**
    * Список
    */
    public function getList(GetServiceRequest $request)
    {
        $data = $request->validated();
        $query = Service::query();

        if ($request->has('name')) $query->where('name', 'like', '%' . $data->name . '%');
        if ($request->has('price')) $query->where('price', $data->price);
        if ($request->has('is_active')) $query->where('is_active', $data->is_active);

        return $query->get();
    }

    /**
    * Создать
    */
    public function createItem(CreateServiceRequest $request)
    {
        return Service::create($request->validated());
    }
}