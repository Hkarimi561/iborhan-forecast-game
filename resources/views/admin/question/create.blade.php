@extends('admin.master')
@section('question_nav_class', 'active')
@section('main_content')
    <h1 class="page-header"> ایجاد سوال</h1>
    <div class="col-md-6" >
        <form class="form-upload" id="question" action="{{ route('question_add') }}" method="post"
              enctype="multipart/form-data">
            {{ csrf_field() }}

            <input type="text" name="question" id="question" class="form-control rtl" placeholder="سوال " required
                   autofocus/>
            <input type="text" name="type" id="type" class="form-control rtl" placeholder="نوع" required
                   autofocus/>
            <input type="text" name="event" id="event" class="form-control rtl" placeholder="واقعه " required
                   autofocus/>
    <input class="btn btn-lg btn-primary btn-block" type="submit" id="submit" value="اضافه کردن" name="upload">

    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

            <p>{{ session('success') }}</p>
        </div>
        @endif
        </form>
        </div>
@endsection