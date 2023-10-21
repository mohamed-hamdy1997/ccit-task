@extends('users.layout.layout')

@section('breadcrump-header')
    Home Page
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
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#plansModal">
                                Subscribe to plan
                            </button>
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
                                        <td>{{ $subscription->Status }}</td>
                                        <td>{{ $subscription->start }}</td>
                                        <td>{{ $subscription->end }}</td>
                                        <td>--</td>
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
    </div>
@endsection
