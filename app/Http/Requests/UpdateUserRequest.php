<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use App\Models\User;

class UpdateUserRequest extends FormRequest
{
	public function rules(): array
	{
        return [
            'first_name' => ['string', 'max:255'],
            'last_name' => ['string', 'max:255'],
            'patronymic' => ['string', 'max:255'],
            'number' => ['string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique((new User)->getTable())->ignore($this->user->id)],
        ];
	}
}