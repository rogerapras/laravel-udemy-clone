@extends('backend.layouts.app')

@section('title', __('strings.coupons') . ' | ' . app_name())

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <strong>@lang('strings.discount_coupons')</strong>
                </div>
                <div class="card-body card-min-height">
                    <base-admin-coupons></base-admin-coupons>
                </div><!--card-body-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
@endsection
