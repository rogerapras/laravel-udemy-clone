@extends('frontend.layouts.install')

@section('content')
<base-installer-database-connection inline-template>
    <form @submit.prevent="submit" v-cloak>
        <div class="card border border-secondary">
            <div class="card-header bg-white py-4">
                <h2 class="h3 m-0">Database Configuration</h2>
            </div>
            <div class="card-body" style="min-height: 50vh;">
                <p>This system uses MySQL database.</p>
                <p>Please enter your MySql Database connection details here.</p>
                <hr />
                <alert-error :form="form" :message="form.errors.get('message')"></alert-error>
                <alert-success :form="form" message="Connection successful. Click NEXT to proceed"></alert-success>
                <div class="form-group form-row">
                    <label class="col-form-label col-md-4 text-right">
                        Database Host
                    </label>
                    <div class="col-md-8">
                        <input v-model="form.db_host" :class="{ 'is-invalid': form.errors.has('db_host') }" 
                            class="form-control form-control-sm border-secondary" type="text" name="db_host">
                        <has-error :form="form" field="db_host"/>
                    </div>
                </div>
                <div class="form-group form-row">
                    <label class="col-form-label col-md-4 text-right">
                        Database Name
                    </label>
                    <div class="col-md-8">
                        <input v-model="form.db_name" :class="{ 'is-invalid': form.errors.has('db_name') }" 
                            class="form-control form-control-sm border-secondary" type="text" name="db_name">
                        <has-error :form="form" field="db_name"/>
                    </div>
                </div>
                <div class="form-group form-row">
                    <label class="col-form-label col-md-4 text-right">
                        Database User
                    </label>
                    <div class="col-md-8">
                        <input v-model="form.db_user" :class="{ 'is-invalid': form.errors.has('db_user') }" 
                            class="form-control form-control-sm border-secondary" type="text" name="db_user">
                        <has-error :form="form" field="db_user"/>
                    </div>
                </div>

                <div class="form-group form-row">
                    <label class="col-form-label col-md-4 text-right">
                        Database Password
                    </label>
                    <div class="col-md-8">
                        <input v-model="form.db_password" :class="{ 'is-invalid': form.errors.has('db_password') }" 
                            class="form-control form-control-sm border-secondary" type="password" name="db_password">
                        <has-error :form="form" field="db_password"/>
                    </div>
                </div>

                <div class="form-group form-row">
                    <label class="col-form-label col-md-4 text-right">
                        Database Port
                    </label>
                    <div class="col-md-8">
                        <input v-model="form.db_port" :class="{ 'is-invalid': form.errors.has('db_port') }" 
                            class="form-control form-control-sm border-secondary" type="text" name="db_port">
                        <has-error :form="form" field="db_port"/>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-transparent d-flex justify-content-end">
                <!-- <a href="{{ route('frontend.installer.requirements') }}" class="btn btn-info btn-sm rounded-0">
                    Previous
                </a> -->
                <a href="{{ route('frontend.installer.settings') }}" class="btn btn-info btn-sm rounded-0" v-if="!form.busy && connection_success">
                    Next
                </a>
                <base-button :disabled="form.busy" class="btn btn-danger btn-sm rounded-0" v-else>
                    <span v-if="form.busy">
                        <i class="fa fa-cog fa-spin"></i>
                        Busy. Please wait...
                    </span>
                    <span v-else>
                        Connect to Database
                    </span>
                </base-button>
            </div>
        </div>
    </form>
</base-installer-database-connection>
@endsection
