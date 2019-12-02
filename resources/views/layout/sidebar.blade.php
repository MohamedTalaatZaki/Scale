<div class="menu">
    <div class="main-menu">
        <div class="scroll">
            <ul class="list-unstyled">
                @foreach($main_menus as $main_menu)
                    @if($main_menu->hasPermissions())
                    <li>
                    <a class="{{ $main_menu->class }}" href="{{ $main_menu->href }}">
                        <i class="{{ config("fontawsome.{$main_menu->sub_class}" , 'iconsminds-digital-drawing') }}"></i>
                        <span>{{ $main_menu->name }}</span>
                    </a>
                    </li>

                    @endif
                @endforeach
            </ul>
        </div>
    </div>

    <div class="sub-menu">
        <div class="scroll">
            @foreach($main_menus as $main_menu)
                @if($main_menu->data_link != null && $main_menu->hasPermissions())
                    <ul class="list-unstyled" data-link="{{ $main_menu->data_link }}" id="{{ $main_menu->data_link }}">
                        @foreach($main_menu->menuGroups as $group)
                            @if($group->hasPermissions())
                            <li>
                                <a href="#" data-toggle="collapse" data-target="#{{ $group->aria_controls }}" aria-expanded="true"
                                   aria-controls="{{ $group->aria_controls }}" class="rotate-arrow-icon opacity-50">
                                    <i class="simple-icon-arrow-down"></i> <span class="d-inline-block">{{ $group->name }}</span>
                                </a>
                                <div id="{{ $group->aria_controls }}" class="collapse show">
                                    <ul class="list-unstyled inner-level-menu">
                                        @foreach($group->subMenus as $sub)
                                            @permission($sub->route)
                                                <li>
                                                    <a class="{{ $sub->a_class }}" href="{{ route($sub->route) }}">
                                                        <i class="{{ config("fontawsome.{$main_menu->i_class}" , 'iconsminds-digital-drawing') }}"></i> <span
                                                            class="d-inline-block">{{ $sub->name }}</span>
                                                    </a>
                                                </li>
                                            @endpermission
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                            @endif
                        @endforeach
                    </ul>
                @endif
            @endforeach
        </div>
    </div>
</div>
