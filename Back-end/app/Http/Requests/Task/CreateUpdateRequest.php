<?php

namespace App\Http\Requests\Task;

use App\Enums\TaskStatus;
use App\Models\User;
use App\Http\Requests\RequestBase;
use Illuminate\Validation\Rule;

class CreateUpdateRequest extends RequestBase
{
    public function authorize()
    {
        return true; // Or implement custom logic here if needed
    }

    public function rules()
    {

        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'status' => ['required', 'string', Rule::in(TaskStatus::getValues())],
            'user_id' => [
                'required',
                'exists:users,id',
                function ($attribute, $value, $fail) {
                    $user = User::find($value);
                    if (!$user->isUser()) {
                        $fail('The selected user is not a valid role.');
                    }
                },
            ],
        ];
    }
}
