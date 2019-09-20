@extends('backend.layouts.app')

@section('title', __('strings.site_settings') . ' | ' . app_name())

@section('content')
    <div class="row">
        <div class="col-md-12">
            <base-locale-manager></base-locale-manager>
        </div><!--col-->
    </div><!--row-->
@endsection
