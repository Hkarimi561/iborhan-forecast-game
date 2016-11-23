@extends('admin.master')
@section('stadium_nav_class', 'active')
@section('main_content')
    <h1 class="page-header">ایجاد استادیوم</h1>
    <div class="col-md-6">
        <form class="form-upload" id="question" action="{{ route('stadium_add') }}" method="post"
              enctype="multipart/form-data">
            {{ csrf_field() }}

            <input type="text" name="name" id="question" class="form-control rtl" placeholder="نام استادیوم " required
                   autofocus/>
            <input type="text" name="seat_count" id="type" class="form-control rtl" placeholder="ظرفیت" required
                   autofocus/>
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