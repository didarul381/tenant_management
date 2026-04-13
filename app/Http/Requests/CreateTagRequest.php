<?php
/**
 * Company: InfyOm Technologies, Copyright 2019, All Rights Reserved.
 *
 * User: Vishal Ribdiya
 * Email: vishal.ribdiya@infyom.com
 * Date: 6/15/2019
 * Time: 1:00 PM
 */

namespace App\Http\Requests;

use App\Models\Department;
use App\Models\Tag;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateTagRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => ['required', 'max:160'],
            'department_ids' => ['nullable', 'array'],
            'department_ids.*' => ['integer', Rule::exists('departments', 'id')],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }

    /**
     * Configure the validator instance.
     *
     * Enforce department-scoped uniqueness:
     * - If departments selected: name must be unique within any of those departments.
     * - If no department selected: name must be unique among tags with no departments.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $name = strtolower(trim((string) $this->input('name')));
            if ($name === '') {
                return;
            }

            $departmentIds = (array) $this->input('department_ids', []);

            if (!empty($departmentIds)) {
                // Check conflict in any selected department
                $conflictingDepartmentNames = Department::query()
                    ->whereIn('id', $departmentIds)
                    ->whereHas('tags', function ($q) use ($name) {
                        $q->whereRaw('LOWER(name) = ?', [$name]);
                    })
                    ->pluck('name')
                    ->all();

                if (!empty($conflictingDepartmentNames)) {
                    $validator->errors()->add(
                        'name',
                        'This tag already exists in department(s): '.implode(', ', $conflictingDepartmentNames).'.'
                    );
                }
            } else {
                // No department selected: ensure there is no tag with same name that has no departments
                $conflict = Tag::query()
                    ->whereRaw('LOWER(name) = ?', [$name])
                    ->whereDoesntHave('departments')
                    ->exists();

                if ($conflict) {
                    $validator->errors()->add('name', 'A tag with this name already exists without any department.');
                }
            }
        });
    }
}
