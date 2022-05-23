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
            {!! Form::open(['route' => 'center.store-ad', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
            <input type="hidden" id="imageCount" value="1">
            <div class="row clearfix">
                <div class="col-12">
                    <div class="add-new-page  bg-white p-20 m-b-20">
                        <div class="add-new-header clearfix">
                            <div class="row">
                                <div class="col-6">
                                    <div class="block-header">
                                        <h2>{{ __('create_ad') }}</h2>
                                    </div>
                                </div>
                                <div class="col-6 text-left">
                                    <a href="{{ route('center') }}" class="btn btn-primary btn-add-new btn-sm"><i class="fas fa-arrow-left"></i>
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
                    <div class="row add-new-page  bg-white p-20 m-b-20">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <h4 class="border-bottom">{{ __('ads_details') }}</h4>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            {{-- <div class="col-sm-12">
                                <div class="form-group">
                                    <lable for="upload" class="btn btn-primary">
                                        {{ __('ad_image') }}*
                                        <input id="upload" name="image" type="file" style="display: none">
                                    </lable>
                                </div>
                            </div> --}}
                            <input name="image" type="file"  >
                            <div class="col-sm-12">
                                <div class="form-group text-center">
                                    <img src="{{ static_asset('default-image/default-100x100.png') }} " id="image_preview" width="200" height="200" alt="image" class="img-responsive img-thumbnail">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="url" class="col-form-label">لینک تبلیغ*</label>
                                <input name="url" value="{{ old('url') }}" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="rank" class="col-form-label">جایگاه نمایش*</label>
                                <input id="rank" name="rank" required value="{{ old('rank') }}" type="text" class="form-control">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group form-float form-group-sm">
                                <button type="submit" class="btn btn-primary float-right m-t-20">{{ __('save') }}</button>
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
