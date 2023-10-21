@extends('users.auth.layout.layout')

@section('content')
<form class="form-horizontal form-material" id="loginform" action="{{route('user.login')}}"
      method="post">
    @csrf
    <h3 class="text-center m-b-20">Sign In</h3>
    <div class="form-group ">
        <div class="col-xs-12">
            <input class="form-control" name="phone_number" id="phone_number" type="text" required="" placeholder="Phone Number"></div>
    </div>
    <div class="form-group text-center">
        <div class="col-xs-12 p-b-20">
            <button class="btn btn-block btn-lg btn-info btn-rounded" onclick="sendOtp()" type="button">Send OTP</button>
        </div>
    </div>

    @include('users.auth.login-otp-modal')
</form>


@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>

<script>
    function sendOtp() {
        {
            axios.post('{!! route('user.login.otp') !!}', {
                phone_number: $('#phone_number').val(),
            }).then(function (response) {
                $('#loginOtpModal').modal('show');
                $(".modal-backdrop").remove();
            }.bind(this)).catch(function (e) {
                alert(e.response.data.errors);
            });
        }
    }
</script>
