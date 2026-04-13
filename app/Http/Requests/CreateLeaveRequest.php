<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\LeaveRequest;

class CreateLeaveRequest extends FormRequest
{
    public function authorize()
    {
        // ✅ You can add permissions check here later if needed
        return true;
    }

    public function rules()
    {
        return LeaveRequest::$rules;
    }
}
