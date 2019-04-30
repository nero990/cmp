@extends('admin.layouts.main')
@section('current_reports') class="current" @endsection
@section('current_reports_audits') class="current" @endsection
@section('title') {{ucwords(str_replace("_", " ", $translation))}} Audit @endsection

@section('content')
<div class="container-fluid main-content">
    <div class="page-title">
        <h1>{!! $heading !!}</h1>
    </div>
    <!-- DataTables Example -->
    <div class="row">
        <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
                <div class="heading">
                    <i class="fa fa-table"></i>{!! $title !!}
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
                                            {!! trans("{$translation}.{$audit->event}.metadata", $audit_metadata) !!}
                                        </a>
                                    </div>
                                </div>
                                <div class="panel-collapse collapse in" id="collapse{{$count}}">
                                    <div class="panel-body">
                                        @foreach ($audit->getModified() as $attribute => $modified)
                                            <ul>
                                                @php
                                                    /** @var \App\Family $model */
                                                    $modified = $model::auditTransformer($attribute,$modified);
                                                    if(!$modified){ echo "</ul>"; continue; }
                                                @endphp
                                                @if(!in_array($attribute, $model::DONT_DISPLAY_AUDIT))
                                                    <li>
                                                        {!! trans("{$translation}.{$audit->event}.modified.{$attribute}", $modified) !!}
                                                    </li>
                                                @endif
                                            </ul>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>{!! trans(("{$translation}.unavailable_audits")) !!}
{{--                                @lang("{$translation}.unavailable_audits")--}}
                            </p>
                        @endforelse

                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- end DataTables Example -->

</div>

@endsection