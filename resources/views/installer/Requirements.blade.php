@extends('frontend.layouts.install')

@section('content')
    <base-installer-requirements inline-template>
        <div class="card border border-secondary " v-cloak>
            <div class="card-header bg-white py-4">
                <h2 class="h4 m-0">Server Requirements</h2>
            </div>

            <div class="card-body d-flex flex-column align-items-center justify-content-center" style="min-height: 50vh;">
                <vue-element-loading :active="form.busy" :is-full-screen="false" spinner="bar-fade-scale" color="#ea5352"></vue-element-loading>

                <template v-if="Object.keys(messages).length == 0">
                    <div class="alert alert-success">
                        <p>
                            Your server seems to meet the minimum requirements to run the application. Click on "NEXT".
                        </p>
                    </div>
                </template>
                <template v-else>
                    <div class="alert alert-danger">
                        Address the following server issues. Please fix them and then click on 
                        "RE-RUN CHECK"
                    </div>
                    <ul class="fa-ul">
                        <li v-for="item in messages">
                            <i class="fa-li fa fa-times-circle text-danger"></i>@{{ item }}
                        </li>
                    </ul>
                </template>
            </div>
            <div class="card-footer bg-transparent d-flex justify-content-end">
                <!-- <a href="{{ route('frontend.installer.index') }}" class="btn btn-sm rounded-0 btn-info">
                    Previous
                </a> -->
                <a href="{{ route('frontend.installer.database') }}" class="btn btn-sm rounded-0 btn-info" v-if="Object.keys(messages).length == 0">
                    Next
                </a>
                <button @click.prevent="checkRequirements()" class="btn btn-sm rounded-0 btn-danger" v-else>
                    Re-run check
                </button>
            </div>
        </div>
    </base-installer-requirements>
@endsection
