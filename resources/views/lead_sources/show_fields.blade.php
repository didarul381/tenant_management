<div class="row">
    <div class="form-group col-md-6">
        <label class="font-weight-bold">{{ __('messages.lead_sources.name') }} :</label>
        <p>{{ html_entity_decode($leadSource->name) }}</p>
    </div>

    <div class="form-group col-md-6">
        <label class="font-weight-bold">{{ __('messages.lead_sources.description') }} :</label>
        <p>{!! !empty($leadSource->description) ? html_entity_decode($leadSource->description) : __('messages.common.n/a') !!}</p>
    </div>

    <div class="form-group col-md-6">
        <label class="font-weight-bold">{{ __('messages.common.created_by') }} :</label>
        <p>{{ !empty($leadSource->user->name) ? html_entity_decode($leadSource->user->name) : __('messages.common.n/a') }}</p>
    </div>

    <div class="form-group col-md-6">
        <label class="font-weight-bold">{{ __('messages.common.created_on') }} :</label>
        <p>
            <span data-toggle="tooltip" data-placement="right"
                  title="{{ \Carbon\Carbon::parse($leadSource->created_at)->translatedFormat('jS M, Y') }}">
                {{ $leadSource->created_at->diffForHumans() }}
            </span>
        </p>
    </div>

    <div class="form-group col-md-6">
        <label class="font-weight-bold">{{ __('messages.common.last_updated') }} :</label>
        <p>
            <span data-toggle="tooltip" data-placement="right"
                  title="{{ \Carbon\Carbon::parse($leadSource->updated_at)->translatedFormat('jS M, Y') }}">
                {{ $leadSource->updated_at->diffForHumans() }}
            </span>
        </p>
    </div>
</div>
