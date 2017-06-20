<?php

namespace LaraCourse\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlbumRequest extends FormRequest
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
            'album_name' => 'required|unique:albums:album_name',
            'description' => 'required',
            'album_thumb' => 'required|image'
            //'user_id'=>'required'
        ];
    }
}
