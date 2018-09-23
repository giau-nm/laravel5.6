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
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ $pageTitle }}</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="col-md-4">
                            <form method="POST" action="{!! route('configs.update', $config->id) !!}" id="form-update" style="padding:10px">
                                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                <div class="form-group">
                                    <label>
                                        {!! trans('label.configs.is_show_notification') !!}
                                        <input type="checkbox" class="minimal" name="is_show_nf" {!! ($config->is_show_nf)? 'checked' : '' !!}>
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label>{!! trans('label.configs.style_notification') !!}</label>

                                    <div class="radio">
                                        <label>
                                            <input
                                                type="radio"
                                                name="style_notification"
                                                value="{{CONFIG_STYLE_NOTIFICATION_BASIC}}" @if($config->style_notification == CONFIG_STYLE_NOTIFICATION_BASIC)) {{ 'checked="checked"'}} @endif}}>
                                                <span class="help-block">{{ trans('label.configs.notification.lbl_notification_basic') }}</span>
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="style_notification" value="{{CONFIG_STYLE_NOTIFICATION_IMAGE}}" @if($config->style_notification == CONFIG_STYLE_NOTIFICATION_IMAGE)) {{ 'checked="checked"'}} @endif}}> <span class="help-block">{{ trans('label.configs.notification.lbl_notification_image') }}</span>
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="style_notification" value="{{CONFIG_STYLE_NOTIFICATION_LIST}}" @if($config->style_notification == CONFIG_STYLE_NOTIFICATION_LIST)) {{ 'checked="checked"'}} @endif}}> <span class="help-block">{{ trans('label.configs.notification.lbl_notification_list') }}</span>
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="style_notification" value="{{CONFIG_STYLE_NOTIFICATION_PROGRESS}}" @if($config->style_notification == CONFIG_STYLE_NOTIFICATION_PROGRESS)) {{ 'checked="checked"'}} @endif}}> <span class="help-block">{{ trans('label.configs.notification.lbl_notification_process') }}</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">{!! trans('label.common.btn_save') !!}</button>
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('extents_js')
    <script src="{{ url('js/config/config.js') }}"></script>
@endsection

