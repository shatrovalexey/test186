<?php
namespace test186\HuntingBookingModule\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

abstract class BaseRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    /**
     * Handle a failed validation attempt.
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors(),], 422));
    }

    protected function prepareForValidation()
    {
        if ($this->has('is_active'))
            $this->merge(['is_active' => filter_var($this->is_active, FILTER_VALIDATE_BOOLEAN),]);
    }
}