<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')| {{config('app.name')}}</title>
    <link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/stylesheets/bootstrap.min.css')}}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/stylesheets/font-awesome.min.css')}}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/stylesheets/se7en-font.css')}}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/stylesheets/isotope.css')}}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/stylesheets/jquery.fancybox.css')}}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/stylesheets/fullcalendar.css')}}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/stylesheets/wizard.css')}}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/stylesheets/select2.css')}}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/stylesheets/morris.css')}}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/stylesheets/datatables.css')}}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/stylesheets/datepicker.css')}}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/stylesheets/timepicker.css')}}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/stylesheets/colorpicker.css')}}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/stylesheets/bootstrap-switch.css')}}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/stylesheets/bootstrap-editable.css')}}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/stylesheets/daterange-picker.css')}}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/stylesheets/typeahead.css')}}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/stylesheets/summernote.css')}}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/stylesheets/ladda-themeless.min.css')}}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/stylesheets/social-buttons.css')}}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/stylesheets/pygments.css')}}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/stylesheets/style.css')}}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/stylesheets/color/green.css')}}" media="all" rel="alternate stylesheet" title="green-theme" type="text/css"/>
    <link href="{{asset('admin/stylesheets/color/orange.css')}}" media="all" rel="alternate stylesheet" title="orange-theme" type="text/css"/>
    <link href="{{asset('admin/stylesheets/color/magenta.css')}}" media="all" rel="alternate stylesheet" title="magenta-theme" type="text/css"/>
    <link href="{{asset('admin/stylesheets/color/gray.css')}}" media="all" rel="alternate stylesheet" title="gray-theme" type="text/css"/>
    <link href="{{asset('admin/stylesheets/jquery.fileupload-ui.css')}}" media="screen" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/stylesheets/dropzone.css')}}" media="screen" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/stylesheets/custom/final.css')}}" media="screen" rel="stylesheet" type="text/css"/>


    <script src="{{asset('admin/javascripts/jquery-1.10.2.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/jquery-ui.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/raphael.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/selectivizr-min.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/jquery.mousewheel.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/jquery.vmap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/jquery.vmap.sampledata.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/jquery.vmap.world.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/jquery.bootstrap.wizard.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/fullcalendar.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/gcal.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/datatable-editable.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/jquery.easy-pie-chart.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/excanvas.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/jquery.isotope.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/isotope_extras.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/modernizr.custom.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/jquery.fancybox.pack.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/select2.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/styleswitcher.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/wysiwyg.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/typeahead.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/summernote.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/jquery.inputmask.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/jquery.validate.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/bootstrap-fileupload.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/bootstrap-datepicker.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/bootstrap-timepicker.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/bootstrap-colorpicker.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/bootstrap-switch.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/typeahead.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/spin.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/ladda.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/moment.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/mockjax.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/bootstrap-editable.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/xeditable-demo-mock.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/xeditable-demo.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/address.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/daterange-picker.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/date.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/morris.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/skycons.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/fitvids.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/jquery.sparkline.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/dropzone.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/main.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/respond.js')}}" type="text/javascript"></script>

    <script src="{{asset('admin/javascripts/sweetalert.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/custom/final.js')}}" type="text/javascript"></script>

    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base-url" content="{{ url('') }}">
</head>
<body class="page-header-fixed bg-1">
<div class="modal-shiftfix">
    <!-- Navigation -->
    @include('admin.layouts.partials.navigation')
    <!-- End Navigation -->

    @include('sweet::alert')

    @yield('content')
</div>

<img src="{{asset('admin/images/loader-dark.gif')}}" class="loader-img">

{{--<div id="confirm-dialog" title="Confirm action">
    <p><em>Are you sure you want to perform this operation?</em></p>
</div>--}}

<!-- Custom JS -->

<script src="{{asset('admin/javascripts/custom/api-handler.js')}}" type="text/javascript"></script>
@yield('scripts')
</body>
</html>