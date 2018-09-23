<li class="{{ Request::is('configs*') ? 'active' : '' }}">
    <a href="{!! route('configs.index') !!}"><i class="fa fa-edit"></i><span>Configs</span></a>
</li><li class="{{ Request::is('searchs*') ? 'active' : '' }}">
    <a href="{!! route('searchs.index') !!}"><i class="fa fa-edit"></i><span>Searchs</span></a>
</li>


