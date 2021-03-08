<div class="table-responsive-sm">
    <table class="table table-striped" id="rules-table">
        <thead>
            <tr>
                <th>@lang('models/rules.fields.title')</th>
                <th>@lang('models/rules.fields.description')</th>
                <th>@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rules as $rule)
            <tr>
                <td>{{ $rule->title }}</td>
                <td>{{Str::limit($rule->description, 150 ) }}</td>
                <td>
                    {!! Form::open(['route' => ['adminPanel.rules.destroy', $rule->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('adminPanel.rules.show', [$rule->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('adminPanel.rules.edit', [$rule->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {{-- {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!} --}}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
