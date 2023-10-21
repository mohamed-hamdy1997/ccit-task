@extends('users.layout.layout')

@section('breadcrump-header')
    Home Page
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdn.moyasar.com/mpf/1.12.0/moyasar.css" />
@endsection

@section('content')
    <div id="homePageSection" class="row">
        <div class="col-12">
            <div class="card">
                <!-- .left-right-aside-column-->
                <div class="contact-page-aside">
                    <div class="right-aside ">
                        <h4 class="mb-n3">HI {{ auth()->user()->name }},
                            the below data for your subscription:-
                            @if(!$subscription)
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#plansModal">
                                    Subscribe to plan
                                </button>
                            @endif
                        </h4>
                        <!-- Add Contact Popup Model -->
                        <div class="table-responsive">
                            <table id="demo-foo-addrow"
                                   class="table no-wrap table-bordered m-t-30 table-hover contact-list"
                                   data-paging="true" data-paging-size="7">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Plan Name</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Start At</th>
                                    <th>End At</th>
                                    <th>Options</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($subscription)
                                    <tr>
                                        <td>#{{ $subscription->id }}</td>
                                        <td>
                                            {{ $subscription->plan?->name }}
                                        </td>
                                        <td>{{ $subscription->price }}SAR</td>
                                        <td>{{ array_flip(\App\Models\Subscription::STATUSES)[$subscription->status] }}</td>
                                        <td>{{ $subscription->start }}</td>
                                        <td>{{ $subscription->end }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#plansModal">
                                                Change Your Plan
                                            </button>
                                        </td>
                                    </tr>
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
        @include('users.plans-modal')
        @include('users.moyasar-form-modal')
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.moyasar.com/mpf/1.12.0/moyasar.js"></script>

    <script>
        function initMoyasar(planId, price, planName) {
            var callback = '{{ route('user.subscribeToPlan', ':id') }}'
            callback = callback.replace(':id', planId);
            Moyasar.init({
                element: '.mysr-form',
                amount: price * 100,
                currency: 'SAR',
                description: 'Subscribe to '+ planName + ' plan',
                publishable_api_key: '{{ config('services.moyasar.public_key') }}',
                callback_url: callback,
                supported_networks: [ 'mada'],
                methods: ['creditcard']
            })
        }
    </script>
@endsection
