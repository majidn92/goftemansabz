@extends('common::layouts.master')
@section('section')
    active
@endsection


@section('content')
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <div class="row">
                <div class="col-12">
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
            </div>
            <div class="row" style="justify-content: flex-end">
                <a href="{{ url('setting/sections') }}" class="btn btn-primary float-left m-2"><i class="fa fa-bars"></i>
                    بخش ها
                </a>
            </div>
            <form action="{{ url('setting/section-store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="post_on_title" class="col-form-label">نام</label>
                            <input name="name" value="{{ old('name') }}" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="post_on_title" class="col-form-label">لینک</label>
                            <input name="url" value="{{ old('url') }}" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="post_on_title" class="col-form-label">رنگ</label>
                            <input name="color" value="{{ old('color') }}" type="color" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="post_on_title" class="col-form-label">جایگاه نمایش</label>
                            <input name="rank" value="{{ old('rank') }}" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-3 offset-sm-9 p-l-15">
                        <label class="custom-control custom-checkbox pt-1">
                            <input type="checkbox" id="show" name="show" class="custom-control-input">
                            <span class="custom-control-label"></span>
                            <label>نمایش</label>
                        </label>
                    </div>
                    <div class="col-sm-3 p-l-15 option">
                        <label class="custom-control custom-checkbox pt-1">
                            <input type="checkbox" id="slider" name="slider" class="custom-control-input">
                            <span class="custom-control-label"></span>
                            <label for="slider">نمایش اسلایدر</label>
                        </label>
                    </div>
                    <div class="col-sm-3 p-l-15 option">
                        <label class="custom-control custom-checkbox pt-1">
                            <input type="checkbox" id="last_post" name="last_post" class="custom-control-input">
                            <span class="custom-control-label"></span>
                            <label for="last_post">نمایش آخرین اخبار</label>
                        </label>
                    </div>
                    <div class="col-sm-3 p-l-15 option">
                        <label class="custom-control custom-checkbox pt-1">
                            <input type="checkbox" id="video" name="video" class="custom-control-input">
                            <span class="custom-control-label"></span>
                            <label for="video">نمایش اخبار ویدئویی</label>
                        </label>
                    </div>
                    <div class="col-sm-3 p-l-15 option">
                        <label class="custom-control custom-checkbox pt-1">
                            <input type="checkbox" id="ads" name="ads" class="custom-control-input">
                            <span class="custom-control-label"></span>
                            <label for="ads">نمایش تبلیغات</label>
                        </label>
                    </div>
                    <div class="col-sm-3 p-l-15">
                        <label class="custom-control custom-checkbox pt-1">
                            <input type="file" id="image" name="ads" class="custom-control-input">
                            <span class="custom-control-label"></span>
                            <label for="ads">نمایش تبلیغات</label>
                        </label>
                    </div>
                </div>
                <div class="col-sm-6 p-l-15">
                    <button type="submit" class="btn btn-primary">ذخیره</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(".option").hide();

        $("#show").change(function(e) {
            e.preventDefault();
            if ($(this).is(':checked')) {
                $(".option").show();
            } else {
                $(".option").hide();
                $(".option input").prop('checked', false);
            }
        });
    </script>
@endsection
