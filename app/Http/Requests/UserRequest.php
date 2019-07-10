<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $email = '';
        if ($this->getMethod() == 'PATCH' || $this->getMethod() == 'patch'
            || $this->getMethod() == 'PUT' || $this->getMethod() == 'put'){
                $email = ',' . request('id');
        }

        return [
            'name'      => 'required|string|max:191',
            'email'     => 'required|string|max:191|email|unique:users,email' . $email,
            'type'      => 'required|string|max:191',
            'password'  => 'nullable|string|min:6'
        ];
    }
}
