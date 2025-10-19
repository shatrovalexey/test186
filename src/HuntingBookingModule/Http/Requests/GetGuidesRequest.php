<?php
namespace test186\HuntingBookingModule\Http\Requests;

use test186\HuntingBookingModule\Http\Requests\BaseRequest;

class GetGuidesRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'experience_years' => 'sometimes|integer|min:0|max:50',
            'min_experience' => 'sometimes|integer|min:0|max:50',
            'max_experience' => 'sometimes|integer|min:0|max:50',
            'is_active' => 'sometimes|boolean|default:true',
        ];
    }

    public function messages(): array
    {
        return [
            'experience_years.integer' => 'Опыт должен быть целым числом.',
            'experience_years.min' => 'Опыт не может быть отрицательным.',
            'experience_years.max' => 'Опыт не может превышать 50 лет.',
        ];
    }
}