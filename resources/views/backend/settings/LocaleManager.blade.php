@extends('backend.layouts.app')

@section('title', __('strings.site_settings') . ' | ' . app_name())

@section('content')
    <div class="row">
        <div class="col-md-12">
            <base-locale-manager 
                :locales="{{ json_encode($locales) }}"
                :translations="{{ json_encode($translations) }}"></base-locale-manager>
        </div><!--col-->
    </div><!--row-->
@endsection
