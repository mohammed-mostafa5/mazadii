<div class="table-responsive-sm">
    <table class="table table-striped" id="products-table">
        <thead>
            <tr>
                <th>#</th>
                <th>@lang('models/products.fields.category_name')</th>
                <th>@lang('models/products.fields.name')</th>
                <th>@lang('models/products.fields.description')</th>
                {{-- <th>@lang('lang.distributors')</th> --}}
                <th>@lang('models/products.fields.start_bid_price')</th>
                <th>@lang('models/products.fields.status')</th>
                <th>@lang('models/products.fields.photo')</th>
                {{-- <th>@lang('models/products.fields.is_bundle')</th>
                <th>@lang('models/products.fields.is_offer')</th> --}}
                {{-- <th>@lang('models/products.fields.video')</th> --}}
                <th>@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)

            <tr>
                <td>{{$product->id}}</td>
                <td>{{ $product->category->name ?? ''}}</td>
                <td>{{ $product->name ?? ''}}</td>
                <td>{{ Str::limit($product->description ?? '',50) ?? ''}}</td>
                <td>{{ $product->start_bid_price ?? ''}}</td>
                <td>{{ $product->status ?? ''}}</td>
                <td>
                    <img src="{{asset('uploads/images/thumbnail/' . $product->first_photo)}}" alt="{{$product->name}}">
                </td>

                <td>
                    <a href="{{ route('adminPanel.products.show', [$product->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                    {!! Form::open(['route' => ['adminPanel.product.approve', $product->id], 'method' => 'patch', 'class' => 'd-inline'])
                    !!}
                    <div class='btn-group'>
                        {!! Form::button('Approve', ['type' => 'submit', 'class' => 'btn btn-primary btn-sm']) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
</div>
