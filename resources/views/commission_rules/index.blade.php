@extends('layouts.app')

@section('title')
    Commission Rules
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1 class="page__heading">Commission Rules</h1>
        <div class="section-header-breadcrumb">
            <a class="btn btn-primary" href="{{ route('commission-rules.create') }}">
                <i class="fas fa-plus"></i> Add New Rule
            </a>
        </div>
    </div>

    <div class="section-body">
        @include('flash::message')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Serial</th>
                                    <th>Project</th>
                                    <th>Primary Member</th>
                                    <th>Secondary Member</th>
                                    <th>Priority</th>
                                    <th>Created Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($rules as $index => $rule)
                                    <tr>
                                        <td>{{ ($rules->currentPage()-1) * $rules->perPage() + $index + 1 }}</td>
                                        <td>{{ $rule->projects_count }}</td>
                                        <td>{{ $rule->principal_users_count ?? $rule->principalUsers()->count() }}</td>
                                        <td>{{ $rule->secondary_users_count ?? $rule->secondaryUsers()->count() }}</td>
                                         <td>{{ $rule->priority }}</td>
                                        <td>{{ $rule->created_at?->format('M d, Y') }}</td>
                                        <td>
                                            <a href="{{ route('commission-rules.show', $rule) }}" class="btn btn-sm btn-info">View</a>
                                            <a href="{{ route('commission-rules.edit', $rule) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('commission-rules.destroy', $rule) }}" method="POST" style="display:inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this rule?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No Rules Found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            {{ $rules->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
