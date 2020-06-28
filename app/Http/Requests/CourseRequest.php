<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $course = $this->route('course');
        //Check if user is admin for this course -> if no admin_id is set return true
        if (isset($course->admin_id)) {
            return Auth::user()->id === $course->admin_id;
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
            'teacher' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Bitte füllen Sie einen Namen für den Kurs aus.',
            'description.required' => 'Bitte füllen Sie eine Beschreibung für den Kurs aus.',
            'teacher.required' => 'Bitte füllen Sie den Dozenten für den Kurs aus.',
        ];
    }

}
