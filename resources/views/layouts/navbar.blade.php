<nav class="main-navbar">
    <div class="container">
        <ul>
            @foreach($menus as $menu)
            @if($menu->children->count() > 0)
            @php
            $hasVisibleChildren = $menu->children->filter(function ($submenu) {
            return auth()->user()->can($submenu->permission);
            })->count() > 0;
            @endphp

            @if($hasVisibleChildren)
            <li class="menu-item has-sub">
                <a href="#" class="menu-link">
                    <span><i class="{{ $menu->icon }} mx-1"></i>{{ $menu->name }}</span>
                </a>
                <div class="submenu">
                    <div class="submenu-group-wrapper">
                        <ul class="submenu-group">
                            @foreach($menu->children as $submenu)
                            @can($submenu->permission)
                            <li class="submenu-item">
                                <a href="{{ url($submenu->url) }}" class="submenu-link">
                                    <i class="{{ $submenu->icon }} mx-1"></i>{{ $submenu->name }}
                                </a>
                            </li>
                            @endcan
                            @endforeach
                        </ul>
                    </div>
                </div>
            </li>
            @endif
            @else
            @can($menu->permission)
            <li class="menu-item">
                <a href="{{ url($menu->url) }}" class="menu-link">
                    <span><i class="{{ $menu->icon }} mx-1"></i>{{ $menu->name }}</span>
                </a>
            </li>
            @endcan
            @endif
            @endforeach
        </ul>
    </div>
</nav>