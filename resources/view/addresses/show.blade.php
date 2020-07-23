@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {!! trans('words.address') !!}
        </h1>
    </section>

    {{-- <section class="content-header">
        <h1>
          ChartJS
          <small>Preview sample</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Charts</a></li>
          <li class="active">ChartJS</li>
        </ol>
      </section> --}}
    <div class="content">
        <div class="box box-primary">
            <div class="btn-group">
                <h1 class="pull-right">
                    <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('locaravel::addresses.create') !!}">{!! trans('words.addNew') !!}</a>
                </h1>
            </div>
            <div class="box-body">
                    @include('locaravel::addresses.table')
            </div>
        </div>

        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('locaravel::addresses.show_fields')
                    <a href="{!! route('locaravel::addresses.index') !!}" class="btn btn-default">{!! trans('words.back') !!}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
