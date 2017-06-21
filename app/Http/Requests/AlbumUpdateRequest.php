<?php

namespace LaraCourse\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlbumUpdateRequest extends FormRequest
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
            'name' => 'required|unique:albums,album_name',
            'description' => 'required',
            //'user_id'=>'required'
        ];
    }

    public function message()
    {
        return[
            'name.required'=>'Il nome dell\'album è obbligatorio',
            'album_thumb.required'=>'L\'immagine è obbligatoria',
            'description.required'=>'La descrizione dell\'album è obbligatoria',
        ];
    }
}
