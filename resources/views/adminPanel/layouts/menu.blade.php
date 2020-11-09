{{--////////// Users ////////////--}}
<div class="accordion" id="accordionUsers">
    <div class="card bg-dark m-0">
        <div class="card-header p-1" id="headingUsers">
            <h2 class="mb-0">
                <button class="btn btn-link text-decoration-none" type="button" data-toggle="collapse" data-target="#collapseUsers" aria-expanded="true" aria-controls="collapseUsers">
                    <i class="nav-icon icon-check  mr-2"></i>
                    <strong>Users</strong>
                </button>
            </h2>
        </div>

        <div id="collapseUsers" class="collapse {{ Request::is('adminPanel/roles*') ? 'show' : '' }}" aria-labelledby="headingUsers" data-parent="#accordionUsers">
            <div class="card-body p-0">
                @can('roles view')
                <li class="nav-item {{ Request::is('adminPanel/roles*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('adminPanel.roles.index') }}">
                        <i class="nav-icon icon-check "></i>
                        <span>@lang('models/roles.plural')</span>
                    </a>
                </li>
                @endcan

                @can('admins view')
                <li class="nav-item {{ Request::is('adminPanel/admins*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('adminPanel.admins.index') }}">
                        <i class="nav-icon icon-user"></i>
                        <span>@lang('models/admins.plural')</span>
                    </a>
                </li>
                @endcan
            </div>
        </div>
    </div>
</div>



{{--////////// Pages ////////////--}}
<div class="accordion" id="accordionPages">
    <div class="card bg-dark m-0">
        <div class="card-header p-1" id="headingPages">
            <h2 class="mb-0">
                <button class="btn btn-link text-decoration-none" type="button" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                    <i class="nav-icon icon-docs mr-2"></i>
                    <strong>@lang('models/pages.plural')</strong>
                </button>
            </h2>
        </div>

        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionPages">
            <div class="card-body p-0">
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

                @can('socialLinks view')
                <li class="nav-item {{ Request::is('adminPanel/socialLinks*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('adminPanel.socialLinks.index') }}">
                        <i class="nav-icon icon-cursor"></i>
                        <span>@lang('models/socialLinks.plural')</span>
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
            </div>
        </div>
    </div>
</div>



{{--////////// Products ////////////--}}
<div class="accordion nav-item" id="accordionProducts">
    <div class="card bg-dark m-0">
        <div class="card-header p-1" id="headingProducts">
            <h2 class="mb-0">
                <button class="btn btn-link text-decoration-none" type="button" data-toggle="collapse" data-target="#collapseProducts" aria-expanded="true" aria-controls="collapseProducts">
                    <i class="nav-icon icon-cursor mr-2"></i>
                    <strong>@lang('models/products.plural')</strong>
                </button>
            </h2>
        </div>

        <div id="collapseProducts" class="collapse" aria-labelledby="headingProducts" data-parent="#accordionProducts">
            <div class="card-body p-0">

                <li class="nav-item {{ Request::is('adminPanel/categories*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('adminPanel.categoryProduct.index') }}">
                        <i class="nav-icon icon-cursor"></i>
                        <span>@lang('models/categories.plural')</span>
                    </a>
                </li>

                <li class="nav-item {{ Request::is('adminPanel/products*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('adminPanel.products.index') }}">
                        <i class="nav-icon icon-cursor"></i>
                        <span>@lang('models/products.plural')</span>
                    </a>
                </li>
            </div>
        </div>
    </div>
</div>




<li class="nav-item {{ Request::is('adminPanel/packages*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('adminPanel.packages.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>@lang('models/packages.plural')</span>
    </a>
</li>
