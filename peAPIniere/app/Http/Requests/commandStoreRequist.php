<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class commandStoreRequist extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'plante_id' => 'required|exists:plantes,id',
            'quantity' => 'required|integer|min:1',
            'acciptaion' => 'sometimes|in:accepte,refuser',
            'statut' => 'sometimes|in:pending,in_preparation,delivered'
        ];
    }
}
