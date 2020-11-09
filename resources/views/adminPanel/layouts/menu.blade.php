{{-- <center class="text-danger">-- Administrator --</center> --}}
@can('admins view')
<li class="nav-item {{ Request::is('adminPanel/admins*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('adminPanel.admins.index') }}">
        <i class="nav-icon icon-user"></i>
        <span>@lang('models/admins.plural')</span>
    </a>
</li>
@endcan

@can('roles view')
<li class="nav-item {{ Request::is('adminPanel/roles*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('adminPanel.roles.index') }}">
        <i class="nav-icon icon-check "></i>
        <span>@lang('models/roles.plural')</span>
    </a>
</li>
@endcan

{{-- <center class="text-danger">-- Pages --</center> --}}

@can('metas view')
<li class="nav-item {{ Request::is('adminPanel/metas*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('adminPanel.metas.index') }}">
        <i class="nav-icon icon-pencil icons"></i>
        <span>@lang('models/metas.plural')</span>
    </a>
</li>
@endcan

@can('pages view')
<li class="nav-item {{ Request::is('adminPanel/pages*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('adminPanel.pages.index') }}">
        <i class="nav-icon icon-docs"></i>
        <span>@lang('models/pages.plural')</span>
    </a>
</li>
@endcan


@can('sliders view')
<li class="nav-item {{ Request::is('adminPanel/sliders*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('adminPanel.sliders.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>@lang('models/sliders.plural')</span>
    </a>
</li>
@endcan

@can('information view')
<li class="nav-item {{ Request::is('adminPanel/information*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('adminPanel.information.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>@lang('models/information.plural')</span>
    </a>
</li>
@endcan

@can('contacts view')
<li class="nav-item {{ Request::is('adminPanel/contacts*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('adminPanel.contacts.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>@lang('models/contacts.plural')</span>
    </a>
</li>
@endcan

@can('newsletters view')
<li class="nav-item {{ Request::is('adminPanel/newsletters*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('adminPanel.newsletters.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>@lang('models/newsletters.plural')</span>
    </a>
</li>
@endcan
{{-- <center class="text-danger">-- Advanced --</center> --}}
{{--
@can('partners view')
<li class="nav-item {{ Request::is('adminPanel/partners*') ? 'active' : '' }}">
<a class="nav-link" href="{{ route('adminPanel.partners.index') }}">
    <i class="nav-icon icon-cursor"></i>
    <span>@lang('models/partners.plural')</span>
</a>
</li>
@endcan

@can('coupons view')
<li class="nav-item {{ Request::is('adminPanel/coupons*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('adminPanel.coupons.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>@lang('models/coupons.plural')</span>
    </a>
</li>
@endcan --}}

@can('socialLinks view')
<li class="nav-item {{ Request::is('adminPanel/socialLinks*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('adminPanel.socialLinks.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>@lang('models/socialLinks.plural')</span>
    </a>
</li>
@endcan


{{-- <br>

<center class="text-danger">-- Services --</center>

<br> --}}
{{--
<li class="nav-item {{ Request::is('adminPanel/categoryService*') ? 'active' : '' }}">
<a class="nav-link" href="{{ route('adminPanel.categoryService.index') }}">
    <i class="nav-icon icon-cursor"></i>
    <span>@lang('models/categoryService.plural')</span>
</a>
</li> --}}

<li class="nav-item {{ Request::is('adminPanel/categories*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('adminPanel.categoryProduct.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>@lang('models/categories.plural')</span>
    </a>
</li>

{{-- <li class="nav-item {{ Request::is('adminPanel/categoryMagazine*') ? 'active' : '' }}">
<a class="nav-link" href="{{ route('adminPanel.categoryMagazine.index') }}">
    <i class="nav-icon icon-cursor"></i>
    <span>@lang('models/categoryMagazine.plural')</span>
</a>
</li> --}}

{{-- <li class="nav-item {{ Request::is('adminPanel/categoryBlog*') ? 'active' : '' }}">
<a class="nav-link" href="{{ route('adminPanel.categoryBlog.index') }}">
    <i class="nav-icon icon-cursor"></i>
    <span>@lang('models/categoryBlog.plural')</span>
</a>
</li> --}}

{{-- <li class="nav-item {{ Request::is('adminPanel/services*') ? 'active' : '' }}">
<a class="nav-link" href="{{ route('adminPanel.services.index') }}">
    <i class="nav-icon icon-cursor"></i>
    <span>@lang('models/services.plural')</span>
</a>
</li> --}}
{{-- <center class="text-danger">-- Products --</center> --}}

<li class="nav-item {{ Request::is('adminPanel/products*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('adminPanel.products.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>@lang('models/products.plural')</span>
    </a>
</li>

{{-- <li class="nav-item {{ Request::is('adminPanel/countries*') ? 'active' : '' }}">
<a class="nav-link" href="{{ route('adminPanel.countries.index') }}">
    <i class="nav-icon icon-cursor"></i>
    <span>@lang('models/countries.plural')</span>
</a>
</li> --}}
{{-- <li class="nav-item {{ Request::is('adminPanel/cities*') ? 'active' : '' }}">
<a class="nav-link" href="{{ route('adminPanel.countries.cities.index', ) }}">
    <i class="nav-icon icon-cursor"></i>
    <span>@lang('models/cities.plural')</span>
</a>
</li> --}}
{{-- <li class="nav-item {{ Request::is('adminPanel/petTypes*') ? 'active' : '' }}">
<a class="nav-link" href="{{ route('adminPanel.petTypes.index') }}">
    <i class="nav-icon icon-cursor"></i>
    <span>@lang('models/petTypes.plural')</span>
</a>
</li>
<li class="nav-item {{ Request::is('adminPanel/genders*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('adminPanel.genders.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>@lang('models/genders.plural')</span>
    </a>
</li>
<li class="nav-item {{ Request::is('adminPanel/colors*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('adminPanel.colors.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>@lang('models/colors.plural')</span>
    </a>
</li>
<li class="nav-item {{ Request::is('adminPanel/sizes*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('adminPanel.sizes.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>@lang('models/sizes.plural')</span>
    </a>
</li> --}}
<li class="nav-item {{ Request::is('adminPanel/packages*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('adminPanel.packages.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>@lang('models/packages.plural')</span>
    </a>
</li>
{{-- <li class="nav-item {{ Request::is('adminPanel/features*') ? 'active' : '' }}">
<a class="nav-link" href="{{ route('adminPanel.features.index') }}">
    <i class="nav-icon icon-cursor"></i>
    <span>@lang('models/features.plural')</span>
</a>
</li> --}}
{{-- <li class="nav-item {{ Request::is('adminPanel/styles*') ? 'active' : '' }}">
<a class="nav-link" href="{{ route('adminPanel.styles.index') }}">
    <i class="nav-icon icon-cursor"></i>
    <span>@lang('models/styles.plural')</span>
</a>
</li>
<li class="nav-item {{ Request::is('adminPanel/breeds*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('adminPanel.breeds.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>@lang('models/breeds.plural')</span>
    </a>
</li>
<li class="nav-item {{ Request::is('adminPanel/magazines*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('adminPanel.magazines.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>@lang('models/magazines.plural')</span>
    </a>
</li>
<li class="nav-item {{ Request::is('adminPanel/deliveries*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('adminPanel.deliveries.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>@lang('models/deliveries.plural')</span>
    </a>
</li>
<li class="nav-item {{ Request::is('adminPanel/weights*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('adminPanel.weights.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>@lang('models/weights.plural')</span>
    </a>
</li>
<li class="nav-item {{ Request::is('adminPanel/brands*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('adminPanel.brands.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>@lang('models/brands.plural')</span>
    </a>
</li>
<li class="nav-item {{ Request::is('adminPanel/vets*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('adminPanel.vets.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>@lang('models/vets.plural')</span>
    </a>
</li>
<li class="nav-item {{ Request::is('adminPanel/blogs*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('adminPanel.blogs.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>@lang('models/blogs.plural')</span>
    </a>
</li>
<li class="nav-item {{ Request::is('adminPanel/blocks*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('adminPanel.blocks.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>@lang('models/blocks.plural')</span>
    </a>
</li> --}}
