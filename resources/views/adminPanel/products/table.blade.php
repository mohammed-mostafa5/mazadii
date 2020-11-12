<div class="table-responsive-sm">
    <table class="table table-striped" id="products-table">
        <thead>
            <tr>
                <th>#</th>
                <th>@lang('models/products.fields.category_name')</th>
                <th>@lang('models/products.fields.name')</th>
                <th>@lang('models/products.fields.description')</th>
                {{-- <th>@lang('lang.distributors')</th> --}}
                <th>@lang('models/products.fields.regular_price')</th>
                <th>@lang('models/products.fields.photo')</th>
                {{-- <th>@lang('models/products.fields.is_bundle')</th>
                <th>@lang('models/products.fields.is_offer')</th> --}}
                {{-- <th>@lang('models/products.fields.video')</th> --}}
                <th>@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            @php $i = 1; @endphp
            @foreach ( config('langs') as $locale => $name)
            <tr>
                <td>{{$product->id}}</td>
                <td>{{ $product->category->translateOrNew($locale)->name ?? ''}}</td>
                <td>{{ $product->translateOrNew($locale)->name ?? ''}}</td>
                <td>{{ Str::limit($product->translateOrNew($locale)->description ?? '',50) ?? ''}}</td>
                <td>{{ $i? $product->start_price ?? '' : ''}}</td>
                <td>
                    @if ($i)
                    {{-- {{$product->first_photo}} --}}
                    <img src="{{asset('uploads/images/thumbnail/')}}" alt="{{$product->name}}">
                    @endif
                </td>

                <td>
                    {!! Form::open(['route' => ['adminPanel.products.destroy', $product->id], 'method' => 'delete'])
                    !!}
                    <div class='btn-group'>
                        <a href="{{ route('adminPanel.products.show', [$product->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('adminPanel.products.edit', [$product->id]) . "?languages=$locale" }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn
                        btn-ghost-danger', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
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
