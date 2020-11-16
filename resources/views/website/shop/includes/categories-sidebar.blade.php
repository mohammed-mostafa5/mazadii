<aside class="widget widget_shop">
    <h4 class="widget-title">@lang('lang.categories')</h4>
    <ul class="ps-list--categories">
        @foreach ($categories as $category)
        <li class="current-menu-item menu-item-has-children ">
            <p class="d-inline my-toggle button">{{$category->name}}</p>
            <span class="sub-toggle my-toggle"><i class="fa fa-angle-down"></i></span>
            <ul class="sub-menu ">
                @forelse ($category->children as $child)
                <li class=" {{ isset($id)? $id == $child->id ? 'current-menu-item active' : '' :''}}">
                    <a href="{{ route('website.shop.category', $child->id) }}">{{ $child->name }}</a>
                </li>
                @empty
                @endforelse
            </ul>
        </li>
        @endforeach
    </ul>
</aside>
