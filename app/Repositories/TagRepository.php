<?php

namespace App\Repositories;

use App\Models\Tag;

/**
 * Class TagRepository.
 */
class TagRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
    ];

    /**
     * Return searchable fields.
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model.
     **/
    public function model()
    {
        return Tag::class;
    }

    /**
     * @param  array  $input
     * @return bool
     */
    public function store($input)
    {
        if (isset($input['bulk_tags']) && $input['bulk_tags'] == true) {
            $bulkTags = explode_trim_remove_empty_values_from_array($input['name'], ',');
            foreach ($bulkTags as $tag) {
                $nameLower = strtolower($tag);
                $departmentIds = (array) ($input['department_ids'] ?? []);

                // Enforce department-scoped uniqueness for bulk creation
                $conflictQuery = Tag::query()->whereRaw('LOWER(name) = ?', [$nameLower]);
                $isExist = !empty($departmentIds)
                    ? $conflictQuery->whereHas('departments', function ($q) use ($departmentIds) {
                        $q->whereIn('departments.id', $departmentIds);
                    })->exists()
                    : $conflictQuery->whereDoesntHave('departments')->exists();

                if ($isExist) {
                    continue;
                }
                $tag = Tag::create([
                    'name' => $tag,
                    'created_by' => getLoggedInUserId(),
                    'is_active' => isset($input['is_active']) ? 1 : 0,
                ]);
                // attach departments
                if (!empty($input['department_ids'])) {
                    $tag->departments()->syncWithoutDetaching($input['department_ids']);
                }
            }

            return true;
        }

        $input['created_by'] = getLoggedInUserId();
        
        // Handle is_active checkbox - if not present, set to 0 (inactive)
        $input['is_active'] = isset($input['is_active']) ? 1 : 0;
        
        $tag = Tag::create($input);

         // attach departments
        if (!empty($input['department_ids'])) {
            $tag->departments()->sync($input['department_ids']);
        }

        return true;
    }

    /**
     * @return mixed
     */
    public function getTagList()
    {
        return Tag::toBase()->orderBy('name')->pluck('name', 'id');
    }
}
