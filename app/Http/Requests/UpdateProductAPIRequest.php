<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductAPIRequest extends FormRequest
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
        return [
			'name'         => 'required',
			'is_published' => 'required',
			'sort'         => 'required|integer',
			'price'        => 'required|integer',
			'categories'   => 'required|array|min:2|max:10',
			'categories.*' => 'required|integer'
        ];
    }
}
