@extends('frontend.layouts.install')

@section('content')
<base-installer-finish inline-template>
    <form @submit.prevent="submit" v-cloak>
        <div class="card">
            <div class="card-header bg-white py-4">
                <h2 class="h3 m-0">Finish</h2>
            </div>
            <div class="card-body d-flex flex-column justify-content-center text-center align-items-center" style="min-height: 50vh;">
                <p>
                    You're almost done here. You can import some sample data to get started. Don't worry, you can click on a single button in the 
                    admin panel to remove all sample data again if you do not need it.
                </p>
                <hr />
                <div class="custom-control custom-checkbox mr-sm-2 font-14 fw-300 mb-3 text-info">
                    <input id="import" v-model="form.import" value="true" class="custom-control-input form-control-lg" type="checkbox">
                    <label class="custom-control-label" for="import">
                        <p>I want to import sample data</p>
                    </label>
                </div>
                <hr />
                <base-button :disabled="form.busy" class="btn btn-danger btn-md rounded-0">
                    <span v-if="form.busy">
                        <i class="fa fa-cog fa-spin"></i>
                        Busy. Please wait...
                    </span>
                    <span v-else>
                        Finish Installation
                    </span>
                </base-button>
            </div>
        </div>
    </form>
</base-installer-finish>
@endsection
