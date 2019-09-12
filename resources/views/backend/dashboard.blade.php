@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('strings.backend.dashboard.title'))

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div>
                        <strong>@lang('strings.backend.dashboard.welcome') {{ $logged_in_user->name }}!</strong>
                    </div>
                    <base-update-button inline-template>
                        <div v-cloak>
                            @if($currentVersion['success'] == true)
                                @if($currentVersion['update_required'])
                                    {!! __('strings.version_available', ['version' => $currentVersion['version']])  !!} 
                                    <button :disabled="form.busy" class="badge badge-danger rounded-0" @click.prevent="update()">
                                        <span v-if="form.busy">
                                            <i class="fa fa-cog fa-spin"></i> @lang('strings.running_wait') 
                                        </span>   
                                        <span v-else>
                                            @lang('strings.update_now')
                                        </span> 
                                    </button>
                                @else 
                                    @lang('strings.running_latest_version')
                                @endif
                            @else 
                                <span class="badge badge-danger rounded-0">@lang('strings.unable_to_fetch_updates')</span>
                            @endif
                        </div>
                    </base-update-button>

                </div><!--card-header-->
                <div class="card-body card-min-height">
                    {!! __('strings.backend.welcome') !!}

                    {{ json_encode($currentVersion) }}
                    
     
                </div><!--card-body-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
@endsection
