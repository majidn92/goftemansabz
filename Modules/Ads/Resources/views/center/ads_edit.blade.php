@extends('common::layouts.master')
@section('ads-aria-expanded')
    aria-expanded="true"
@endsection
@section('ads-show')
    show
@endsection
@section('ads')
    active
@endsection
@section('ads_active')
    active
@endsection
@section('ads_center')
    active
@endsection
@section('modal')
    @include('gallery::image-gallery')
@endsection

@section('content')

    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <!-- page info start-->
            {!! Form::open(['route' => ['side.update-ad', $ad->id], 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
            <div class="row clearfix">

                <div class="col-12">
                    <div class="add-new-page  bg-white p-20 m-b-20">
                        <div class="add-new-header clearfix">
                            <div class="row">
                                <div class="col-6">
                                    <div class="block-header">
                                        <h2>{{ __('edit_ad') }}</h2>
                                    </div>
                                </div>
                                <div class="col-6 text-left">
                                    <a href="{{ route('side') }}" class="btn btn-primary btn-add-new btn-sm"><i class="fas fa-arrow-left"></i>
                                        {{ __('back_to_ads') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if (session('error'))
                        <div id="error_m" class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div id="success_m" class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </div>

                <div class="col-12">
                    <div class="add-new-page  bg-white p-20 m-b-20">
                        <div class="block-header">
                            <div class="form-group">
                                <h4 class="border-bottom">{{ __('ads_details') }}</h4>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="url" class="col-form-label">لینک*</label>
                                <input id="url" value="{{ $ad->url }}" name="url" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="rank" class="col-form-label">جایگاه*</label>
                                <input id="rank" value="{{ $ad->rank }}" name="rank" required type="text" class="form-control">
                            </div>
                        </div>
                        <div id="div_ad_image">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <lable class="btn btn-primary">
                                        {{ __('update_ad_image') }}*
                                        <input value="{{ $ad->ad_image_id }}" name="image" type="file" class="form-control">
                                    </lable>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group text-center">
                                    <img src="{{ url($ad->path) }}" id="image_preview" width="200" height="200" alt="image" class="img-responsive img-thumbnail">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group form-float form-group-sm">
                                    <button type="submit" class="btn btn-primary float-right m-t-20">{{ __('save') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            {{ Form::close() }}
            <!-- page info end-->
        </div>
    </div>
@endsection
