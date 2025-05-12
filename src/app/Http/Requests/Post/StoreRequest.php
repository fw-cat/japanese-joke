<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'theme_id' => ['required', 'exists:themes,id'],
            'content' => ['required', 'string',],
            'user_name' => ['nullable', 'string', 'max:1024'],
        ];
    }

    public function attributes(): array
    {
        return [
            'theme_id' => 'お題',
            'content' => '投稿内容',
            'user_name' => '投稿者',
        ];
    }
}
