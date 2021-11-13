<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'name'=>'required|string',
                    'email'=>'required|email|unique:admins,email',
                    'mobile'=>'required|string|unique:admins,mobile'
                ];
                break;

            case 'PATCH':
            case 'PUT':
                return [
                    'name'=>'required|string',
                    'email'=>"required|email|unique:admins,email,{$this->id}",
                    'mobile'=>"required|string|unique:admins,mobile,{$this->id}"
                ];
                break;
        }

    }
}
