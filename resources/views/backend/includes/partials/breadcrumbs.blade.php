@if($breadcrumbs)
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <i class="fas fa-home"></i>
            @lang('strings.home')
        </li>

        @foreach($breadcrumbs as $breadcrumb)
            @if($breadcrumb->url && !$loop->last)
                <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
            @else
                <li class="breadcrumb-item active">{{ $breadcrumb->title }}</li>
            @endif
        @endforeach

        @yield('breadcrumb-links')

        @php 
            $currentVersion = get_latest_version_info();
            $licenseCheck = check_envato_license();
        @endphp

        @if($licenseCheck['success'] == true)
            <li class="breadcrumb-menu d-md-down-none">
                <base-update-button inline-template>
                    <div v-cloak>
                        @if($currentVersion['success'] == true)
                            @if($currentVersion['update_required'])
                                {!! clean(__('strings.version_available', ['version' => $currentVersion['version']]))  !!} 
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
                            <span class="badge badge-danger rounded-0">
                                <i class="fas fa-exclamation-circle"></i>
                                @lang('strings.unable_to_fetch_updates')
                            </span>
                        @endif
                    </div>
                </base-update-button>
            </li>
        @else
            <li class="breadcrumb-menu d-md-down-none">
                <span class="badge badge-danger font-13 rounded-0">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $licenseCheck['message'] }}
                </span>
            </li>
        @endif
    </ol>
@endif
