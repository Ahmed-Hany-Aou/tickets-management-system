<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;  // You can add authorization logic here if needed
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ticket_link' => 'required|url',
            'category' => 'required|string',
            'status' => 'required|string',
            'ticket_date' => 'required|date',
            'agent' => 'required|string',
            'solved_by' => 'required|string',
            'last_reminder' => 'nullable|string',
            'comments' => 'nullable|string',
        ];
    }

    /**
     * Get custom messages for validation errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'ticket_link.required' => 'The ticket link is required.',
            'category.required' => 'The category is required.',
            'status.required' => 'The status is required.',
            'ticket_date.required' => 'The ticket date is required.',
            'agent.required' => 'The agent name is required.',
            'solved_by.required' => 'The solved by field is required.',
        ];
    }
}

