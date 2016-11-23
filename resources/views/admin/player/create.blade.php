@extends('admin.master')
@section('player_nav_class', 'active')
@section('main_content')
    <h1 class="page-header">ایجاد بازیکن</h1>
    <div class="col-md-6" >
        <form class="form-upload" id="question" action="{{ route('player_add') }}" method="post"
              enctype="multipart/form-data">
            {{ csrf_field() }}

            <input type="text" name="name" id="name" class="form-control rtl" placeholder="نام " required
                   autofocus/>
            <input type="text" name="number" id="number" class="form-control rtl" placeholder="شماره بازیکن" required
                   autofocus/>
            <input type="text" name="age" id="age" class="form-control rtl" placeholder="سن " required
                   autofocus/>
            <input type="text" name="height" id="height" class="form-control rtl" placeholder="قد " required
                   autofocus/>
            <input type="text" name="weight" id="weight" class="form-control rtl" placeholder="وزن " required
                   autofocus/>
            <select class="js-example-basic-single" name="team_id">
                @foreach($teams as $team)
                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                @endforeach
            </select>
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
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $(".js-example-basic-single").select2();
        });
    </script>
@endsection