<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class ProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'description' => ['required'],
            'price' => ['required', 'integer', 'min:10'],
            'category_id' => ['required', Rule::exists('categories', 'id')],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
