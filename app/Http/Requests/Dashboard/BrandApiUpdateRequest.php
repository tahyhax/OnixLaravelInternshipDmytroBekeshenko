<?php

namespace App\Http\Requests\Dashboard;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class BrandApiUpdateRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => Str::slug($this->name),
        ]);
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|unique:brands,name,' . $this->brand->id,
        ];
    }

}
