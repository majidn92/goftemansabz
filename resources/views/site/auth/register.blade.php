@extends('site.layouts.app')
@php
// dd(90)
@endphp

@section('style')
    <link rel="stylesheet" href="{{ url('public/vendor/persian-datepicker/persian-datepicker.css') }}">
@endsection

@section('content')
    <div class="ragister-account text-center">
        <div class="container">
            <div class="account-content">
                <h1 style="background-color: var(--primary-color);color: white;text-align: center;">{{ __('sign_up') }}</h1>
                {{-- @include('site.partials.error') --}}
                <form class="ragister-form pb-0" name="ragister-form" method="post" action="{{ route('site.register') }}">
                    @csrf
                    <div class="form-group text-left mb-0">
                        <label>{{ __('first_name') }} *</label>
                        <input name="first_name" value="{{old('first_name')}}" type="text" class="form-control" required="required" placeholder="{{ __('first_name') }}">
                    </div>
                    <div class="form-group text-left mb-0">
                        <label>{{ __('last_name') }} *</label>
                        <input name="last_name" value="{{old('last_name')}}" type="text" class="form-control" required="required" placeholder="{{ __('last_name') }}">
                    </div>
                    <div class="form-group text-left mb-0">
                        <label>{{ __('email') }} *</label>
                        <input name="email" value="{{old('email')}}" type="email" class="form-control" required="required" placeholder="{{ __('email') }}">
                    </div>
                    <div class="form-group text-left mb-0">
                        <label>{{ __('mobile') }} </label>
                        <input name="phone" value="{{old('phone')}}" type="text" class="form-control" placeholder="شماره موبایل">
                    </div>
                    <div class="form-group text-left mb-0">
                        <label>{{ __('dob') }} *</label>
                        <input name="dob" type="text" class="form-control example1" required>
                    </div>
                    <div class="form-group text-left mb-0">
                        <label>{{ __('gender') }} *</label>
                        <select class="form-control" name="gender" id="gender">
                            <option>{{ __('select_option') }}</option>
                            @foreach (__('genders.genderType') as $value => $item)
                                <option value="{{ $value }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group text-left mb-0">
                        <label>{{ __('password') }} *</label>
                        <input name="password" type="password" class="form-control" required="required" placeholder="***********">
                    </div>
                    @if (settingHelper('captcha_visibility') == 1)
                        <div class="col-lg-12 text-center px-0 mb-4">
                            {!! NoCaptcha::renderJs() !!}
                            {!! NoCaptcha::display() !!}
                        </div>
                    @endif
                    <button type="submit">{{ __('sign_up') }}</button>
                    <div class="middle-content">
                        <p style="font-size: 14px">{{ __('already_have_an_account') }} <a href="{{ route('site.login.form') }}">{{ __('login') }}</a></p> {{-- <a href="#">Forgot your password?</a> --}}
                    </div>
                </form>
                <div class="widget-social">
                    <ul class="global-list">
                        @if (settingHelper('facebook_visibility') == 1)
                            <li class="facebook login"><a href="{{ url('/login/facebook') }}" style="background:#056ED8"><span style="background:#0061C2"><i class="fa fa-facebook" aria-hidden="true"></i></span>{{ __('sign_up_with_facebook') }} </a></li>
                        @endif
                        @if (settingHelper('google_visibility') == 1)
                            <li class="google login"><a href="{{ url('/login/google') }}" style="background:#FF5733"><span style="background:#CD543A"><i class="fa fa-google" aria-hidden="true"></i></span>{{ __('sign_up_with_google') }}</a></li>
                        @endif
                    </ul>
                </div>
                {{-- <!-- /.contact-form --> --}}
            </div>
            {{-- <!-- /.account-content --> --}}
        </div> {{-- <!-- /.container --> --}}
    </div> {{-- <!-- /.ragister-account --> --}}
@endsection

@section('script')
    @if (defaultModeCheck() == 'sg-dark')
        <script type="text/javascript">
            jQuery(function($) {
                $('.g-recaptcha').attr('data-theme', 'dark');
            });
        </script>
    @endif

    <script type="text/javascript" src="{{ url('public/vendor/persian-datepicker/persian-date.js') }}"></script>
    <script type="text/javascript" src="{{ url('public/vendor/persian-datepicker/persian-datepicker.js') }}"></script>


    <script>
        $(document).ready(function() {
            $(".example1").pDatepicker({
                'timePicker': {
                    'enabled': false,
                },
                format: ' YYYY/MM/DD ',

            });
        });
    </script>
@endsection
