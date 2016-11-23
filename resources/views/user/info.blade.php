@extends('master')
@section('main_content')
    <div class="row  pad-top">

        <div class="col-md-5 col-md-offset-5 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align: right">
                    <strong>تکمیل اطلاعات شخصی</strong>
                </div>
                <div class="panel-body">
                    <form class="form-upload" id="question" action="{{ route('user_submit') }}" method="post">
                        {{ csrf_field() }}

                        <br>
                        <div class="form-group input-group">
                            <span class="input-group-addon">نام</span>
                            <input type="text" class="form-control" name="first_name"
                                   placeholder="@if($user->first_name)
                                   {{$user->first_name}}
                                   @else
                                           نام
                                           @endif" style="text-align: right">

                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon">نام خانوادگی</span>
                            <input type="text" class="form-control" name="last_name" placeholder="@if($user->last_name)
                            {{$user->last_name}}
                            @else
                                    نام خانوادگی
                                    @endif" style="text-align: right">

                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon">کد ملی</span>
                            <input type="text" class="form-control" name="national_code"
                                   placeholder="@if($user->national_code)
                                   {{$user->national_code}}
                                   @else
                                           کد ملی
                                           @endif" style="text-align: right">

                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon">تاریخ تولد</span>
                            <input type="text" class="form-control" name="birth_day" placeholder="@if($user->birth_day)
                            {{$user->birth_day}}
                            @else
                                    تاریخ تولد
                                    @endif" style="text-align: right">

                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon">محل سکونت</span>
                            <input type="text" class="form-control" name="city_id" placeholder="@if($user->city_id)
                            {{$user->city_id}}
                            @else
                                    محل سکونت
                                    @endif">

                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon">تلفن همراه</span>
                            <input type="text" class="form-control" name="cell_phone"
                                   placeholder="@if($user->cell_phone)
                                   {{$user->cell_phone}}
                                   @else
                                           نام خانوادگی
                                           @endif">

                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon">تلفن</span>
                            <input type="text" class="form-control" name="phone" placeholder="@if($user->phone)
                            {{$user->phone}}
                            @else
                                    نام خانوادگی
                                    @endif">

                        </div>

                        <div class="form-group input-group">
                            <input type="submit" class="btn btn-success " name="upload" value="تکمیل اطلاعات">
                        </div>

                        @if(Session::has('success'))
                            <div class="alert alert-success" role="alert">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

                                <p>{{ session('success') }}</p>
                            </div>
                        @endif
                    </form>
                </div>

            </div>
        </div>


    </div>
@endsection