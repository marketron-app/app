<?php

namespace App\Http\Requests\Admin\Template;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class StoreTemplateRequest extends FormRequest
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
            'title' => ['required'],
            'description' => ['required'],
            'identifier' => ['nullable', Rule::unique('templates', 'identifier')],
            'keywords' => ['array'],
            'image' => ['required', File::image()],
            'screenshotWidth' => ['required'],
            'screenshotHeight' => ['required'],
            'screenshotCoordinates' => ['required', 'array'],
            'screenshotCoordinates.*.x' => ['required'],
            'screenshotCoordinates.*.y' => ['required'],
            'cutoutCoordinates' => ['required', 'array'],
            'cutoutCoordinates.*.x' => ['required'],
            'cutoutCoordinates.*.y' => ['required'],
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'identifier' => $this->identifier ?? Str::slug($this->title),
        ]);
    }
}
