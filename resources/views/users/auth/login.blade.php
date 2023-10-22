@extends('users.auth.layout.layout')

@section('content')
    <form class="form-horizontal form-material" id="loginform" action="{{route('user.login')}}"
          method="post">
        @csrf
        <h3 class="text-center m-b-20">Sign In</h3>
        <div class="form-group ">
            <div class="col-xs-12">
                <input class="form-control" name="phone_number" id="phone_number" onkeyup="checkPhoneNumber()"
                       type="tel" required="" placeholder="Phone Number">
            </div>
        </div>
        <div class="form-group text-center">
            <div class="col-xs-12 p-b-20">
                <button class="btn btn-block btn-lg btn-info btn-rounded disabled" onclick="sendOtp()" type="button"
                        id="sendOtpId" disabled>Send OTP
                </button>
            </div>
        </div>

        @include('users.auth.login-otp-modal')
    </form>

@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>

    <script>
        function sendOtp() {
            axios.post('{!! route('user.login.otp') !!}', {
                phone_number: $('#phone_number').val(),
            }).then(function (response) {
                $('#loginOtpModal').modal('show');
                $(".modal-backdrop").remove();
            }.bind(this)).catch(function (e) {
                alert(e.response.data.errors);
            });
        }

        function checkPhoneNumber() {
            var pattern = new RegExp("^01[0-2,5]{1}[0-9]{8}$");

            if (pattern.test($('#phone_number').val())) {
                $('#sendOtpId').prop('disabled', false)
                $('#sendOtpId').removeClass('disabled')
                $('#phone_number').removeClass('invalid-input')
            } else {
                $('#sendOtpId').prop('disabled', true)
                $('#sendOtpId').addClass('disabled')
                $('#phone_number').addClass('invalid-input')
            }
        }
    </script>
@endsection
