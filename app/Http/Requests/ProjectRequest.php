<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProjectRequest extends FormRequest
{
    public function authorize()
    {
        $project = $this->route('project');
        //Check if user is admin for this course -> if no admin_id is set return true
        if (isset($project->admin_id)) {
            return Auth::user()->id === $project->admin_id;
        } else {
            return true;
        }
    }

    public function rules()
    {
        return [
            //
        ];
    }
}
