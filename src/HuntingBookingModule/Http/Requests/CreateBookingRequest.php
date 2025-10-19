<?php
namespace test186\HuntingBookingModule\Http\Requests;

use test186\HuntingBookingModule\Http\Requests\BaseRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use test186\HuntingBookingModule\Models\HuntingBooking;

class CreateBookingRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'service_id' => 'required|integer|exists:services,id',
            'guide_id' => 'required|integer|exists:guides,id',
            'date' => 'required|date|after_or_equal:today',
            'participants_count' => 'required|integer|min:1|max:'
                . HuntingBooking::PARTICIPANTS_COUNT_MAX,
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'guide_id.exists' => 'Выбранный гид не существует.',
            'date.after_or_equal' => 'Дата бронирования не может быть в прошлом.',
            'participants_count.max' => 'Количество участников не может превышать '
                . HuntingBooking::PARTICIPANTS_COUNT_MAX,
        ];
    }
}