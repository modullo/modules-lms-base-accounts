
@extends('layouts.themes.tabler.tabler')

@section('head_js')

@endsection

@section('head_css')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        .breadcrumb-item + .breadcrumb-item::before {
            content: ">>";
        }
    </style>
@endsection


@section('body_content_main')
    @include('modules-lms-base::navigation',['type' => 'tenant'])
    <div id="app">
        <breadcrumbs 
            :items="[
                {url: '/tenant/dashboard', title: 'Home', active: false},
                {url: '/tenant/learners', title: 'Learners', active: false},
                {url: '', title: 'Create Learner', active: true},
            ]">
        </breadcrumbs>
        <div class="container">
            <h3 class="mt-5">Create Learner</h3>

            <div class="mx-auto mt-5 card col">
                <div class="card-body">
                    <form class="form" @submit.prevent="validateBeforeSubmit">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="first_name">First Name *</label>
                                <p class="control has-icon has-icon-right">
                                    <input id="first_name" name="first_name" class="form-control" v-model="form.first_name" v-validate="'required'"
                                        :class="{'input': true, 'border border-danger': errors.has('first_name') }" type="text"
                                        placeholder="Enter first name">
                                    <i v-show="errors.has('first_name')" class="fa fa-warning text-danger"></i>
                                    <span v-show="errors.has('first_name')" class="help text-danger">@{{ errors . first('first_name') }}</span>
                                </p>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="last_name">Last Name *</label>
                                <p class="control has-icon has-icon-right">
                                    <input id="last_name" name="last_name" class="form-control" v-model="form.last_name" v-validate="'required'"
                                        :class="{'input': true, 'border border-danger': errors.has('last_name') }" type="text"
                                        placeholder="Enter last name">
                                    <i v-show="errors.has('last_name')" class="fa fa-warning text-danger"></i>
                                    <span v-show="errors.has('last_name')" class="help text-danger">@{{ errors . first('last_name') }}</span>
                                </p>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email *</label>
                                <p class="control has-icon has-icon-right">
                                    <input id="email" name="email" class="form-control" v-model="form.email" v-validate="'required'"
                                        :class="{'input': true, 'border border-danger': errors.has('email') }" type="text"
                                        placeholder="Enter email address">
                                    <i v-show="errors.has('email')" class="fa fa-warning text-danger"></i>
                                    <span v-show="errors.has('email')" class="help text-danger">@{{ errors . first('email') }}</span>
                                </p>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone_number">Phone Number *</label>
                                <p class="control has-icon has-icon-right">
                                    <input id="phone_number" name="phone_number" class="form-control" v-model="form.phone_number" v-validate="'required'"
                                        :class="{'input': true, 'border border-danger': errors.has('phone_number') }" type="text"
                                        placeholder="Enter phone number">
                                    <i v-show="errors.has('phone_number')" class="fa fa-warning text-danger"></i>
                                    <span v-show="errors.has('phone_number')" class="help text-danger">@{{ errors . first('phone_number') }}</span>
                                </p>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password">Password</label>
                                <p class="control has-icon has-icon-right">
                                    <input id="password" name="password" class="form-control" v-model="form.password"
                                        :class="{'input': true, 'border border-danger': errors.has('password') }" type="password"
                                        placeholder="Enter password">
                                    <i v-show="errors.has('password')" class="fa fa-warning text-danger"></i>
                                    <span v-show="errors.has('password')" class="help text-danger">@{{ errors . first('password') }}</span>
                                </p>
                            </div>
                        </div>

                        <div class="submit-btn d-flex justify-content-between align-items-center">
                            <span class="muted">
                                fields with *  are required
                            </span>
                            <button type="submit" class="btn btn-outline-secondary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="text-center"><h3>OR</h3></div>
            <div class="mx-auto mt-5 card col">
                <div class="card-body">
                    <form class="form" @submit.prevent="uploadCSV">
                        <div class="form-row">
                            <div class="form-group col-md-6 offset-md-3">
                                <label for="">Import learner data from CSV file </label>
                                <div class="input-group mb-3">
                                    <input type="file" v-on:change="accessCSV" class="mx-auto form-control" aria-describedby="fileHelpId" placeholder="Select CSV file" accept="text/csv" />
                                    <div class="input-group-append">
                                        <button class="btn btn-success" type="submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('body_js')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <!-- jsdelivr cdn -->
    <script src="https://cdn.jsdelivr.net/npm/vee-validate@<3.0.0/dist/vee-validate.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/vue-loading-overlay@3"></script>
    <link href="https://cdn.jsdelivr.net/npm/vue-loading-overlay@3/dist/vue-loading.css" rel="stylesheet">
    <!-- Init the plugin and component-->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        Vue.use(VueLoading);
        Vue.component('loading', VueLoading)
        Vue.use(VeeValidate);
        toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
        }
    </script>
    
    <script src="{{ asset('vendor/breadcrumbs/BreadCrumbs.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        "use strict";
        new Vue({
            el: "#app",

            data: {
                form: {
                    first_name: null,
                    last_name: null,
                    email: null,
                    phone_number: null,
                    password: null,
                },
                csvForm: {
                    csv_file: null,
                },
            },

            methods: {
                accessImage(e) {
                    this.form.ProgramImage = e.target.files[0]
                },
                accessCSV(e) {
                    this.csvForm.csv_file = e.target.files[0]
                },
                validateBeforeSubmit(ev) {
                    this.$validator.validateAll().then((result) => {
                        if (result) {
                            let loader = Vue.$loading.show()
                            axios.post('/tenant/learners',this.form).then(res => {
                                loader.hide();
                                toastr["success"](res.data.message)
                            }).catch(e => {
                                loader.hide();
                                // console.log(e.response.data.error)
                                const errors = e.response.data.error
                                if (e.response.status === 400) {
                                    Object.entries(errors).forEach(
                                        ([, value]) => {
                                            toastr["error"](value)
                                        },
                                    )
                                } else {
                                    toastr["error"](e.response.data.error)

                                }
                            })
                            ev.target.reset()
/*
                    this.uploadImage()

                    .then(() => {
                    })
*/
                        }
                    });
                },
                async uploadCSV() {
                    if (this.csvForm.csv_file) {
                        const formData = new FormData();
                        formData.append("csv_file", this.csvForm.csv_file, this.csvForm.csv_file.name);
                        let loader = Vue.$loading.show()
                        await axios.post('/tenant/learners/store-bulk', formData)
                            .then( res => {
                                loader.hide();
                                toastr["success"](res.data.message)
                            })
                            .catch(e => {
                                console.log(e.response.data.error)
                                loader.hide();
                            })
                    }
                },
/*
                async uploadImage() {
                    if (this.form.ProgramImage) {
                        const formData = new FormData();
                        formData.append("asset", this.form.ProgramImage, this.form.ProgramImage.name);
                        await axios.post('/tenant/assets/custom/upload', formData)
                        .then( res => {
                            this.form.ProgramImage = res.data.file_url
                        })
                        .catch(e => {
                            console.log(e.response.data.error)
                        })
                    }
                },
*/
            }






        });
    </script>
@endsection


