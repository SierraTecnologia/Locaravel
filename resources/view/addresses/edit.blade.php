@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {!! trans('words.address') !!}
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> {!! trans('words.home') !!}</a></li>
            <li><a href="{!! route('locaravel::addresses.index') !!}"><i class="fa fa-key"></i> {!! trans('words.addresses') !!}</a></li>
            <li class="active">{!! trans('words.edit') !!}</li>
        </ol>
   </section>
   <div class="content">

       <div class="box box-primary">
           <div class="box-body">
               <div class="row">

                   @include('layouts.partials.message')

                   {!! Form::model($address, ['route' => ['addresses.update', $address->id], 'method' => 'patch']) !!}

                        @include('locaravel::addresses.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection