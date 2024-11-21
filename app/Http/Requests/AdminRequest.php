<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:4|max:15',
        ] +
            ($this->isMethod('POST') ? $this->store() : $this->update());
    }


    protected function store()
    {
        return [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    protected function update()
    {
        return [
            'email' => 'required|email|unique:users,email,' . decrypt($this->route('admin')),
            'password' => 'nullable|string|min:8|confirmed',
        ];
    }
}