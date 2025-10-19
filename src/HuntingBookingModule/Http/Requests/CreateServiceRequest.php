<?php
namespace test186\HuntingBookingModule\Http\Requests;

use test186\HuntingBookingModule\Http\Requests\BaseRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateServiceRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'min:2', 'unique:services,name'],
            'description' => ['nullable', 'string', 'max:1000'],
            'price' => ['required', 'numeric', 'min:0', 'max:1000000'],
            'is_active' => ['sometimes', 'boolean', 'default:true']
        ];
    }

    /**
     * Get custom validation messages.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Название обязательно для заполнения.',
            'name.string' => 'Название должно быть строкой.',
            'name.max' => 'Название не может превышать 255 символов.',
            'name.min' => 'Название должно содержать минимум 2 символа.',
            'name.unique' => 'Такое название уже существует.',

            'description.string' => 'Описание должно быть строкой.',
            'description.max' => 'Описание не может превышать 1000 символов.',

            'price.required' => 'Стоимость обязательна для заполнения.',
            'price.numeric' => 'Стоимость должна быть числом.',
            'price.min' => 'Стоимость не может быть отрицательной.',
            'price.max' => 'Стоимость не может превышать 1 000 000 рублей.',

            'is_active.boolean' => 'Поле активности должно быть true или false.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'name' => 'название',
            'description' => 'описание',
            'price' => 'стоимость',
            'is_active' => 'активность',
        ];
    }
}