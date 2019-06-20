<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApartmentRequest extends FormRequest
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

          "img_path" => "required|image|mimes:jpeg,png,jpg,gif,svg",
          "title" => "required",
          "description" => "required",
          "address" => "required",
          "latitude" => "required",
          "longitude" => "required",
          "rooms" => "required",
          "beds" => "required",
          "bathrooms" => "required",
          "mq" => "required",
          "wi_fi" => "required",
          "parking_space" => "required",
          "pool" => "required",
          "sauna" => "required",
          "active" => "required"
        ];
    }
}
