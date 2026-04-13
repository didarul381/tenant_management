@extends('layouts.app')

@section('title')
    New Commission Rule
@endsection

@section('scripts')
<script>
    $(function(){
        $('select[name="projects[]"]').select2({
            width: '100%',
            closeOnSelect: false,
            placeholder: $('select[name="projects[]"]').data('placeholder') || 'Select Projects',
            allowClear: true
        });
        $('select[name="principal_users[]"]').select2({
            width: '100%',
            closeOnSelect: false,
            placeholder: $('select[name="principal_users[]"]').data('placeholder') || 'Select Principal Members',
            allowClear: true
        });
        $('select[name="secondary_users[]"]').select2({
            width: '100%',
            closeOnSelect: false,
            placeholder: $('select[name="secondary_users[]"]').data('placeholder') || 'Select Secondary Members',
            allowClear: true
        });
    });
</script>
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1 class="page__heading">Add Commission Rule</h1>
    </div>

    <div class="section-body">
        @include('flash::message')
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('commission-rules.store') }}">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Total Percentage</label>
                                    <input type="number" min="1" max="100" name="total_percentage" class="form-control" value="{{ old('total_percentage') }}" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Primary Percentage</label>
                                    <input type="number" min="0" max="100" name="principal_percentage" class="form-control" value="{{ old('principal_percentage') }}" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Secondary Percentage</label>
                                    <input type="number" min="0" max="100" name="secondary_percentage" class="form-control" value="{{ old('secondary_percentage') }}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Priority</label>
                                    <input type="number" min="1" name="priority" class="form-control" value="{{ old('priority', 1) }}" required>
                                </div>
                                <div class="form-group  col-md-6">
                                <label>Projects</label>
                                <select name="projects[]" class="form-control select2" multiple required data-placeholder="Select Projects">
                                    @foreach($projects as $project)
                                        <option value="{{ $project->id }}" {{ collect(old('projects', []))->contains($project->id) ? 'selected' : '' }}>
                                            {{ $project->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            </div>

                            
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Primary Members</label>
                                    <select name="principal_users[]" class="form-control select2" multiple required data-placeholder="Select Principal Members">
                                        @foreach($usersByDept as $deptName => $users)
                                            <optgroup label="{{ $deptName }}">
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}" {{ collect(old('principal_users', []))->contains($user->id) ? 'selected' : '' }}>
                                                        {{ $user->name }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Secondary Members</label>
                                    <select name="secondary_users[]" class="form-control select2" multiple required data-placeholder="Select Secondary Members">
                                        @foreach($usersByDept as $deptName => $users)
                                            <optgroup label="{{ $deptName }}">
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}" {{ collect(old('secondary_users', []))->contains($user->id) ? 'selected' : '' }}>
                                                        {{ $user->name }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="text-right">
                                <a href="{{ route('commission-rules.index') }}" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
