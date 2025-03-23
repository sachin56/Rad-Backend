<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
                Rule::unique('menus', 'name')
                    ->where(function ($query) {
                        return $query->whereRaw('LOWER(name) = ?', [strtolower($this->name)])
                        
                            ->whereNull('deleted_at');
                    })
                    ->ignore($id),
            ],
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Added max size 2MB
            'backgroundImage' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Added max size 2MB
            'order' => [
                'required',
                'integer',
                'max:190',
                Rule::unique('menus', 'order')
                    ->ignore($id)
                    ->whereNull('deleted_at'),
            ],
        ];
    }
}
