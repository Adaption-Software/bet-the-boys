<?php

namespace App\Http\Requests;

use App\Enums\BetType;
use App\Enums\Sport;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PlaceBetRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'event_id' => ['required', 'string'],
            'team_id' => ['required', 'integer', 'exists:teams,id'],
            'bet_type' => ['required', 'string', Rule::enum(BetType::class)],
            'sport' => ['required', 'string', Rule::enum(Sport::class)],
        ];
    }
}
