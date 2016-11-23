@extends('admin.master')
@section('team_nav_class', 'active')
@section('main_content')
    <div class="col-md-6">
        <h1 class="page-header">ایجاد تیم</h1>
        <form class="form-upload" id="question" action="{{ route('team_add') }}" method="post"
              enctype="multipart/form-data">
            {{ csrf_field() }}

            <input type="text" name="name" id="question" class="form-control rtl" placeholder="نام تیم " required
                   autofocus/>
            <input type="file" class="form-control" name="filename" id="imgInp" accept="image/*"/>

            <input class="btn btn-lg btn-primary btn-block" type="submit" id="submit" value="ثبت" name="upload">

            @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

                    <p>{{ session('success') }}</p>
                </div>
            @endif
        </form>
    </div>

@endsection