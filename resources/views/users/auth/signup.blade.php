@extends('users.auth.layout.layout')

@section('content')
    <form class="form-horizontal form-material" id="loginform" action="{{route('user.signup')}}"
          method="post">
        @csrf
        <h3 class="text-center m-b-20">Signup</h3>
        <div class="form-group ">
            <div class="col-xs-12">
                <input class="form-control" name="name" type="text" required="" placeholder="Name"></div>
        </div>

        <div class="form-group ">
            <div class="col-xs-12">
                <input class="form-control" name="phone_number" id="phone_number" type="tel"
                       pattern="^01[0-2,5]{1}[0-9]{8}$" required="" placeholder="Phone Number">
            </div>
        </div>
        <div class="form-group text-center">
            <div class="col-xs-12 p-b-20">
                <button class="btn btn-block btn-lg btn-info btn-rounded" type="submit">Signup</button>
            </div>
        </div>
    </form>
@endsection
