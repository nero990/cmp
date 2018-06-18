@extends('admin.layouts.main')
@section('current_families') class="current" @endsection
@section('title') Families @endsection

@section('content')
<div class="container-fluid main-content">
    <div class="page-title">
        <h1>Family Audit Trail Report <small>[{{$family->name}}]</small></h1>
    </div>
    <!-- DataTables Example -->
    <div class="row">
        <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
                <div class="heading">
                    <i class="fa fa-table"></i>Audit Trail Report for the Family of <strong>{{$family->name}}</strong>
                </div>
                <div class="widget-content padded clearfix">

                    <div class="panel-group" id="accordion">

                        @forelse ($audits as $count => $audit)
                            @php
                                $audit_metadata=$audit->getMetadata();
                                if(!isset($audit_metadata['user_username'])){
                                    $audit_metadata['user_username'] = "Anonymous";
                                }
                            @endphp

                            <div class="panel">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <a class="accordion-toggle" data-parent="#accordion" data-toggle="collapse" href="#collapse{{$count}}">
                                            <div class="caret pull-right"></div>
                                            @lang("family.".$audit->event.".metadata", $audit_metadata)
                                        </a>
                                    </div>
                                </div>
                                <div class="panel-collapse collapse in" id="collapse{{$count}}">
                                    <div class="panel-body">
                                        @foreach ($audit->getModified() as $attribute => $modified)
                                            <ul>
                                                @php

                                                    $dontDisplay = ["id", "state_id", "bcc_zone_id", "number_of_children"];

                                                    if($attribute == "names_of_children"){
                                                        if(isset($modified['new'])) $modified['new'] = implode(", ", $modified['new']);
                                                        if(isset($modified['old'])) $modified['old'] = implode(", ", $modified['old']);
                                                        else $modified['old'] = "NULL";

                                                    }
                                                    if($attribute == "type"){
                                                        if(isset($modified['old'])) $modified['old'] = \App\Family::getTypeText($modified['old']);
                                                        if(isset($modified['new'])) $modified['new'] = \App\Family::getTypeText($modified['new']);
                                                    }
                                                    if($attribute == "card_status"){
                                                        if(isset($modified['old'])) $modified['old'] = \App\Family::getCardStatusText($modified['old']);
                                                        if(isset($modified['new'])) $modified['new'] = \App\Family::getCardStatusText($modified['new']);
                                                    }
                                                @endphp
                                                @if(!in_array($attribute, $dontDisplay))
                                                    <li>@lang('family.'.$audit->event.'.modified.'.$attribute, $modified)</li>
                                                @endif
                                            </ul>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>@lang('family.unavailable_audits')</p>
                        @endforelse

                    </div>
                    <a href="{{route('families.show', $family->id)}}" class="btn btn-info">&laquo; Return to Family Details</a>
                </div>
            </div>
        </div>
    </div>
    <!-- end DataTables Example -->

</div>

@endsection