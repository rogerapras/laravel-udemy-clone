@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('strings.backend.dashboard.title'))

@section('content')
<base-admin-sales-chart inline-template v-cloak>
<div>
    <div class="row">
        <!-- Sales this period -->
        <div class="col-6 col-lg-3">
            <div class="card">
                <div class="card-body p-0 d-flex align-items-center">
                    <i class="fas fa-money-bill-alt bg-primary p-4 font-2xl mr-3"></i>
                    <div>
                        <div class="text-value-sm text-primary">
                            <div class="text-value-sm text-primary">@{{ formatCurrency(total_sales, false) }}</div>
                            <!-- <base-currency :price="total_sales" :showFree="false"></base-currency> -->
                        </div>
                        <div class="text-muted text-uppercase font-weight-bold small">
                            @{{ trans('strings.sales_last_x_days', {days: period} ) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lifetime Sales -->
        <div class="col-6 col-lg-3">
            <div class="card">
                <div class="card-body p-0 d-flex align-items-center">
                    <i class="fas fa-money-bill-alt bg-primary p-4 font-2xl mr-3"></i>
                    <div>
                        <div class="text-value-sm text-primary">
                            <div class="text-value-sm text-primary">@{{ formatCurrency(lifetime_sales, false) }}</div>
                        </div>
                        <div class="text-muted text-uppercase font-weight-bold small">
                            @{{ trans('strings.lifetime_sales' ) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings this period -->
        <div class="col-6 col-lg-3">
            <div class="card">
                <div class="card-body p-0 d-flex align-items-center">
                    <i class="fas fa-money-bill-alt bg-success p-4 font-2xl mr-3"></i>
                    <div>
                        <div class="text-value-sm text-primary">
                            <div class="text-value-sm text-primary">@{{ formatCurrency(total_earnings, false) }}</div>
                            <!-- <base-currency :price="total_sales" :showFree="false"></base-currency> -->
                        </div>
                        <div class="text-muted text-uppercase font-weight-bold small">
                            @{{ trans('strings.earnings_last_x_days', {days: period} ) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Lifetime Earnings -->
        <div class="col-6 col-lg-3">
            <div class="card">
                <div class="card-body p-0 d-flex align-items-center">
                    <i class="fas fa-money-bill-alt bg-success p-4 font-2xl mr-3"></i>
                    <div>
                        <div class="text-value-sm text-primary">
                            <div class="text-value-sm text-primary">@{{ formatCurrency(lifetime_earnings, false) }}</div>
                        </div>
                        <div class="text-muted text-uppercase font-weight-bold small">
                            @{{ trans('strings.lifetime_earnings' ) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        


    </div>


    <div class="row">
        <div class="col-md-8">
            <div class="card card-accent-success">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h5>@{{ trans('strings.sales_last_x_days', { days: period } ) }}</h5>
                        </div>
                        <div class="col-md-4">
                        
                            <select class="form-control form-control-sm pull-right" v-model="period" @change="fetchSalesData()">
                                <option value="7">@lang('strings.last_x_days', ['days' => 7])</option>
                                <option value="30">@lang('strings.last_x_days', ['days' => 30])</option>
                                <option value="60">@lang('strings.last_x_days', ['days' => 60])</option>
                                <option value="90">@lang('strings.last_x_days', ['days' => 90])</option>
                                <option value="180">@lang('strings.last_x_days', ['days' => 180])</option>
                            </select>
                        </div>
                    </div>
                </div><!--card-header-->

                <div class="card-block">
                    <area-chart :data="chartData" :discrete="true" :ytitle="trans('strings.sales')" 
                        :download="true" :curve="false" legend="top" label="Sales"
                            v-if="show_chart"></area-chart>

                </div><!--card-block-->
            </div><!--card-->
            
        </div><!--col-->


        <!-- Right side -->
        <div class="col-md-4">
            xx

        </div>

    </div><!--row-->

</div>
</base-admin-sales-chart>
@endsection
