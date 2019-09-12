@extends('frontend.layouts.app')
@section('title', __('strings.change_password') . ' | ' . app_name())
@section('content')
    <div class="user-account-setting">
        <div class="container">
            <div class="row">
                <div class="col-md-3 course__author__menu">
                    @include('frontend.user.account._sidebar')
                </div>

                <div class="col-md-9">
                    <div class="setting-block shadow-sm" id="list-item-1">
                        <div class="setting-title font-22 fw-300">
                            @lang('strings.change_password')
                        </div>
                        
                        <div class="setting-body white-bg-color">
                            {{ html()->form('PATCH', route('frontend.auth.password.update'))->open() }}
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- Old PSWD -->
                                    <div class="form-group">
                                        <label class="col-form-label">@lang('validation.attributes.frontend.old_password')</label>
                                        <input class="form-control rounded-0" type="password" name="old_password" required>
                                    </div>

                                    <!-- New PSWD -->
                                    <div class="form-group">
                                        <label class="col-form-label">@lang('validation.attributes.frontend.password')</label>
                                        <input class="form-control rounded-0" type="password" name="password" required>
                                    </div>
                                    
                                    <!-- Confirm New PSWD -->
                                    <div class="form-group">
                                        <label class="col-form-label">@lang('validation.attributes.frontend.password_confirmation')</label>
                                        <input class="form-control rounded-0" type="password" name="password_confirmation" required>
                                    </div>
                                </div><!--/ END RIGHT SIDE -->

                                <!-- Submit Button -->
                                <div class="col-md-12">
                                    <button class="btn btn-danger btn-md rounded-0">
                                        @lang('labels.general.buttons.update')
                                    </button>
                                </div>
                            
                            </div>

                            {{ html()->form()->close() }}
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
@endsection
