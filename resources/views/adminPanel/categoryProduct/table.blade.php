<div class="table-responsive-sm">
    <table class="table table-striped" id="category-products-table">
        <thead>
            <tr>
                <th>@lang('models/categoryProduct.fields.id')</th>
                <th>@lang('models/metas.fields.language')</th>
                <th>@lang('models/categoryProduct.fields.type')</th>
                <th>@lang('models/categoryProduct.fields.name')</th>
                <th>@lang('models/categoryProduct.fields.photo')</th>
                <th>@lang('models/categoryProduct.fields.status')</th>
                <th>@lang('crud.action')</th>
            </tr>
        </thead>
        {{-- <thead class="table-header-search">
            {!! Form::open(['route' => ['adminPanel.categoryProduct.index'], 'method' => 'GET']) !!}

            <th></th>
            <th></th>
            <th>
                {!! Form::text('name', request()->filled('name')? old('name', request('name')) : null, ['class' =>
                'form-control', 'placeholder' => 'Name', '' => '']) !!}
            </th>
            <th></th>
            <th>
                {!! Form::select('status', ['0' => 'Inactive', '1' => 'Active'], request()->filled('status')?
                old('status', request('status')) : null, ['class' => 'form-control', 'placeholder' => 'Status...']) !!}
            </th>
            <th>
                <div class='btn-group'>
                    {!! Form::button('<i class="fa fa-search"></i>', ['type' => 'submit', 'class' => 'btn
                    btn-ghost-light']) !!}
                    <a href="{{route('adminPanel.categoryProduct.index')}}" class="btn btn-ghost-light"><i class="fa fa-ban"></i></a>
</div>
</th>

{!! Form::close() !!}
</thead> --}}
<tbody>
    @foreach($categories as $category)
    @php $i = 1;@endphp
    @foreach ( config('langs') as $locale => $name)
    <tr>
        <td>{{ $category->id }}</td>
        <td>{{ $name }}</td>
        <td>{{$i ? $category->parent_id == null ? 'Parent' : 'Child' : '' }}</td>
        <td>{{ $category->translate($locale)->name }}</td>
        <td>
            @if ($i)
            <img src="{{asset('uploads/images/thumbnail/'. $category->photo)}}" alt="{{$category->name}}">
            @endif
        </td>
        <td>{{$i ? $category->status ? 'Active' : 'Inactive' : '' }}</td>

        <td>
            {!! Form::open(['route' => ['adminPanel.categoryProduct.destroy', $category->id], 'method' => 'delete'])
            !!}
            <div class='btn-group'>
                <a href="{{ route('adminPanel.categoryProduct.show', [$category->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                <a href="{{ route('adminPanel.categoryProduct.edit', [$category->id]) . "?languages=$locale" }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn
                btn-ghost-danger', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
            </div>
            {!! Form::close() !!}
        </td>
    </tr>

    @php $i = 0; @endphp
    @endforeach

    @forelse ($category->children as $child)
    @php $i2 = 1; @endphp
    @foreach ( config('langs') as $locale => $name)
    <tr>
        <td>{{ $child->id }}</td>
        <td>{{ $name }}</td>
        <td>{{$i2 ? $child->parent_id == null ? 'Parent' : 'Child' : '' }}</td>
        <td>{{ $child->translate($locale)->name }}</td>
        <td>
            @if ($i2)
            <img src="{{asset("uploads/images/thumbnail/$child->photo")}}" alt="{{$child->name}}">
            @endif
        </td>
        <td>{{$i2 ? $child->status ? 'Active' : 'Inactive' : '' }}</td>

        <td>
            {!! Form::open(['route' => ['adminPanel.categoryProduct.destroy', $child->id], 'method' => 'delete']) !!}
            <div class='btn-group'>
                <a href="{{ route('adminPanel.categoryProduct.show', [$child->id])}}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                <a href="{{ route('adminPanel.categoryProduct.edit', [$child->id]) . "?languages=$locale" }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn
                btn-ghost-danger', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
            </div>
            {!! Form::close() !!}
        </td>
    </tr>

    @php $i2 = 0; @endphp
    @endforeach
    @empty

    @endforelse
    @endforeach
</tbody>
</table>
</div>
