<div class="row col-12 d-flex flex-nowrap pb-3 leads-kanban-wrp">
   @foreach($leadStages as $index => $stage)
   <div class="col-12 col-md-6 col-lg-6 col-xl-4">
      <div class="card board">
         <div class="card-header bg-light border-0">
            <h4 class="text-primary">{{ html_entity_decode($stage->name) }}</h4>
         </div>
         <div class="card-body p-2 bg-light">
            <div class="infy-loader overlay-screen-lock" style="display: none">
               @include('loader')
            </div>
            <div class="board-{{ $index }}" data-board-stage="{{ $stage->id }}">
               @foreach($allLeads[$stage->id] ?? [] as $lead)
               @php
               $lead = is_array($lead) ? (object) $lead : $lead;
               // Relations
               $lead->source       = isset($lead->source) && is_array($lead->source) ? (object) $lead->source : ($lead->source ?? null);
               $lead->assignedUser = isset($lead->assignedUser) && is_array($lead->assignedUser) ? (object) $lead->assignedUser : ($lead->assignedUser ?? null);
               $lead->leadStage    = isset($lead->leadStage) && is_array($lead->leadStage) ? (object) $lead->leadStage : ($lead->leadStage ?? null);
               // Safe followUps
               $lead->followUps = collect($lead->followUps ?? []);
               // Ensure each follow-up is an object
               $lead->followUps = $lead->followUps->map(function($fu) {
               return is_array($fu) ? (object)$fu : $fu;
               });
               $followUps = $lead->followUps
               ->where('status', '!=', 'completed')
               ->sortBy('follow_up_at');
               $followUpCount = $followUps->count();
               $latestFollowUp = $followUps->first();
               @endphp
               <div class="card mb-3 lead-card" data-id="{{ $lead->id }}" data-stage-id="{{ $lead->stage_id }}">
                  <!-- Card Header: Avatar + Menu -->
                  <div class="card-header d-flex align-items-center justify-content-between p-3">
                     <div class="avatar" style="background-color:#6c63ff;">
                        {{ strtoupper(substr($lead->first_name, 0, 1)) }}{{ strtoupper(substr($lead->last_name, 0, 1)) }}
                     </div>
                     <div>
                        @if($lead->source)
                        <span class="small badge bg-label-info text-uppercase fw-medium px-2 py-1"
                           data-bs-toggle="tooltip"
                           data-bs-placement="right"
                           title="{{ $lead->source->name }}">
                        {{ Str::limit($lead->source->name, 20) }}
                        </span>
                        @endif
                        @php
                        $followUps = collect($lead->followUps)
                        ->where('status', '!=', 'completed')
                        ->sortBy('follow_up_at');
                        $followUpCount = $followUps->count();
                        $latestFollowUp = $followUps->first();
                        @endphp
                        @if($followUpCount > 0)
                        <br>
                        <span class="badge bg-warning text-white">
                        FollowUps: {{ $followUpCount }}
                        </span>
                        @endif
                        @if($latestFollowUp)
                        <br>
                        <small class="text-info">
                        Next FollowUp: {{ ucfirst($latestFollowUp->status) }}
                        ({{ \Carbon\Carbon::parse($latestFollowUp->follow_up_at)->format('M d, Y') }})
                        </small>
                        @endif
                     </div>
                     <div class="menu">
                        <span style="cursor:pointer; font-size: 1.5rem;">&#8942;</span>
                        <div class="menu-content">
                           <a class="quick-view-lead" href="{{ route('leads.show', $lead->id) }}" data-id="{{ $lead->id }}">
                           <i class="fa fa-eye card-view-icon"></i> View
                           </a>
                           <a class="edit-lead" href="{{ route('leads.edit', $lead->id) }}" data-id="{{ $lead->id }}">
                           <i class="fa fa-edit card-edit-icon"></i> Edit
                           </a>
                        </div>
                     </div>
                  </div>
                  <!-- Card Body -->
                  <div class="card-body p-3">
                     <h3 class="mb-1"> {{ trim(($lead->first_name ?? '') . ' ' . ($lead->last_name ?? '')) }}</h3>
                     <p class="text-muted mb-2">{{ $lead->job_title ? $lead->job_title.' @ '.$lead->company : $lead->company }}</p>
                     @if($lead->phone)
                     <div class="contact mb-1"><i class="fa fa-phone"></i> <span>{{ $lead->phone }}</span></div>
                     @endif
                     @if($lead->email)
                     <div class="contact"><i class="fa fa-envelope"></i> <span>{{ $lead->email }}</span></div>
                     @endif
                  </div>
               </div>
               @endforeach
               @if($hasMore[$stage->id] ?? false)
                 <div class="text-center mt-2">
                     <button wire:click="loadMore({{ $stage->id }})" class="btn btn-sm btn-primary">
                         Show More
                     </button>
                 </div>
               @endif

            </div>
         </div>
      </div>
   </div>
   @endforeach
</div>
<!-- Place this script at the end, outside the loop -->
<script>
   document.addEventListener('DOMContentLoaded', function () {
       // Toggle menu on icon click
       document.querySelectorAll('.menu > span').forEach(icon => {
           icon.addEventListener('click', function (e) {
               e.stopPropagation();
               // Close all other menus
               document.querySelectorAll('.menu-content').forEach(mc => mc.style.display = 'none');
               // Toggle this menu
               const menuContent = this.parentElement.querySelector('.menu-content');
               menuContent.style.display = menuContent.style.display === 'block' ? 'none' : 'block';
           });
       });
   
       // Prevent menu-content click from closing itself
       document.querySelectorAll('.menu-content').forEach(mc => {
           mc.addEventListener('click', function (e) {
               e.stopPropagation();
           });
       });
   
       // Close menus when clicking outside
       document.addEventListener('click', function () {
           document.querySelectorAll('.menu-content').forEach(mc => mc.style.display = 'none');
       });
   });
</script>