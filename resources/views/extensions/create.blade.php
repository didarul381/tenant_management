@extends('layouts.app')

@section('title', 'New Extension')

@section('content')
<section class="section">
    <div class="section-header d-flex justify-content-between">
        <h1>New Extension</h1>
        <a href="{{ route('extensions.index') }}" class="btn btn-light">Back</a>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-body">
                @include('layouts.errors')

                {{ Form::open(['route' => 'extensions.store', 'method' => 'post']) }}
                
                <!-- User -->
                <div class="form-group">
                    {{ Form::label('user_id', 'User:') }}
                    {{ Form::select('user_id', $users, old('user_id'), ['class' => 'form-control', 'required']) }}
                </div>

                <!-- Source -->
                <div class="form-group">
                    {{ Form::label('source', 'Source:') }}
                    {{ Form::text('source', old('source'), ['class' => 'form-control', 'required']) }}
                </div>
                <!-- Status -->
                <div class="form-group">
                    {{ Form::label('status', 'Status:') }}
                    {{ Form::select('status', ['Active' => 'Active', 'Inactive' => 'Inactive'], old('status', 'Active'), ['class' => 'form-control', 'required']) }}
                </div>


                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('extensions.index') }}" class="btn btn-light">Cancel</a>

                {{ Form::close() }}
            </div>
        </div>
    </div>
</section>
@endsection
