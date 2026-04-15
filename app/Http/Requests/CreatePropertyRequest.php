<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Property;

class CreatePropertyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // ✅ Add permission checks here if necessary
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // This pulls the rules directly from the Property model we created earlier
        return Property::$rules;
    }

    /**
     * Optional: Custom error messages (if you want more specific feedback)
     */
    // public function messages()
    // {
    //     return [
    //         'owner_id.exists' => 'The selected owner is invalid.',
    //         'total_floors.min' => 'A property must have at least 1 floor.',
    //         'total_units.min' => 'A property must have at least 1 unit.',
    //     ];
    // }
}