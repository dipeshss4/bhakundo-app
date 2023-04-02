<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class LeaugeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::user()->hasRole('admin')){
            return true;
        }
        else{
            return  false;
        }

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' =>'required|string',
            'country' =>'required|string',
            'start_year' =>'required|date',
            'year_ending' => 'required|date',
            'logo'        =>'image|mimes:jpeg,jpg,png|max:2048'
            //
        ];
    }
}
