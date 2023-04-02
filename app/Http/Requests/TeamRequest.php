<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TeamRequest extends FormRequest
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
            'logo' =>'image',
            'location' =>'required|string',
            'coach_name' =>'required|string',
            'coach_image' =>'image',
            'league_id' =>'required'
        ];
    }
}
