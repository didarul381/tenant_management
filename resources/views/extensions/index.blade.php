@extends('layouts.app')

@section('title', 'Extensions')

@section('content')
<section class="section">
    <div class="section-header d-flex justify-content-between">
        <h1>Extensions</h1>
        <a href="{{ route('extensions.create') }}" class="btn btn-primary">New Extension</a>
    </div>

    <div class="section-body">
        @include('flash::message')

        <div class="card">
            <div class="card-body">
                <table class="table table-bordered" id="extensions_table">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Source</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($extensions as $extension)
                        <tr>
                            <td>{{ $extension->user->name ?? 'N/A' }}</td>
                            <td>{{ $extension->source }}</td>
                            <td>
                                <span class="badge {{ $extension->status == 'Active' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $extension->status }}
                                </span>
                            </td>
                            <td>{{ $extension->created_at->format('Y-m-d H:i') }}</td>
                            <td>
                                <a href="{{ route('extensions.edit', $extension->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <button data-url="{{ route('extensions.destroy', $extension->id) }}" class="btn btn-sm btn-danger delete-btn">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
$(document).on('click', '.delete-btn', function() {
    let url = $(this).data('url');
    if(confirm('Are you sure?')) {
        $.ajax({
            url: url,
            type: 'DELETE',
            success: function(res) {
                location.reload();
            }
        });
    }
});
</script>
@endsection
