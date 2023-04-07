<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MatchRequest extends FormRequest
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
            'home_team_id' =>'required|numeric',
            'away_team_id' =>'required|numeric',
            'location'     =>'required|string',
            'stadium_name' =>'required|string',
            'match_date'  =>'required'
        ];
    }
}
