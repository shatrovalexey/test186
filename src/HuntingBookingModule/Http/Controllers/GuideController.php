<?php
namespace test186\HuntingBookingModule\Http\Controllers;

use Illuminate\Http\{JsonResponse, Request};
use test186\HuntingBookingModule\Http\Requests\{CreateGuideRequest, GetGuidesRequest};
use test186\HuntingBookingModule\Models\Guide;
use App\Http\Controllers\Controller;

/**
* Проводник
*/
class GuideController extends Controller
{
    /**
    * Список
    */
    public function getList(GetGuidesRequest $request)
    {
        $data = $request->validated();
        $query = Guide::query();

        if ($request->has('experience_years')) $query->where('experience_years', $data->experience_years);
        if ($request->has('is_active')) $query->where('is_active', $data->is_active);

        return $query->get();
    }

    /**
    * Создать
    */
    public function createItem(CreateGuideRequest $request)
    {
        return Guide::create($request->validated());
    }
}