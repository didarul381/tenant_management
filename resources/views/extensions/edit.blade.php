@extends('layouts.app')

@section('title', 'Edit Extension')

@section('content')
<section class="section">
    <div class="section-header d-flex justify-content-between">
        <h1>Edit Extension</h1>
        <a href="{{ route('extensions.index') }}" class="btn btn-light">Back</a>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-body">
                @include('layouts.errors')

                {{ Form::model($extension, ['route' => ['extensions.update', $extension->id], 'method' => 'put']) }}
                
                <!-- User -->
                <div class="form-group">
                    {{ Form::label('user_id', 'User:') }}
                    {{ Form::select('user_id', $users, old('user_id', $extension->user_id), ['class' => 'form-control', 'required']) }}
                </div>

                <!-- Source -->
                <div class="form-group">
                    {{ Form::label('source', 'Source:') }}
                    {{ Form::text('source', old('source', $extension->source), ['class' => 'form-control', 'required']) }}
                </div>
                <!-- Status -->
                <div class="form-group">
                    {{ Form::label('status', 'Status:') }}
                    {{ Form::select('status', ['Active' => 'Active', 'Inactive' => 'Inactive'], old('status', $extension->status), ['class' => 'form-control', 'required']) }}
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('extensions.index') }}" class="btn btn-light">Cancel</a>

                {{ Form::close() }}
            </div>
        </div>
    </div>
</section>
@endsection
