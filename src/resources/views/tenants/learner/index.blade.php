@extends('layouts.themes.tabler.tabler')

@section('head_css')
    <style>
        .breadcrumb-item + .breadcrumb-item::before {
            content: ">>";
        }
        .card-course {
        position: relative;
        /* width: 319px; */
        /* display: flex; */
        /* flex-direction: column; */
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(0, 0, 0, 0.125);
        box-shadow: rgb(31 31 31 / 12%) 0px 1px 6px, rgb(31 31 31 / 12%) 0px 1px 4px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        /* box-shadow: 0 2px 2px rga(0, 0, 0, 0.25); */
        border: none;
        border-radius: 0.35rem;
        border-radius: 8px;
        transition: transform .5s;
        cursor: pointer;
        }
        .card-course:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0,0,0,.12), 0 4px 8px rgba(0,0,0,.06);
        }
        .primary-backgroundColor {
            background-color: #343a40 !important;
            color: white;
        }
    </style>
@endsection


@section('body_content_main')
    @include('modules-lms-base::navigation',['type' => 'tenant'])
    <div id="learners">
        <breadcrumbs 
            :items="[
                {url: '/tenant/dashboard', title: 'Home', active: false},
                {url: '', title: 'Learners', active: true},
            ]">
        </breadcrumbs>
        <div class="container mt-5">
            <section class="container learner-contain">
                <h2 class="mb-2">
                    Learners Manager
                </h2>
                <div class="add-learner-contain">
                    <a style="background-color: #343a40; color:white" class="mt-2 mb-5 btn add-course" href="/tenant/learners/create">
                        <i class="fa fa-plus"> </i> Add Learner
                    </a>
                </div>

                <div class="mb-2 input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search form-control-feedback"></span>
                        </div>
                    </div>
                    <input v-model="search" type="text" class="form-control" placeholder="Search Learner" />
                </div>

                <div class="row" v-if="cardinfos.length>0">
                    <div class="mt-4 mb-5 col-lg-4 col-md-4 col-sm-6 col-xs-6" v-for="(cardinfo, index) in searchLearners"
                        :key="index">
                        <div class="card-course">
                            <!-- <div class="card-image"> -->
                            <img class="card-img-top" style="height: 180px; width:340px; object-fit: cover"
                                :src="cardinfo.image || 'https://via.placeholder.com/320x320.jpg'" alt="" />

                            <!-- </div> -->
{{--
                            <div class="card-body">
                                <h5 class="card-title">@{{ cardinfo . title }}</h5>
                                <h6 class="mb-2 card-subtitle text-muted">
                                    @{{ cardinfo . author }}
                                </h6>
                                <p class="card-text">@{{ cardinfo . description }}</p>

                                <a class="mx-2 btn btn-outline-secondary" :href="`/tenant/programs/edit/${cardinfo.id}`"
                                    role="button">Edit</a>

                                <a class="btn btn-outline-danger" href="#" role="button">Delete</a>
                            </div>
--}}
                            <div class="card-body">
                                <h5 class="card-title" v-text="fullName(cardinfo)"></h5>
                                <h6 class="mb-2 card-subtitle text-muted">
                                    Author
                                </h6>
                                <p class="card-text">
                                    <b>Email: </b>@{{ cardinfo.email }}<br>
                                    <b>Phone:</b> @{{ cardinfo.phone_number }}<br>
                                </p>

                                <a class="mx-2 btn btn-outline-secondary" :href="`/tenant/learners/${cardinfo.id}/edit`"
                                    role="button">Edit</a>

                                <a class="btn btn-outline-danger" href="#" role="button">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" v-else>
                    <p>No Learner Available</p>
                </div>
            </section>
        </div>

    </div>
@endsection

@section('body_js')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <script src="{{ asset('vendor/breadcrumbs/BreadCrumbs.js') }}"></script>
    <script>
        "use strict";

        new Vue({
            el: "#learners",

            data: {
                search: "",
                cardinfos: {!! json_encode($data) !!},
                aboutProgram: "Turpis scelerisque iaculis torquent sit venenatis tempor suspendisse dictum. Placerat molestie est enim velit dis vestibulum aliquet lacus efficitur mi quisque. Purus egestas eget est ac integer. Sociosqu suscipit facilisis phasellus at sollicitudin habitasse nullam pharetra mattis malesuada montes. Etiam lacus consectetur habitant integer porta primis turpis mus nam. Odio ornare nec mattis tincidunt purus diam tempus aliquam dignissim. Sollicitudin imperdiet accumsan per non etiam commodo inceptos volutpat rutrum. Consequat sem ante fusce at iaculis est nulla ac vivamus turpis.",
            },

            methods: {
                fullName(user){
                    return user.first_name+' '+user.last_name
                }

            },


            computed: {
                searchLearners() {
                    return this.cardinfos.filter( card => card.first_name.toLowerCase().indexOf(this.search.toLowerCase()) > -1 )
                },
            },

            mounted: function () {
                console.log(this.cardinfos);
                //console.log(this.cardinfos.length);
            }
        });

    </script>
@endsection
