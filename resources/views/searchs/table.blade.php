<div class="box-body table-responsive no-padding">
    <table class="table table-hover table-bordered table-sorter">
        <thead>
            <tr>
                <th>
                    <a href="#" data-url="{{ $sortLinks['id']['url'] }}" class="sort {{ $sortLinks['id']['class'] }}">{{ trans('label.search.lbl_column_id') }}</a>
                </th>
                <th>
                    <a href="#" data-url="{{ $sortLinks['user_id']['url'] }}" class="sort {{ $sortLinks['user_id']['class'] }}">{{ trans('label.search.lbl_column_user_id') }}</a>
                </th>
                <th>
                    <a href="#" data-url="{{ $sortLinks['search_str']['url'] }}" class="sort {{ $sortLinks['search_str']['class'] }}">@lang('label.search.lbl_column_search_str')</a>
                </th>
                <th>
                    <a href="#" data-url="{{ $sortLinks['ip']['url'] }}" class="sort {{ $sortLinks['ip']['class'] }}">@lang('label.search.lbl_ip')</a>
                </th>
                <th>
                    <a href="#" data-url="{{ $sortLinks['user_agent']['url'] }}" class="sort {{ $sortLinks['user_agent']['class'] }}">@lang('label.search.lbl_column_user_agent')</a>
                </th>
                <th>
                    <a href="#" data-url="{{ $sortLinks['created_at']['url'] }}" class="sort {{ $sortLinks['created_at']['class'] }}">@lang('label.search.lbl_column_created_at')</a>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($searchs as $search)
            <tr data-id="{{ $search->id }}">
                <td>{!! $search->id !!}</td>
                <td>{!! $search->user_id !!}</td>
                <td>{!! $search->search_str !!}</td>
                <td>{!! $search->ip !!}</td>
                <td>{!! $search->user_agent !!}</td>
                <td>{!! $search->created_at !!}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- /.box-body -->
<div class="box-footer clearfix">
    {!! $searchs->links()!!}
</div>
