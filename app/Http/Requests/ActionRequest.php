<?php

namespace App\Http\Requests;

use App\Enums\Action;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class ActionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_a' => [
                'required',
                'exists:users,id',
            ],
            'user_b' => [
                'required',
                'exists:users,id',
                'different:user_a',
            ],
            'action' => [
                'required',
                new Enum(Action::class),
            ],
        ];
    }
}
