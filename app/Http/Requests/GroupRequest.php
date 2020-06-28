<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class GroupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $group = $this->route('group');
        //Check if user is admin for this course -> if no admin_id is set return true
        if (isset($group->admin_id)) {
            return Auth::user()->id === $group->admin_id;
        } else {
            return true;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Bitte füllen Sie einen Namen für die Gruppe aus.',
            'description.required' => 'Bitte füllen Sie eine Beschreibung für die Gruppe aus.',
        ];
    }
}
