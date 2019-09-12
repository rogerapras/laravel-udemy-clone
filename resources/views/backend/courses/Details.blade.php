@extends('backend.layouts.app')

@section('title', $course->title . ' | ' . app_name())

@section('content')
    <div class="row">
        <div class="col">
            <base-admin-course-details :course="{{ $course }}"></base-admin-course-details>
        </div><!--col-->
    </div><!--row-->
@endsection
