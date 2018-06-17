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
                                Individual Families
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

                <!-- Pie Graph 1 -->
                <div class="col-lg-6">
                    <div class="widget-container fluid-height">
                        <div class="heading">
                            <i class="fa fa-bar-chart-o"></i>Members Statistics
                        </div>
                        <div class="widget-content clearfix">
                            <div class="col-sm-6">
                                <div class="pie-chart1 pie-chart pie-number" data-percent="{{$living_members_percentage}}">
                                    {{$living_members_percentage}}%
                                </div>
                                <a href="{{route('reports.members.index')}}"><p class="text-center">Living Members</p></a>
                            </div>
                            <div class="col-sm-6">
                                <div class="pie-chart2 pie-chart pie-number" data-percent="{$deceased_members_percentage}">
                                    {{$deceased_members_percentage}}%
                                </div>
                                <a href="{{route('reports.members.index')}}?status=deceased"><p class="text-center">Deceased Members</p></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Pie Graph 1 -->

                <!-- Chat -->
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