<div class="row">

    {{-- Owner Name --}}
    <div class="form-group col-sm-6">
        {{ Form::label('owner_id', 'Owner Name:') }}<span class="required">*</span>

        @php
            $ownerSelectAttributes = ['class' => 'form-control'];
            $defaultOwner = old('owner_id', $property->owner_id ?? auth()->id());

            if (!auth()->user()->hasRole('Admin')) {
                $ownerSelectAttributes['disabled'] = true;
                $defaultOwner = auth()->id();
            }
        @endphp

        {{ Form::select('owner_id', $users, $defaultOwner, $ownerSelectAttributes) }}

        @if(!auth()->user()->hasRole('Admin'))
            {{ Form::hidden('owner_id', $defaultOwner) }}
        @endif
    </div>
    {{-- Property Name --}}
    <div class="form-group col-sm-6">
        {{ Form::label('name', 'Property Name:') }}<span class="required">*</span>
        {{ Form::text('name', old('name', $property->name ?? null), ['class' => 'form-control', 'required']) }}
    </div>

    {{-- Address --}}
    <div class="form-group col-sm-12">
        {{ Form::label('address', 'Address:') }}<span class="required">*</span>
        {{ Form::textarea('address', old('address', $property->address ?? null), ['class' => 'form-control', 'rows' => 2, 'required']) }}
    </div>

    {{-- Total Floors --}}
    <div class="form-group col-sm-6">
        {{ Form::label('total_floors', 'Total Floors:') }}<span class="required">*</span>
        {{ Form::number('total_floors', old('total_floors', $property->total_floors ?? null), ['class' => 'form-control', 'required' => 'required', 
        'min' => '1']) }}
    </div>

    {{-- Total Units --}}
    <div class="form-group col-sm-6">
        {{ Form::label('total_units', 'Total Units:') }}<span class="required">*</span>
        {{ Form::number('total_units', old('total_units', $property->total_units ?? null), ['class' => 'form-control', 'required' => 'required', 
        'min' => '1']) }}
    </div>

    {{-- Description --}}
    <div class="form-group col-sm-12">
        {{ Form::label('description', 'Description:') }}
        {{ Form::textarea('description', old('description', $property->description ?? null), ['class' => 'form-control', 'rows' => 4]) }}
    </div>

    {{-- Status --}}
    @if(auth()->user()->hasRole('Admin'))
    <div class="form-group col-sm-6">
        {{ Form::label('status', 'Status:') }}
        {{ Form::select('status', $statuses, old('status', $property->status ?? 'active'), ['class' => 'form-control']) }}
    </div>
    @endif

    {{-- Land Deed Upload --}}
    <!-- Property attachments / Attachments -->
    <div class="form-group col-sm-12">
        <div class="d-flex justify-content-between">
            <div class="form-group p-0">
                {{ Form::label('attachments', 'Property attachments:') }}
            </div>
    
            <div>
                <button type="button" class="btn btn-sm btn-primary choose-button">
                    <i class="fas fa-plus"></i> Choose
                </button>
    
                <input type="file" name="files[]" id="Add_attachment" 
                       class="d-none" multiple accept="image/*,application/pdf">
            </div>
        </div>
    
        <!-- Preview -->
        <div class="previewImage row" id="previewImage"></div>
    
        <!-- Existing attachments -->
        <div class="attachments-content mt-3">
    
            @if(isset($property) && $property->attachments && $property->attachments->count() > 0)
                <div class="mb-3">
                    <h6>Existing attachments:</h6>
                    <div class="row">
                        @foreach($property->attachments as $doc)
                            <div class="col-md-3 mb-3">
                                <div class="card">
                                    <img src="{{ $doc->file_url }}" 
                                         class="card-img-top"
                                         style="height:150px; object-fit:cover;">
    
                                    <div class="card-body p-2">
                                        <p class="small text-truncate">{{ $doc->file }}</p>
    
                                        <div class="btn-group w-100">
                                            <a href="{{ $doc->file_url }}" target="_blank"
                                               class="btn btn-sm btn-primary">
                                                <i class="fas fa-eye"></i>
                                            </a>
    
                                            <a href="{{ route('properties.download-attachment', $doc->id) }}"
                                               class="btn btn-sm btn-success">
                                                <i class="fas fa-download"></i>
                                            </a>
    
                                            @if(auth()->user()->hasRole('Admin') || auth()->id() == $property->owner_id)
                                                <button type="button"
                                                    class="btn btn-sm btn-danger delete-property-attachment"
                                                    data-id="{{ $doc->id }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            @endif
                                        </div>
    
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
    
        </div>
    </div>

    {{-- Submit --}}
    <div class="form-group col-sm-12 mt-3">
        {{ Form::button('Save', ['type' => 'submit', 'class' => 'btn btn-primary']) }}
        <a href="{{ route('properties.index') }}" class="btn btn-light">Cancel</a>
    </div>

</div>