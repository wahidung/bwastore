<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;

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
        if ($this->route('user')) {
            return [
                'name' => 'required|string|max:50',
                'email' => 'required|email|unique:users,id,' . $this->route('user'),
                'roles' => 'nullable|string|in:ADMIN,USER'
            ];
        } else {
            return [
                'name' => 'required|string|max:50',
                'email' => 'required|email|unique:users',
                'roles' => 'nullable|string|in:ADMIN,USER'
            ];
        }
    }
}