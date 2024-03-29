<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\isRouteExist;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class PermissionApiStoreRequest extends FormRequest
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
            'name' => 'required|unique:permissions',
            'route_name' => ['required', 'min:5', 'max:75', 'unique:permissions', new isRouteExist],
            'roles' => 'array|nullable',
            'roles.*' => 'integer|exists:roles,id'
        ];
    }

}
