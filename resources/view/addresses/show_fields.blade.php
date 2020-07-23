<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', trans('words.id').':') !!}
    <p>{!! $address->id !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', trans('words.updatedAt').':') !!}
    <p>{!! $address->updated_at !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', trans('words.createdAt').':') !!}
    <p>{!! $address->created_at !!}</p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', trans('words.deletedAt').':') !!}
    <p>{!! $address->deleted_at !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', trans('words.name').':') !!}
    <p>{!! $address->name !!}</p>
</div>

<!-- Clients Id Field -->
<div class="form-group">
    {!! Form::label('clients_id', trans('words.client').':') !!}
    <p>{!! $address->clients_id !!}</p>
</div>

<!-- Dominios Id Field -->
<div class="form-group">
    {!! Form::label('dominios_id', trans('words.dominio').':') !!}
    <p>{!! $address->dominios_id !!}</p>
</div>

<!-- Address Category Id Field -->
<div class="form-group">
    {!! Form::label('address_category_id', trans('dashboard.address.addressCategoryId').':') !!}
    <p>{!! $address->address_category_id !!}</p>
</div>

