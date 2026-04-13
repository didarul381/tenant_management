<?php
/**
 * Company: InfyOm Technologies, Copyright 2019, All Rights Reserved.
 *
 * User: Vishal Ribdiya
 * Email: vishal.ribdiya@infyom.com
 * Date: 6/15/2019
 * Time: 1:07 PM
 */

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array The given data was invalid.
     */
    // public function rules()
    // {
    //     return User::$rules;
    // }
       public function rules()
    {
        $rules = User::$rules;
        
        // Add conditional validation for bank fields when has_bank_info is checked
        if ($this->has('has_bank_info') && $this->has_bank_info == '1') {
            $rules['bank_name'] = 'required|string|max:255';
            $rules['account_name'] = 'required|string|max:255';
             $rules['account_number'] = 'required|string|max:255|unique:users,account_number';
            $rules['branch_name'] = 'required|string|max:255';
            $rules['branch_routing_number'] = 'required|string|max:255';
            // swift_code remains nullable even when bank info is checked
            $rules['swift_code'] = 'nullable|string|max:255';
        }
        
        return $rules;
    }
    /**
     * @return array
     */
    public function messages()
    {
        return User::$messages;
    }
}
