@extends('layouts.app')

@section('title')
    Commission Rule Details
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1 class="page__heading">Commission Rule Details</h1>
        <div class="section-header-breadcrumb">
            <a class="btn btn-secondary mr-2" href="{{ route('commission-rules.index') }}">Back</a>
            <a class="btn btn-warning" href="{{ route('commission-rules.edit', $rule) }}">Edit</a>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div><strong>Total %:</strong> {{ $rule->total_percentage }}</div>
                            </div>
                            <div class="col-md-3">
                                <div><strong>Primary %:</strong> {{ $rule->principal_percentage }}</div>
                            </div>
                            <div class="col-md-3">
                                <div><strong>Secondary %:</strong> {{ $rule->secondary_percentage }}</div>
                            </div>
                            <div class="col-md-3">
                                <div><strong>Priority:</strong> {{ $rule->priority }}</div>
                            </div>
                        </div>
                        <hr>
                        <div class="row m-auto">
                            <div class="col-md-4">
                                <h6>Projects ({{ $rule->projects->count() }})</h6>
                                <ul class="mb-0">
                                    @foreach($rule->projects as $p)
                                        <li>{{ $p->name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h6>Primary Members ({{ $rule->principalUsers->count() }})</h6>
                                <ul class="mb-0">
                                    @foreach($rule->principalUsers as $u)
                                        <li>{{ $u->name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h6>Secondary Members ({{ $rule->secondaryUsers->count() }})</h6>
                                <ul class="mb-0">
                                    @foreach($rule->secondaryUsers as $u)
                                        <li>{{ $u->name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4"><strong>Created:</strong> {{ $rule->created_at?->format('M d, Y H:i') }}</div>
                            <div class="col-md-4"><strong>Updated:</strong> {{ $rule->updated_at?->format('M d, Y H:i') }}</div>
                            <!-- <div class="col-md-4"><strong>Deleted At:</strong> {{ $rule->deleted_at }}</div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
