<?php
/**
 * Company: InfyOm Technologies, Copyright 2019, All Rights Reserved.
 *
 * User: Vishal Ribdiya
 * Email: vishal.ribdiya@infyom.com
 * Date: 6/15/2019
 * Time: 1:01 PM
 */

namespace App\Http\Requests;

use App\Models\Department;
use App\Models\Tag;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTagRequest extends FormRequest
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
     * @return array
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
     * Configure the validator instance to enforce department-scoped uniqueness on update.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $tag = $this->route('tag');
            $currentId = $tag ? $tag->id : null;
            $name = strtolower(trim((string) $this->input('name')));
            if ($name === '') {
                return;
            }

            $departmentIds = (array) $this->input('department_ids', []);

            if (!empty($departmentIds)) {
                $conflictingDepartmentNames = Department::query()
                    ->whereIn('id', $departmentIds)
                    ->whereHas('tags', function ($q) use ($name, $currentId) {
                        $q->whereRaw('LOWER(name) = ?', [$name]);
                        if ($currentId) {
                            $q->where('tags.id', '!=', $currentId);
                        }
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
                $conflict = Tag::query()
                    ->whereRaw('LOWER(name) = ?', [$name])
                    ->when($currentId, fn($q) => $q->where('id', '!=', $currentId))
                    ->whereDoesntHave('departments')
                    ->exists();

                if ($conflict) {
                    $validator->errors()->add('name', 'A tag with this name already exists without any department.');
                }
            }
        });
    }
}
