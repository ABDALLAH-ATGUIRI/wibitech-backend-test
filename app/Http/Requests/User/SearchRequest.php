<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
class SearchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('viewAny', User::class);
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'search' => 'nullable|string|max:255',
            'role' => 'nullable|string|in:user,admin,guest', // Example roles
            'status' => 'nullable|string|in:active,inactive', // Example statuses
        ];
    }
}