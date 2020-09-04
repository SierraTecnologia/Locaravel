<table class="table table-responsive" id="addresses-table">
    <thead>
        <th>{!! trans('words.name') !!}</th>
        <th>{!! trans('words.type') !!}</th>
        <th colspan="3">{!! trans('words.action') !!}</th>
    </thead>
    <tbody>
        @if (!empty($addresses))
            @foreach($addresses as $address)
                <tr>
                    <td>{!! $address->content !!}</td>
                    <td>{!! $address->addressType->name !!}</td>
                    <td>
                        {!! Form::open(['route' => ['locaravel::admin.addresses.destroy', $address->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{!! route('locaravel::admin.addresses.show', [$address->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                            <a href="{!! route('locaravel::admin.addresses.edit', [$address->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                            {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('".trans('phrases.areYouSure')."')"]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>