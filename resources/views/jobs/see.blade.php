@extends('layouts.master')

@section('content')
    <div id="main" role="main">
        <!-- RIBBON -->
        <div id="ribbon">
            <!-- breadcrumb -->
            <ol class="breadcrumb">
                <li>
                    <a href="/jobs">
                        <i class="fa fa-suitcase"></i>
                        {{ trans('Job') }}
                    </a>
                </li>
                <li>
                    <b>
                        <i class="fa fa-eye"></i>
                        {{ trans('Details') }}
                    </b>
                </li>
            </ol>
        </div>

        <div id="content">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left">
                    <a class="btn btn-labeled btn-primary" href="/jobs">
                        <span class="btn-label"><i class="fa fa-chevron-left"></i></span>
                        {{ trans('Back') }}
                    </a>
                </div>
            </div>
            <br />

            <!-- widget grid -->
            <section id="widget-grid" class="">
                <!-- row -->
                <div class="row">
                    <form action="/jobs/apply" id="see-page-form" method="post">
                        <!-- NEW WIDGET START -->
                        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <!-- Widget ID (each widget will need unique ID)-->
                            <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-1" data-widget-editbutton="false"
                                 data-widget-colorbutton="false"
                                 data-widget-togglebutton="false"
                                 data-widget-deletebutton="false"
                                 data-widget-fullscreenbutton="false"
                                 data-widget-custombutton="false"
                                 data-widget-collapsed="false"
                                 data-widget-sortable="false"
                            >
                                <header>
                                    <span class="widget-icon"> <i style="margin-top: 10px;" class="fa fa-suitcase"></i> </span>
                                    <h2>{{ trans('Job Description') }}</h2>
                                </header>

                                <div>
                                    <div class="jarviswidget-editbox"></div>
                                    <div class="widget-body no-padding">
                                        <div id="result"></div>

                                        <div class="smart-form">
                                            <fieldset>
                                                <div class="row">
                                                    <input type="hidden" name="id" value="{{ $page->id }}" />
                                                    
                                                    <section class="col col-md-12">
                                                        <h4>{{ trans('lang.employer') }}: <small>{{ $employer->first_name }} {{ $employer->last_name }}</small></h4><hr><br>

                                                        <h4>{{ trans('lang.job_post') }}: <small>{{ $page->name }}</small></h4><hr><br>
                                                        
                                                        <h4>{{ trans('lang.experience') }}: <small>{{ $page->experience }}</small></h4><hr><br>

                                                        <h4>{{ trans('lang.salary') }}: <small>{{ $page->salary }}</small></h4><hr><br>

                                                        <h4>{{ trans('lang.description') }}: <small>{{ $page->description }}</small></h4><hr><br>
                                                    </section>
                                                </div>
                                            </fieldset>

                                            <footer>
                                                @if ($page->candidates->contains($current_user->id)) 
                                                <button type="button" class="btn btn-success">
                                                    <i class="fa fa-check"></i>
                                                    {{ trans('You have already applied to this job') }}
                                                </button>
                                                @else
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa fa-check"></i>
                                                    {{ trans('Apply for this job') }}
                                                </button>
                                                @endif
                                                <a href="/jobs" class="btn btn-default">
                                                    {{ trans('Cancel') }}
                                                </a>
                                            </footer>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </form>
                </div>
            </section>

        </div>
    </div>
@endsection

@section('custom_plugin')
    <script src="/js/plugin/jquery_form/jquery.form.js"></script>
@endsection

@section('custom_script')
    <script>
        $(document).ready(function () {

            var errorClass      = 'invalid';
            var errorElement    = 'em';
            var $registerForm   = $("#see-page-form").validate({
                errorClass: errorClass,
                errorElement: errorElement,
                highlight: function (element) {
                    $(element).parent().removeClass('state-success').addClass("state-error");
                    $(element).removeClass('valid');
                },
                unhighlight: function (element) {
                    $(element).parent().removeClass("state-error").addClass('state-success');
                    $(element).addClass('valid');
                },
                // Rules for form validation
                rules: {
                    id: {
                        required: true
                    }
                },
                // Messages for form validation
                messages: {
                    name: {
                        required: "{{trans('Undefined job ID')}}"
                    },

                },
                // Do not change code below
                errorPlacement: function (error, element) {
                    error.insertAfter(element.parent());
                },
                submitHandler: function (form) {
                    submit_form('#see-page-form', '#result')
                }
            });


            
        });


    </script>
@endsection
