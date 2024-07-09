<?php

namespace App\Http\Requests;

use App\Models\Task;
use App\Enums\TaskStatus;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
            'title'         => ['required', 'string', 'max:150'],
            'description'   => ['required', 'string', 'max:300'],
            'status'        => ['required', Rule::in(array_column(TaskStatus::cases(), 'value'))],
            'due_date'      => ['required', 'date', 'after_or_equal:today'],
        ];
    }
}
