@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="float-left">{!! trans('words.addresses') !!}</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> {!! trans('words.home') !!}</a></li>
            <li class="active">{!! trans('words.addresses') !!}</li>
        </ol>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('layouts.partials.message')

        <div class="clearfix"></div>

        <div class="box panel card box-primary panel-primary card-primary">
            <div class="btn-group">
                <h1 class="float-right">
                    <a class="btn btn-primary float-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('locaravel::admin.addresses.create') !!}">{!! trans('words.addNew') !!}</a>
                </h1>
            </div>
            <div class="box-body panel-body card-body">
                    @include('locaravel::admin.addresses.table')
            </div>
        </div>
    </div>
@endsection

