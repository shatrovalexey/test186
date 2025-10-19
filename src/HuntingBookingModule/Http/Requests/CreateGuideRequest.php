<?php
namespace test186\HuntingBookingModule\Http\Requests;

use test186\HuntingBookingModule\Http\Requests\BaseRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class CreateGuideRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'min:2',
                Rule::unique('guides', 'name')->where(fn ($q) => $q->where('is_active', true)),],
            'experience_years' => ['required', 'integer', 'min:0', 'max:50'],
            'is_active' => ['sometimes', 'boolean', 'default:true'],
            'specializations' => ['sometimes', 'array', 'max:5'],
            'specializations.*' => ['string', 'max:100'],
            'contact_phone' => ['sometimes', 'string', 'max:20', 'regex:/^[\+]?[0-9\s\-\(\)]+$/'],
            'email' => ['sometimes', 'email', 'max:255']
        ];
    }

    /**
     * Get custom validation messages.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Имя гида обязательно для заполнения.',
            'name.string' => 'Имя гида должно быть строкой.',
            'name.max' => 'Имя гида не может превышать 255 символов.',
            'name.min' => 'Имя гида должно содержать минимум 2 символа.',
            'name.unique' => 'Гид с таким именем уже существует.',
            
            'experience_years.required' => 'Количество лет опыта обязательно для заполнения.',
            'experience_years.integer' => 'Количество лет опыта должно быть целым числом.',
            'experience_years.min' => 'Количество лет опыта не может быть отрицательным.',
            'experience_years.max' => 'Количество лет опыта не может превышать 50 лет.',
            
            'is_active.boolean' => 'Поле активности должно быть логическим значением.',
            
            'specializations.array' => 'Специализации должны быть переданы в виде массива.',
            'specializations.max' => 'Нельзя указать более 5 специализаций.',
            'specializations.*.string' => 'Каждая специализация должна быть строкой.',
            'specializations.*.max' => 'Название специализации не может превышать 100 символов.',
            
            'contact_phone.regex' => 'Номер телефона имеет неверный формат.',
            'contact_phone.max' => 'Номер телефона не может превышать 20 символов.',
            
            'email.email' => 'Укажите корректный email адрес.',
            'email.max' => 'Email не может превышать 255 символов.'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'name' => 'имя гида',
            'experience_years' => 'лет опыта',
            'is_active' => 'активность',
            'specializations' => 'специализации',
            'contact_phone' => 'контактный телефон',
            'email' => 'email адрес'
        ];
    }
}