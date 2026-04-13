<?php

namespace App\Http\Controllers;

use App\Models\Extension;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\CreateExtensionRequest;

class ExtensionController extends Controller
{
    public function index()
    {
        $extensions = Extension::with('user')->get();
        return view('extensions.index', compact('extensions'));
    }

    public function create()
    {
        $users = User::pluck('name', 'id');
        return view('extensions.create', compact('users'));
    }

    public function store(CreateExtensionRequest $request)
    {
        Extension::create($request->validated());
        return redirect()->route('extensions.index')->with('success', 'Extension created successfully.');
    }

    public function edit(Extension $extension)
    {
        $users = User::pluck('name', 'id');
        return view('extensions.edit', compact('extension', 'users'));
    }

    public function update(CreateExtensionRequest $request, Extension $extension)
    {
        //return  $request;
        $extension->update($request->validated());
        return redirect()->route('extensions.index')->with('success', 'Extension updated successfully.');
    }

    public function destroy(Extension $extension)
    {
        $extension->delete();
        return response()->json(['success' => true]);
    }
}
