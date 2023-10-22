@extends('users.layout.layout')

@section('breadcrump-header')
    Payment History
@endsection

@section('content')
    <div id="paymentHistorySection" class="row">
        <div class="col-12">
            <div class="card">
                <!-- .left-right-aside-column-->
                <div class="contact-page-aside">
                    <div class="right-aside ">
                        <h4 class="mb-n3">HI {{ auth()->user()->name }},
                            the below data for your payment history:-
                        </h4>
                        <!-- Add Contact Popup Model -->
                        <div class="table-responsive">
                            <table id="demo-foo-addrow"
                                   class="table no-wrap table-bordered m-t-30 table-hover contact-list"
                                   data-paging="true" data-paging-size="7">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Payment ID</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Details</th>
                                    <th>Occurred At</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if(!empty($payments))
                                   @foreach($payments as $payment)
                                       <tr>
                                           <td>#{{ $payment->id }}</td>
                                           <td>{{ $payment->payment_id }}</td>
                                           <td>{{ $payment->type }}</td>
                                           <td>{{ $payment->amount }}SAR</td>
                                           <td>{{ $payment->details }}</td>
                                           <td>{{ $payment->created_at->toDateTimeString() }}</td>
                                       </tr>
                                   @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- .left-aside-column-->
                    </div>
                    <!-- /.left-right-aside-column-->
                </div>
            </div>
        </div>
    </div>
@endsection
