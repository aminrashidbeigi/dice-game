<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu"
            data-keep-expanded="false"
            data-auto-scroll="true"
            data-slide-speed="200">
            @if(Auth::user()->role_id == config('quickadmin.defaultRole'))
                <li @if(Request::path() == config('quickadmin.route').'/menu') class="active" @endif>
                    <a href="{{ url(config('quickadmin.route').'/menu') }}">
                        <i class="fa fa-list"></i>
                        <span class="title">{{ trans('quickadmin::admin.partials-sidebar-menu') }}</span>
                    </a>
                </li>
                <li @if(Request::path() == 'users') class="active" @endif>
                    <a href="{{ url('users') }}">
                        <i class="fa fa-users"></i>
                        <span class="title">{{ trans('quickadmin::admin.partials-sidebar-users') }}</span>
                    </a>
                </li>
                <li @if(Request::path() == 'roles') class="active" @endif>
                    <a href="{{ url('roles') }}">
                        <i class="fa fa-gavel"></i>
                        <span class="title">{{ trans('quickadmin::admin.partials-sidebar-roles') }}</span>
                    </a>
                </li>
                <li @if(Request::path() == config('quickadmin.route').'/actions') class="active" @endif>
                    <a href="{{ url(config('quickadmin.route').'/actions') }}">
                        <i class="fa fa-users"></i>
                        <span class="title">{{ trans('quickadmin::admin.partials-sidebar-user-actions') }}</span>
                    </a>
                </li>
            @endif
            @foreach($menus as $menu)
                @if($menu->menu_type != 2 && is_null($menu->parent_id))
                    @if(Auth::user()->role->canAccessMenu($menu))
                        <li @if(isset(explode('/',Request::path())[1]) && explode('/',Request::path())[1] == strtolower($menu->name)) class="active" @endif>
                            <a href="{{ route(config('quickadmin.route').'.'.strtolower($menu->name).'.index') }}">
                                <i class="fa {{ $menu->icon }}"></i>
                                <span class="title">{{ $menu->title }}</span>
                            </a>
                        </li>
                    @endif
                @else
                    @if(Auth::user()->role->canAccessMenu($menu) && !is_null($menu->children()->first()) && is_null($menu->parent_id))
                        <li>
                            <a href="#">
                                <i class="fa {{ $menu->icon }}"></i>
                                <span class="title">{{ $menu->title }}</span>
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                @foreach($menu['children'] as $child)
                                    @if(Auth::user()->role->canAccessMenu($child))
                                        <li
                                                @if(isset(explode('/',Request::path())[1]) && explode('/',Request::path())[1] == strtolower($child->name)) class="active active-sub" @endif>
                                            <a href="{{ route(strtolower(config('quickadmin.route').'.'.$child->name).'.index') }}">
                                                <i class="fa {{ $child->icon }}"></i>
                                                <span class="title">
                                                    {{ $child->title  }}
                                                </span>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>

                        <li>
                            <a href="#">
                                <i class="fa {{ $menu->icon }}"></i>
                                <span class="title">Games</span>
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="{{ route('game.index') }}">
                                        <i class="fa-user"></i>
                                        <span class="title">
                                        Your Games
                                    </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('game.list') }}">
                                        <i class="fa-user"></i>
                                        <span class="title">
                                        Game List
                                    </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('game.playing') }}">
                                        <i class="fa-user"></i>
                                        <span class="title">
                                        Playing Games
                                    </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                @endif
            @endforeach
            <li>
                {!! Form::open(['url' => 'logout']) !!}
                <button type="submit" class="logout">
                    <i class="fa fa-sign-out fa-fw"></i>
                    <span class="title">{{ trans('quickadmin::admin.partials-sidebar-logout') }}</span>
                </button>
                {!! Form::close() !!}
            </li>
        </ul>
    </div>
</div>
