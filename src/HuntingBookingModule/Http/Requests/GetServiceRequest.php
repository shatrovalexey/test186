<?php
namespace test186\HuntingBookingModule\Http\Requests;

use test186\HuntingBookingModule\Http\Requests\BaseRequest;

class GetServiceRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'id' => 'sometimes|integer|exists:services,id',
            'price' => 'sometimes|numeric|min:0',
            'is_active' => 'sometimes|boolean',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'название услуги',
            'description' => 'описание услуги',
            'price' => 'цена услуги',
            'is_active' => 'статус активности',
        ];
    }

    public function messages(): array
    {
        return [
            'id.exists' => 'Услуга с указанным ID не найдена',
            'price.numeric' => 'Цена должна быть числом',
            'price.min' => 'Цена не может быть отрицательной',
            'is_active.boolean' => 'Статус активности должен быть true или false',
        ];
    }
}