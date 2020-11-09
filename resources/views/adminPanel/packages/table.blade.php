<div class="table-responsive-sm">
    <table class="table table-striped" id="packages-table">
        <thead>
            <tr>
                <th>@lang('models/packages.fields.id')</th>
                <th>@lang('models/packages.fields.name')</th>
                <th>@lang('models/packages.fields.duration')</th>
                <th>@lang('models/packages.fields.price')</th>
                <th>@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($packages as $package)
            @php $i = 1; @endphp
            @foreach (config('langs') as $locale => $name)
            <tr>
                <td>{{ $package->id }}</td>
                <td>{{ $package->translateOrNew($locale)->name }}</td>
                <td>{{ $package->translateOrNew($locale)->duration }}</td>
                <td>{{ $package->price }}</td>
                <td>
                    {!! Form::open(['route' => ['adminPanel.packages.destroy', $package->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('adminPanel.packages.show', [$package->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('adminPanel.packages.edit', [$package->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
            @php $i = 0; @endphp
            @endforeach
            @endforeach
        </tbody>
    </table>
</div>