<?php

namespace App\Http\Requests\ProductManagement;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' => 'required|string',
            'description' => 'nullable|string',
        ] +
            ($this->isMethod('POST') ? $this->store() : $this->update());
    }
    protected function store()
    {
        return [
            'slug' => 'required|unique:categories,slug',
        ];
    }

    protected function update()
    {
        return [
            'slug' => 'required|unique:categories,slug,' . decrypt($this->route('category')),
        ];
    }
}
