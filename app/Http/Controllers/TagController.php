<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Tag;
use App\Models\Department;
use App\Queries\TagDataTable;
use App\Repositories\TagRepository;
use DataTables;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class TagController.
 */
class TagController extends AppBaseController
{
    /** @var TagRepository */
    private $tagRepository;

    /**
     * TagController constructor.
     *
     * @param  TagRepository  $tagRepo
     */
    public function __construct(TagRepository $tagRepo)
    {
        $this->tagRepository = $tagRepo;
    }

    /**
     * @param  Request  $request
     * @return Factory|View
     *
     * @throws Exception
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {


            return DataTables::of((new TagDataTable())->get($request->only(['name', 'department_filter', 'status_filter'])))->make(true);
        }


      //$departmentHasTag = Department::whereHas('tags')->orderBy('name', 'asc')->pluck('name', 'id')->toArray();
       $departments = Department::whereNull('deleted_at')->orderBy('name', 'asc')->pluck('name', 'id')->toArray();

      return view('tags.index', compact('departments'));
    }

    /**
     * Store a newly created Tag in storage.
     *
     * @param  CreateTagRequest  $request
     * @return JsonResponse
     */
    public function store(CreateTagRequest $request)
    {
       
        if (auth()->user()->role !== 'Admin') {
              return $this->sendError('You Are Not Authorized To Create Tag');
        }else{
           $input = $request->all();
           
           // Handle is_active checkbox - if not present, set to 0 (inactive)
           $input['is_active'] = isset($input['is_active']) ? 1 : 0;

           $this->tagRepository->store($input);

           return $this->sendSuccess('Tag created successfully.');
        }
        
       
    }

    /**
     * Show the form for editing the specified Tag.
     *
     * @param  Tag  $tag
     * @return JsonResponse
     */
    public function edit(Tag $tag)
    {
       
           $tag->load('departments');

           return $this->sendResponse($tag, 'Tag retrieved successfully.');
        
       
    }

    /**
     * Update the specified Tag in storage.
     *
     * @param  Tag  $tag
     * @param  UpdateTagRequest  $request
     * @return JsonResponse
     */
    public function update(Tag $tag, UpdateTagRequest $request)
    {   if (auth()->user()->role !== 'Admin') {
              return $this->sendError('You Are Not Authorized To Update Tag');
        }else{
        $this->tagRepository->tagUpdate($request->all(), $tag->id);

        return $this->sendSuccess('Tag updated successfully.');
        }
    }

    /**
     * Remove the specified Tag from storage.
     *
     * @param  Tag  $tag
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function destroy(Tag $tag)
    {

        $taskExist = $tag->taskTags()->exists();
        if ($taskExist) {
            return $this->sendError('Tag can\'t be deleted.');
        }

         $tag->departments()->detach();

        $tag->forceDelete();

        return $this->sendSuccess('Tag deleted successfully.');
    }
}
