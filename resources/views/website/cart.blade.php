@extends('website.layouts.app')

@section('content')
<div class="ps-page--simple">
    <div class="ps-section--shopping ps-shopping-cart">
        <div class="container">
            <div class="ps-section__header">
                <h1>Shopping Cart</h1>
            </div>
            <div class="ps-section__content">
                <div class="table-responsive">
                    <table class="table ps-table--shopping-cart">
                        <thead>
                            <tr>
                                <th>Product name</th>
                                <th>PRICE</th>
                                <th>QUANTITY</th>
                                <th>TOTAL</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($products as $product)
                            <tr>
                                <td>
                                    <div class="ps-product--cart">
                                        <div class="ps-product__thumbnail"><a
                                                href="{{route('website.shop.product', $product->id)}}"><img
                                                    src="{{asset("uploads/images/thumbnail/".$product->photo)}}"
                                                    alt="{{$product->name}}"></a></div>
                                        <div class="ps-product__content"><a
                                                href="{{ route('website.shop.product', $product->id )}}">{{$product->name ?? ''}}</a>
                                            <p>Sold By:<strong> {{$product->company->name ?? ''}}</strong></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="price">
                                    $ {{$product->price()}}
                                </td>
                                <td>
                                    <div class="form-group--number">
                                        <input class="form-control quantity"
                                            quantityUrl="{{ route('pharmacyPanel.quantityUpdate', $product->id) }}"
                                            id="{{ $product->id }}" name="quantity" type="number" placeholder="1"
                                            value="{{ $product->pivot->quantity }}">
                                    </div>
                                </td>
                                <td class="total-{{$product->id}}">{{ $product->pivot->quantity * $product->price() }}
                                </td>
                                <td>
                                    <a href="{{ route('pharmacyPanel.removeProductCart', $product->id) }}">
                                        <i class="icon-cross"></i>
                                    </a>
                                </td>
                            </tr>

                            @empty

                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="ps-section__cart-actions">
                    <a class="ps-btn" href="{{ route('pharmacyPanel.checkout') }}">Place Order
                    </a>
                    <a class="ps-btn ps-btn--outline" href="{{ route('pharmacyPanel.showCart') }}">
                        <i class="icon-sync"></i> Update cart
                    </a>
                </div>
            </div>
            <div class="ps-section__footer">
                <div class="row">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
