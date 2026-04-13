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

class UpdateUserRequest extends FormRequest
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
    //     $id = $this->route('user')->id;
    //     $rules = User::$rules;
    //     $rules['email'] = 'required|email:filter|unique:users,email,'.$id;

    //     return $rules;
    // }

      public function rules()
        {
            $id = $this->route('user')->id;
            $rules = User::$rules;
            $rules['email'] = 'required|email:filter|unique:users,email,'.$id;
             // Update account_number rule to ignore current user
            $rules['account_number'] = 'nullable|string|max:255|unique:users,account_number,'.$id;
            // Conditional bank validation for update
            if ($this->has('has_bank_info') && $this->has_bank_info == '1') {
                $rules['bank_name'] = 'required|string|max:255';
                $rules['account_name'] = 'required|string|max:255';
                 $rules['account_number'] = 'required|string|max:255|unique:users,account_number,'.$id;
                $rules['branch_name'] = 'required|string|max:255';
                $rules['branch_routing_number'] = 'required|string|max:100';
                $rules['swift_code'] = 'nullable|string|max:50';
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
