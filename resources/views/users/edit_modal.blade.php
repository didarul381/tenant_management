<div id="EditModal" class="modal fade" role="dialog" tabindex="-1">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('messages.user.edit_user') }}</h5>
                <button type="button" aria-label="Close" class="close outline-none" data-dismiss="modal">×</button>
            </div>
            {{ Form::open(['id'=>'editForm','files'=>true]) }}
            <div class="modal-body">
                <div class="alert alert-danger display-none" id="editValidationErrorsBox"></div>
                {{ Form::hidden('user_id',null,['id'=>'userId']) }}
                @php
                $weekly_holidays=[
                    1 => __('Friday'),
                    2 => __('Saturday'),
                    3 => __('Sunday'),
                    4 => __('Monday'),
                    5 => __('Tuesday'),
                    6 => __('Wednesday'),
                    7 => __('Thursday'),
                ];
                @endphp
                <div class="row">
                    <div class="form-group col-sm-4">
                        {{ Form::label('name', __('messages.user.name').':') }}<span class="required">*</span>
                        {{ Form::text('name', null, ['id'=>'edit_name','class' => 'form-control','required', 'autofocus', 'tabindex' => "1"]) }}
                    </div>
                    <div class="form-group col-sm-4">
                        {{ Form::label('phone', __('messages.user.phone').':') }}
                        {{ Form::text('phone', null, ['id'=>'edit_phone','class' => 'form-control','onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")','minlength=10','maxlength=11','tabindex' => "2"]) }}
                    </div>
                    <div class="form-group col-sm-4">
                        {{ Form::label('email', __('messages.user.email').':') }}<span class="required">*</span>
                        {{ Form::email('email', null, ['id'=>'edit_email','class' => 'form-control','required',"autocomplete"=>"new-password", 'tabindex' => "3"]) }}
                    </div>
                </div>
               
                <div class="row">
                     <!-- <div class="form-group col-sm-6 user-projects">
                        {{ Form::label('project_id', __('messages.user.project').':') }}
                        {{ Form::select('project_ids[]', $projects, null, ['class' => 'form-control','id' => 'editProjectId', 'multiple'=>true, 'tabindex' => "4"]) }}
                    </div> -->
                    <div class="form-group col-sm-6 user-projects">
                        {{ Form::label('project_id', __('messages.user.project').':') }}
                        <div class="project-stats-container">
                            <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded">
                                <div class="text-center">
                                    <h5 class="mb-0 text-primary" id="totalProjects">0</h5>
                                    <small class="text-muted">Total Assigned Jobs</small>
                                </div>
                                <div class="text-center">
                                    <h5 class="mb-0 text-warning" id="incompleteProjects">0</h5>
                                    <small class="text-muted">Jobs with Incomplete Tasks</small>
                                </div>
                            </div>
                        </div>
                    </div>
                     <div class="form-group col-sm-6">
                        {{ Form::label('salary',  __('messages.user.salary').':') }}
                        {{ Form::text('salary', null, ['id'=>'edit_salary','class' => 'form-control price-input', 'autocomplete' => 'off',  'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")', 'tabindex' => "7"]) }}
                    </div>
                </div>
                <div class="row">
                  <div class="form-group col-sm-4 user-department">
                      {{ Form::label('department_id', __('messages.user.department').':') }}
                      {{ Form::select('department_id', $departments, null, [
                          'class' => 'form-control', 
                          'id' => 'editDepartmentId', 
                          'placeholder' => __('Select Department'), 
                          'tabindex' => "5"
                      ]) }}
                  </div>
                  <div class="form-group col-sm-4">
                        {{ Form::label('active', __('messages.user.role').':') }}<span class="required">*</span>
                        {{ Form::select('role_id', $roles, null, ['class' => 'form-control', 'id' => 'editRoleId', 'tabindex' => "6"]) }}
                  </div>

                  <div class="form-group col-sm-4">
                        {{ Form::label('weekly_holidays', __('Weekly Holidays').':') }}
                        {{ Form::select('weekly_holidays[]', $weekly_holidays, null, ['class' => 'form-control', 'id' => 'editWeeklyHolidays', 'multiple'=>true, 'tabindex' => "9"]) }}
                  </div>

                </div>
               
                <div class="row">
                    <div class="form-group col-sm-6">
                        {{ Form::label('joining_date', __('Joining Date').':') }}
                        {{ Form::text('joining_date', null, ['class' => 'form-control', 'id' => 'editJoiningDate', 'placeholder' => 'Select Joining Date', 'tabindex' => "8"]) }}
                    </div>
                     <div class="form-group col-sm-6">
                        {{ Form::label('office_time', __('Office Time').':') }}
                        <div class="row">
                            <div class="col-sm-6">
                               
                                {{ Form::time('office_from_time', null, ['class' => 'form-control', 'id' => 'editOfficeFromTime']) }}
                            </div>
                            <div class="col-sm-6">
                              
                                {{ Form::time('office_to_time', null, ['class' => 'form-control', 'id' => 'editOfficeToTime']) }}
                            </div>
                        </div>
                    </div>
                </div>
               
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    {{ Form::label('photo', __('messages.user.profile_image').':') }} <br>
                                    <label
                                            class="image__file-upload btn btn-primary text-color-white"
                                            tabindex="7"> {{ __('messages.setting_menu.choose') }}
                                        {{ Form::file('photo',['id'=>'userEditProfile','class' => 'd-none']) }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class=" preview-image-video-container">
                                    <img id='editPreviewImage' class="img-thumbnail thumbnail-preview"
                                         src="{{asset('assets/img/user-avatar.png')}}"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <div class="form-group">
                            {{ Form::label('role_id', __('messages.task.status').':') }}<br>
                            <label class="custom-switch pl-0">
                                <input type="checkbox" name="is_active" class="custom-switch-input" id="edit_is_active"
                                       tabindex="8">
                                <span class="custom-switch-indicator"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <div class="form-group">
                            {{ Form::label('email_verified_at', __('messages.user.email_is_verified').':') }}<br>
                            <label class="custom-switch pl-0">
                                <input type="checkbox" name="email_verified_at" class="custom-switch-input" id="edit_email_verified_at"
                                       tabindex="9">
                                <span class="custom-switch-indicator"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <div class="form-group">
                             {{ Form::label('hold_account', __('Hold Account').':') }}
                            <label class="custom-switch pl-0">
                                <input type="checkbox" name="hold_account" class="custom-switch-input" id="edit_hold_account"
                                       tabindex="9">
                                <span class="custom-switch-indicator"></span>
                            </label>
                        </div>
                    </div>
                </div>
                
                <!-- Bank Information Section -->
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label class="custom-switch pl-0 d-block">
                                <input type="checkbox" name="has_bank_info" class="custom-switch-input" id="editHasBankInfo" value="1" tabindex="10">
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description">{{ __('Add Bank Information') }}</span>
                            </label>
                        </div>
                    </div>
                </div>
                
                <!-- Bank Info Fields (Initially Hidden) -->
                <div id="editBankInfoFields" style="display: none;">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            {{ Form::label('bank_name', 'Bank Name:') }}<span class="bank-required" style="color: red; font-weight: bold;">*</span>
                            {{ Form::text('bank_name', null, ['id'=>'edit_bank_name','class' => 'form-control bank-field', 'tabindex' => "11"]) }}
                        </div>
                        <div class="form-group col-sm-6">
                            {{ Form::label('account_name', 'Account Name:') }}<span class="bank-required" style="color: red; font-weight: bold;">*</span>
                            {{ Form::text('account_name', null, ['id'=>'edit_account_name','class' => 'form-control bank-field', 'tabindex' => "12"]) }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            {{ Form::label('account_number', 'Account Number:') }}<span class="bank-required" style="color: red; font-weight: bold;"    >*</span>
                            {{ Form::text('account_number', null, ['id'=>'edit_account_number','class' => 'form-control bank-field', 'tabindex' => "13"]) }}
                        </div>
                        <div class="form-group col-sm-6">
                            {{ Form::label('branch_name', 'Branch Name:') }}<span class="bank-required">*</span>
                            {{ Form::text('branch_name', null, ['id'=>'edit_branch_name','class' => 'form-control bank-field', 'tabindex' => "14"]) }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            {{ Form::label('branch_routing_number', 'Branch Routing Number:') }}<span class="bank-required" style="color: red; font-weight: bold;">*</span>
                            {{ Form::text('branch_routing_number', null, ['id'=>'edit_branch_routing_number','class' => 'form-control bank-field', 'tabindex' => "15"]) }}
                        </div>
                        <div class="form-group col-sm-6">
                            {{ Form::label('swift_code', 'Swift Code:') }}
                            {{ Form::text('swift_code', null, ['id'=>'edit_swift_code','class' => 'form-control bank-field', 'tabindex' => "16"]) }}
                        </div>
                    </div>
                </div>
                
                <div class="text-right">
                    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnEditSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing...", 'tabindex' => "17"]) }}
                    <button type="button" class="btn btn-light ml-1"
                            data-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
