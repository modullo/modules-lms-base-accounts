@extends('layouts.themes.tabler.tabler')

@section('head_js')

@endsection


@section('body_content_main')
    @include('modules-lms-base::navigation',['type' => 'tenant'])
{{--        <h3 class="text-h4 text-blue-light mb-4">My Profile</h3>--}}
        <div class="rounded-md row" style="min-height:100vh">
            <div class="col-lg-9 col-md-9 col-12 py-6 pl-6 mx-auto">
                <div class="rounded-circle border mx-auto" style="height:100px; width:100px; "></div>
                <h3 class="text-h5 text-blue-light mb-4 font-bold">Edit Profile</h3>
                <div class="w-8/12">
                    <div class="flex items-center justify-center h-16 w-16 mx-auto bg-white border-2 border-yellow rounded-full">
                        <i class="ri-user-line text-h3 ri-fw text-black"></i>
                    </div>
                    <div class=" mb-4">
                        <div class="my-3">
                            <label class="text-medium font-normal text-gray-base mb-1">First name</label>
                            <input type="text" v-model="user.firstName" placeholder="Enter a region" class="form-control">
                        </div>
                    </div>
                    <div class="">
                        <div class="my-3>
                                <label class="text-medium font-normal text-gray-base mb-1">Last name</label>
                        <input type="text" v-model="user.lastName" placeholder="Enter a region" class="form-control">
                    </div>

                    <div class="mb-4">
                        <label class="text-medium font-normal text-gray-base mb-1">Email</label>
                        <input type="email" v-model="user.email" placeholder="Enter a region" class="form-control">
                    </div>
                    <div class="mt-3 mb-6">
                        <label class="text-medium font-normal text-gray-base mb-1">Phone number</label>
                        <input type="email" v-model="user.email" placeholder="Enter a region" class="form-control">
                    </div>
                    <button class="btn btn-primary btn-block py-3">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('body_js')

    {{--    <script src="{{ asset('js/app.js') }}"></script>--}}
@endsection


