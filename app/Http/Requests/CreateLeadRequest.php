<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Lead;

class CreateLeadRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules() {
        return Lead::$rules;
    }
}
