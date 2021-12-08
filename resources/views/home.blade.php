@extends('layouts.app')

@section('css')
    <style>
        .card-hotel, .card-branch {
            cursor: pointer;
        }

        .card-branch.active,
        .card-branch:hover,
        .card-hotel.active,
        .card-hotel:hover {
            background-color: #f44336;
            color: #ffffff;
        }
    </style>
@endsection
@section('content')


    <div class="row">
        <div class="col-sm-12">
            <!--      Wizard container        -->
            <div class="wizard-container">
                <div class="card wizard-card" data-color="red" id="wizard">
                    <form action="{{ route('home_submit') }}" method="post" id="form-hotel">
                        <!--        You can switch " data-color="blue" "  with one of the next bright colors: "green", "orange", "red", "purple"             -->

                        <div class="wizard-header">
                            <h3 class="wizard-title">
                                Book a Room
                            </h3>
                        </div>
                        <div class="wizard-navigation">
                            <ul>
                                <li><a href="#hotel" data-toggle="tab">Hotel</a></li>
                                <li><a href="#branches" data-toggle="tab">Branches</a></li>
                                <li><a href="#captain" data-toggle="tab">Room Type</a></li>
                            </ul>
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane" id="hotel">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h4 class="info-text">
                                            List of Hotel
                                            <span class="d-block text-muted mt-2">Select Hotel</span>
                                        </h4>
                                    </div>
                                    @foreach($hotels as $data)
                                        <div class="col-sm-4 mb-2">
                                            <div class="card card-hotel"
                                                 data-url="{{ route('hotel_branches',$data->hotel_slug) }}"
                                                 data-id="{{ $data->id }}"
                                            >
                                                <div class="card-body">
                                                    <h4 class="card-title">
                                                        <i class="fa fa-building"></i> {{ $data->hotel_name }}
                                                    </h4>
                                                    <p class="card-text">{{ "No. Of Branch ({$data->branches_count})" }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-pane" id="branches">
                                <h3 class="text-warning">Please Select Hotel First</h3>
                            </div>
                            <div class="tab-pane" id="captain">
                                <h4 class="info-text">What type of room would you want? </h4>
                                <div class="row">
                                    <div class="col-sm-10 col-sm-offset-1">
                                        <div class="col-sm-4 col-sm-offset-4">
                                            <div class="choice" data-toggle="wizard-radio" rel="tooltip"
                                                 title="This is good if you travel alone.">
                                                <input type="radio" name="type" value="all">
                                                <div class="icon">
                                                    <i class="material-icons">bookmark</i>
                                                </div>
                                                <h6>All</h6>
                                            </div>
                                        </div>
                                        <div class="col-sm-12"></div>
                                        <div class="col-sm-4">
                                            <div class="choice" data-toggle="wizard-radio" rel="tooltip"
                                                 title="This is good if you travel alone.">
                                                <input type="radio" name="type" value="single">
                                                <div class="icon">
                                                    <i class="material-icons">weekend</i>
                                                </div>
                                                <h6>Single</h6>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="choice" data-toggle="wizard-radio" rel="tooltip"
                                                 title="Select this room if you're traveling with your family.">
                                                <input type="radio" name="type" value="double">
                                                <div class="icon">
                                                    <i class="material-icons">home</i>
                                                </div>
                                                <h6>Double</h6>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="choice" data-toggle="wizard-radio" rel="tooltip"
                                                 title="Select this option if you are coming with your team.">
                                                <input type="radio" name="type" value="suits">
                                                <div class="icon">
                                                    <i class="material-icons">business</i>
                                                </div>
                                                <h6>Suits</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wizard-footer">
                            <div class="pull-right">
                                <input type='button' class='btn btn-next btn-fill btn-danger btn-wd' name='next'
                                       value='Next' />
                                <input type='submit' class='btn btn-finish btn-fill btn-danger btn-wd'
                                       name='submit' value='finish' />
                            </div>
                            <div class="pull-left">
                                <input type='button' class='btn btn-previous btn-fill btn-default btn-wd'
                                       name='previous' value='Previous' />
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
            </div> <!-- wizard container -->
        </div>
    </div> <!-- row -->
@endsection
@push('js')

    <!--  Plugin for the Wizard -->
    <script src="{{ asset('js/material-bootstrap-wizard.js') }}"></script>

    <!--  More information about jquery.validate here: http://jqueryvalidation.org/	 -->
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script>
        activeCard('.card-hotel');

        function activeCard(card_class) {
            let card_box = $(card_class);
            card_box.click(function () {
                card_box.removeClass('active')
                $(this).addClass('active')
                if (typeof $(this).data('url') != 'undefined')
                    getBranches($(this).data('url'))
            })
        }

        function getBranches(url_target) {
            $.get(url_target, function (res) {
                let response = res.data
                let mssg = `<div class="row">`;
                mssg += `<div class="col-sm-12"><h4 class="info-text">${response.name}</h4></div>`;
                console.log(response)
                for (let i = 0; i < response.branches.length; i++) {
                    let branch = response.branches[i];
                    mssg += `
                     <div class="col-sm-4 mb-2">
                        <div class="card card-branch" data-id="${branch.id}">
                            <div class="card-body">
                                <h4 class="card-title"><i class="fa fa-building"></i> ${branch.name}</h4>
                                <p class="card-text">${branch.location.location_name}</p>
                            </div>
                        </div>
                    </div>
                    `

                }
                mssg += `</div>`

                $('#branches').html(mssg)
                activeCard('.card-branch')
            });
        }

        let submit_form = $('form#form-hotel');
        submit_form.submit(function (e) {
            e.preventDefault();
            let hotel_id = $('.card-hotel.active').data('id')
            let branch_id = $('.card-branch.active').data('id')
            let type_id = $('[name="type"]').val()

            if (typeof branch_id == 'undefined') {
                $('[href="#branches"]').click()
            } else {
                $.ajax({
                    url: e.currentTarget.action,
                    type: 'post',
                    dataType: 'application/json',
                    data: {'hotel_id': hotel_id, 'branch_id': branch_id, 'type': type_id},
                    success: (result) => {
                        window.location.href = result
                    }
                })
            }
        })
    </script>

@endpush
