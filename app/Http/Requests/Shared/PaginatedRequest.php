<?php

namespace App\Http\Requests\Shared;

use Illuminate\Foundation\Http\FormRequest;

class PaginatedRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "page" => "nullable",
            "perPage" => "nullable"
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            "page" => $this->page ?? 1,
            "perPage" => $this->perPage ?? 15
        ]);
    }
}
