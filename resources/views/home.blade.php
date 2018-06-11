@extends('admin.layouts.main')

@section('title') Dashboard @endsection
@section('dashboard') class="current" @endsection

@section('content')

    <div class="modal-shiftfix">

        <div class="container-fluid main-content">
            <!-- Statistics -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="widget-container stats-container">
                        <div class="col-md-3">
                            <div class="number">
                                <div class="icon visitors"></div>
                                {{$families_count}}
                            </div>
                            <div class="text">
                                Families
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="number">
                                <div class="icon visitors"></div>
                                {{$individuals_count}}
                            </div>
                            <div class="text">
                                Individuals
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="number">
                                <div class="fa fa-users"></div>
                                {{$members_count}}
                            </div>
                            <div class="text">
                                Members
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="number">
                                <div class="fa fa-group"></div>
                                {{$children_count}}
                            </div>
                            <div class="text">
                                Children
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Statistics -->
            <div class="row">
                <!-- Weather -->
                <div class="col-md-8">
                    <div class="widget-container weather">
                        <div class="widget-content padded">
                            <div class="row text-center">
                                <div class="col-sm-6 col-md-6 col-lg-4 today">
                                    <p>
                                        TODAY
                                    </p>
                                    <canvas class="skycons-element" data-skycons="RAIN" height="100" id="rain" width="100"></canvas>
                                    <div class="number">
                                        72<small>&deg;</small>
                                    </div>
                                    <p class="location">
                                        Washington, D.C.
                                    </p>
                                </div>
                                <div class="col-sm-2 hidden-xs">
                                    <p>
                                        MON
                                    </p>
                                    <canvas class="skycons-element" data-skycons="CLEAR_DAY" height="60" id="clear-day" width="60"></canvas>
                                    <div class="number">
                                        86<small>&deg;</small>
                                    </div>
                                </div>
                                <div class="col-sm-2 hidden-xs">
                                    <p>
                                        TUE
                                    </p>
                                    <canvas class="skycons-element" data-skycons="RAIN" height="60" id="cloudy" width="60"></canvas>
                                    <div class="number">
                                        75<small>&deg;</small>
                                    </div>
                                </div>
                                <div class="col-sm-2 hidden-xs">
                                    <p>
                                        WED
                                    </p>
                                    <canvas class="skycons-element" data-skycons="PARTLY_CLOUDY_DAY" height="60" id="partly-cloudy-day" width="60"></canvas>
                                    <div class="number">
                                        82<small>&deg;</small>
                                    </div>
                                </div>
                                <div class="col-sm-2 hidden-md hidden-sm hidden-xs">
                                    <p>
                                        THU
                                    </p>
                                    <canvas class="skycons-element" data-skycons="SLEET" height="60" id="sleet" width="60"></canvas>
                                    <div class="number">
                                        64<small>&deg;</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end Weather --><!-- Bar Graph -->
                <div class="col-md-4">
                    <div class="widget-container small">
                        <div class="heading">
                            <i class="fa fa-signal"></i>New sign ups<i class="fa fa-list pull-right"></i><i class="fa fa-refresh pull-right"></i>
                        </div>
                        <div class="widget-content padded">
                            <div class="bar-chart-widget">
                                <div class="chart-graph">
                                    <div id="barcharts">
                                        Loading...
                                    </div>
                                    <ul class="chart-text-axis">
                                        <li>
                                            1
                                        </li>
                                        <li>
                                            2
                                        </li>
                                        <li>
                                            3
                                        </li>
                                        <li>
                                            4
                                        </li>
                                        <li>
                                            5
                                        </li>
                                        <li>
                                            6
                                        </li>
                                        <li>
                                            7
                                        </li>
                                        <li>
                                            8
                                        </li>
                                        <li>
                                            9
                                        </li>
                                        <li>
                                            10
                                        </li>
                                        <li>
                                            11
                                        </li>
                                        <li>
                                            12
                                        </li>
                                        <li>
                                            13
                                        </li>
                                        <li>
                                            14
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Bar Graph -->
            </div>
            <div class="row">
                <!-- Area Charts:Morris -->
                <div class="col-md-6">
                    <div class="widget-container fluid-height">
                        <div class="heading">
                            <i class="fa fa-bar-chart-o"></i>Area Chart
                        </div>
                        <div class="widget-content padded text-center">
                            <div class="graph-container">
                                <div class="caption"></div>
                                <div class="graph" id="hero-area"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Area Charts:Morris --><!-- Chat -->
                <div class="col-lg-6">
                    <div class="widget-container fluid-height">
                        <!-- Table -->
                        <table class="table table-filters">
                            <tbody>

                            @foreach($bcc_zones AS $bcc_zone)
                                <tr>
                                    @php
                                        $property = $bcc_zone->random_property;
                                    @endphp
                                    <td class="filter-category {{$property['colour']}}">
                                        <div class="arrow-left"></div>
                                        <i class="fa {{$property['font-awesome']}}"></i>
                                    </td>
                                    <td>
                                        <a href="{{route('bcc-zones.show', $bcc_zone->id)}}">{{$bcc_zone->name}}</a>
                                    </td>
                                    <td class="hidden-xs">
                                        {{$bcc_zone->address}}
                                    </td>
                                    <td>
                                        {{$bcc_zone->families_count}}
                                    </td>
                                    <td>
                                        <div class="danger">
                                            {{$bcc_zone->percentage_size}}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- End Chat -->
            </div>
            <div class="row">
                <!-- Pie Graph 1 -->
                <div class="col-lg-5">
                    <div class="widget-container fluid-height">
                        <div class="heading">
                            <i class="fa fa-bar-chart-o"></i>Donut Charts
                        </div>
                        <div class="widget-content clearfix">
                            <div class="col-sm-6">
                                <div class="pie-chart1 pie-chart pie-number" data-percent="87">
                                    87%
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="pie-chart2 pie-chart pie-number" data-percent="26">
                                    26%
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- End Pie Graph 1 -->
            </div>
        </div>
    </div>
    <div class="container-fluid main-content">

    </div>

@endsection

@section('scripts')
    <script src="{{asset('admin/javascripts/custom/family.js')}}" type="text/javascript"></script>
@endsection



<div class="style-selector">
    <div class="style-selector-container">
        <h2>
            Layout Style
        </h2>
        <select name="layout"><option value="fluid">Fluid</option><option value="boxed">Boxed</option></select>
        <h2>
            Navigation Style
        </h2>
        <select name="nav"><option value="top">Top</option><option value="left">Left</option></select>
        <h2>
            Color Options
        </h2>
        <ul class="color-options clearfix">
            <li>
                <a class="blue" href="javascript:chooseStyle('none', 30)"></a>
            </li>
            <li>
                <a class="green" href="javascript:chooseStyle('green-theme', 30)"></a>
            </li>
            <li>
                <a class="orange" href="javascript:chooseStyle('orange-theme', 30)"></a>
            </li>
            <li>
                <a class="magenta" href="javascript:chooseStyle('magenta-theme', 30)"></a>
            </li>
            <li>
                <a class="gray" href="javascript:chooseStyle('gray-theme', 30)"></a>
            </li>
        </ul>
        <h2>
            Background Patterns
        </h2>
        <ul class="pattern-options clearfix">
            <li>
                <a class="active" href="#" id="bg-1"></a>
            </li>
            <li>
                <a href="#" id="bg-2"></a>
            </li>
            <li>
                <a href="#" id="bg-3"></a>
            </li>
            <li>
                <a href="#" id="bg-4"></a>
            </li>
            <li>
                <a href="#" id="bg-5"></a>
            </li>
        </ul>
        <div class="style-toggle closed">
            <span aria-hidden="true" class="se7en-gear"></span>
        </div>
    </div>
</div>
</body>
</html>