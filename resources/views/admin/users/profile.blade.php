@extends('admin.index')

@section('breadcrump-header')
    Profile
@endsection

@section('styles')
    <style>
        .major {
            height: 61px;
            vertical-align: -webkit-baseline-middle;
        }
    </style>
@endsection
@section('content')
    <div class="row" id="profileSection">
        <!-- Column -->
        <div class="col-lg-4 col-xlg-3 col-md-5">
            <div class="card">
                <div class="card-body">
                    <center class="m-t-30"><img src="{{  env('APP_URL') . "/storage/". $user->personal_image }}"
                                                class="img-circle" width="150"/>
                        <h4 class="card-title m-t-10">{{ $user->name }}</h4>
                        <h6 class="card-subtitle"><span class="font-14 label label-inverse pb-1 pl-3 pr-3 pt-1">{{ $user->type }}</span></h6>
                        @if(in_array(auth()->user()->role_name, [\App\Models\Role::ADMIN_ROLES['master'], \App\Models\Role::ADMIN_ROLES['chat_and_account_order_status']]))
                            <button class="btn btn-sm btn-secondary" onclick="openSendMessageModal()"><h6 class="card-title m-t-10" >Send Message (Chat)</h6></button>
                        @endif
                    </center>
                </div>
                <div>
                    <hr>
                </div>
                <div class="card-body"><small class="text-muted">Email address </small>
                    <h6>{{ $user->email }}</h6> <small class="text-muted p-t-30 db">Phone</small>
                    <h6>{{ $user->phone_number }}</h6> <small class="text-muted p-t-30 db">City</small>
                    <h6>{{ $user->city }}</h6> <small class="text-muted p-t-30 db">Zone</small>
                    <h6>{{ $user->zone }}</h6>
                    <small class="text-muted p-t-30 db">Status</small>
                    @if(in_array(auth()->user()->role_name, [\App\Models\Role::ADMIN_ROLES['master'], \App\Models\Role::ADMIN_ROLES['account_status'], \App\Models\Role::ADMIN_ROLES['chat_and_account_order_status']]))
                    <select class="form-control" id="status-{{$user->id}}"
                            onchange="updateStatus('{{ $user->id }}')">
                        @foreach(\App\Models\User::ACCOUNT_STATUSES as $text => $value)
                            <option value="{{ $value }}"
                                    @if($user->status == $value) selected @endif>
                                {{ strtoupper($text) }}
                            </option>
                        @endforeach
                    </select>
                    @else
                        <h6>{{ \App\Models\User::MAP_ACCOUNT_STATUSES[$user->status] }}</h6>
                    @endif
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-8 col-xlg-9 col-md-7">
            <div class="card">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs profile-tab" role="tablist">
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#profile" role="tab">Profile
                            Info</a></li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#feedback" role="tab">
                            Feedback
                        </a>
                    </li>

                    @if($user->type == \App\Models\User::USER_TYPES['lawyer'])
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#experience" role="tab">
                                Experience & Scientific Expertises
                            </a>
                        </li>
                    @endif
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <!--profile info tab-->
                    <div class="tab-pane active" id="profile" role="tabpanel">
                        <div class="card-body">
                            <h3 class="">Brief about me:</h3>
                            <p class="m-t-15">{!! $user->about ?? '-' !!}</p>

                            @if($user->lawyer)
                                <hr>
                                <div>
                                    <h4 class="font-medium m-t-30">Majors:</h4>
                                    <div>
                                        @forelse($user->lawyer->majors as $major)
                                            <span class="b-all p-10 radius d-inline-block major mr-2">
                                        <img src="{{ env('APP_URL') . "/{$major->icon}" }}" alt="major"
                                             width="40" class="img-circle"/>
                                        {{ $major->name }}
                                    </span>
                                        @empty
                                            <h4 class="col-12 text-danger">No Majors Selected.</h4>
                                        @endforelse
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <!-- Card -->
                                            <div class="card b-all radius">
                                                <div class="card-body">
                                                    <h4 class="card-title">License Image:</h4>
                                                </div>
                                                @if($user->lawyer->license_img)
                                                    <img class="card-img-top img-responsive"
                                                         src="{{ env('APP_URL'). "/storage/{$user->lawyer->license_img}" }}"
                                                         alt="Card image cap">
                                                @else
                                                    <h4 class="text-center">-</h4>
                                                @endif
                                            </div>
                                            <!-- Card -->
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <!-- Card -->
                                            <div class="card b-all radius">
                                                <div class="box bg-info text-center">
                                                    <h3 class="font-light text-white">ID Number:</h3>
                                                    <h4 class="text-white">{{ $user->lawyer->id_number ?? '-' }}</h4>
                                                </div>
                                            </div>
                                            <div class="card b-all radius">
                                                <div class="box bg-info text-center">
                                                    <h3 class="font-light text-white">ID Expiry Date:</h3>
                                                    <h4 class="text-white">{{ $user->lawyer->id_expiry_date ?? '-' }}</h4>
                                                </div>
                                            </div>
                                            <!-- Card -->
                                        </div>
                                    </div>
                                    <hr>
                                    <h4 class="font-medium m-t-30">Certifications:</h4>
                                    <div class="row">
                                        @forelse($user->lawyer->certifications as $certification)
                                            <div class="col-lg-6 col-md-6">
                                                <!-- Card -->
                                                <div class="card b-all radius">
                                                    <img class="card-img-top img-responsive"
                                                         src="{{ env('APP_URL'). "/storage/{$certification->certificate_img}" }}"
                                                         alt="Certification">
                                                </div>
                                                <!-- Card -->
                                            </div>
                                        @empty
                                            <h4 class="col-12 text-danger">No Certifications Added.</h4>
                                        @endforelse
                                    </div>
                                    <hr>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!--feedback info tab-->
                    <div class="tab-pane" id="feedback" role="tabpanel">
                        <div class="card-body">
                            <div class="row">

                                @forelse($comments as $comment)
                                    <!-- .col -->
                                    <div class="col-md-12 col-sm-12">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12">
                                                <a href="{{ route('admin.getUserProfile', $comment->from_user_id) }}"
                                                   target="_blank">
                                                    <h5 class="card-title m-b-0">
                                                        {{ $comment->fromUser->name }}
                                                    </h5>
                                                </a>
                                                <small
                                                    class="@if($comment->type == \App\Models\Comment::TYPES['report']) text-danger @else text-warning @endif">{{ strtoupper($comment->type) }}</small>
                                                <p>
                                                <address>
                                                    {{ $comment->description }}
                                                    <br/>
                                                    <br/>
                                                    <abbr
                                                        title="Created At">AT:</abbr> {{ $comment->created_at->toDateTimeString() }}
                                                </address>
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <!-- /.col -->
                                @empty
                                    <h3>NO COMMENTS.</h3>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    @if($user->type == \App\Models\User::USER_TYPES['lawyer'])
                        <!--experience info tab-->
                        <div class="tab-pane" id="experience" role="tabpanel">
                            <div class="card-body">

                                <h4 class="mb-n3">Experiences</h4>

                                <div class="table-responsive">
                                    <table id="demo-foo-addrow"
                                           class="table no-wrap table-bordered m-t-30 table-hover contact-list"
                                           data-paging="true" data-paging-size="7">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Entity</th>
                                            <th>Experience Years</th>
                                            <th>Title</th>
                                            <th>Job Description</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach((array)$user->lawyer->experience as $index => $experience)
                                            <tr>
                                                <td>{{ $index+1 }}</td>
                                                <td>{{ @$experience['entity'] }}</td>
                                                <td>{{ @$experience['experience_years'] }}</td>
                                                <td>{{ @$experience['title'] }}</td>
                                                <td>{{ @$experience['job_description'] }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <hr>
                                <h4 class="mb-n3">Scientific Expertises</h4>

                                <div class="table-responsive">
                                    <table id="demo-foo-addrow"
                                           class="table no-wrap table-bordered m-t-30 table-hover contact-list"
                                           data-paging="true" data-paging-size="7">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Entity</th>
                                            <th>Study Years</th>
                                            <th>Graduation Year</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse((array)$user->lawyer->scientific_expertises as $index => $scientific)
                                            <tr>
                                                <td>{{ $index+1 }}</td>
                                                <td>{{ @$scientific['entity'] }}</td>
                                                <td>{{ @$scientific['study_years'] }}</td>
                                                <td>{{ @$scientific['graduation_year'] }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center"><h3>No Result</h3></td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @include('admin.users.sendMessageModal')
        <!-- Column -->
    </div>
@endsection

@section('scripts')
    <script>
        var __profile__ = new Vue({
            el: '#profileSection',
            data: {
                sendMessageLoader:false
            },
            methods: {
                updateStatus(id) {
                    let route = '{{route('admin.updateLawyerStatus', ':id')}}'
                    route = route.replace(':id', id);
                    axios.put(route, {
                        status: $('#status-' + id).val(),
                    }).then((res) => {
                        alert('done, updated successfully.');
                    }).catch((error) => {
                        alert(error.response.data.error);
                    });
                },
                sendMessage() {
                    this.sendMessageLoader = true;
                    axios.post('{{route('admin.sendMessage')}}', {
                        receiver_id: {{ $user->id }},
                        content: $('#message-text').val(),
                    }).then((res) => {
                        $('#sendMessageModal').modal('hide');
                        this.sendMessageLoader = false;
                        $('#message-text').val('');
                    }).catch((error) => {
                        __profile__.sendMessageLoader = false;
                        alert(error.response.data.errors);
                    });
                }
            }
        });
    </script>

    <script>
        function updateStatus(id) {
            __profile__.updateStatus(id);
        }

        function  openSendMessageModal(){
            $('#sendMessageModal').modal('show');
        }
    </script>
@endsection
