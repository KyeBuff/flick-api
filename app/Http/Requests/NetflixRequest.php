<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MediaRequest extends FormRequest
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
           "title" => ["required", "string", "max:100"],
           "year" => ["integer", "min:1900", "max:9999"],
           "synopsis" => ["string", "max:1000000", "nullable"],
           "img_url" => ["url", "nullable"],
           "genres" => ["array", "nullable"],
        ];
    }
}
