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