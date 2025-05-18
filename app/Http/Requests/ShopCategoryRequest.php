<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ShopCategoryRequest extends FormRequest
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
        $id = $this->route('id') ?? 0;

        return [
            'name' => [
                'required',
                'max:190',
                Rule::unique('shop_categories', 'name')
                    ->where(function ($query) {
                        return $query->whereRaw('LOWER(name) = ?', [strtolower($this->name)])
                            ->whereNull('deleted_at');
                    })
                    ->ignore($id),
            ],
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Added max size 2MB
        ];
    }
}
