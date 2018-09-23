@extends('layouts.master')
@section('page_title', $pageTitle)
@section('extents_css')
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {!! $pageTitle !!}
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="clearfix"></div>
            <!-- /.row -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header" style="min-height: 95px;">
                            <div class="box-tools">
                                <form action="" method="GET">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="q" value="{{ app('request')->input('q') }}" class="form-control pull-right" placeholder="{{ trans('label.common.lbl_placeholder_search') }}">

                                        <div class="input-group-btn">
                                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <!-- /.box-header -->
                        @include('searchs.table')
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('extents_js')
@endsection