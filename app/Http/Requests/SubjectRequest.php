<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('subject')?->id;

        return [
            'name' => ['required', 'string', 'max:255', 'unique:subjects,name,' . $id],
            'oral_max' => ['required', 'integer', 'min:10', 'max:100'],
            'written_max' => ['required', 'integer', 'min:10', 'max:150'],
        ];
    }
}
