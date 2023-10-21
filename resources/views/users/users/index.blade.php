@extends('users.layout.layout')

@section('breadcrump-header')
    Clients
@endsection

@section('content')
    <div id="lawyersSection" class="row">
        <div class="col-12">
            <div class="card">
                <!-- .left-right-aside-column-->
                <div class="contact-page-aside">
                    <div class="right-aside ">
                        <h4 class="mb-n3"><b>Total: </b>#{{ $users->count() }}</h4>
                        <!-- Add Contact Popup Model -->
                        <div class="table-responsive">
                            <table id="demo-foo-addrow"
                                   class="table no-wrap table-bordered m-t-30 table-hover contact-list"
                                   data-paging="true" data-paging-size="7">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Joining date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>#{{ $user->id }}</td>
                                        <td>
                                            {{ $user->name }}
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone_number }}</td>
                                        <td>{{ $user->created_at->toDateTimeString() }}</td>
                                    </tr>
                                @endforeach

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

@section('scripts')
    <script>
        var __users__ = new Vue({
            el: '#lawyersSection',
            data: {},
            methods: {
                updateStatus(id) {
                    {{--let route = '{{route('admin.updateLawyerStatus', ':id')}}'--}}
                    let route = ''
                    route = route.replace(':id', id);
                    axios.put(route, {
                        status: $('#status-' + id).val(),
                    }).then((res) => {
                        alert('done, updated successfully.');
                    }).catch((error) => {
                        alert(error.response.data.error);
                    });
                }
            }
        });
    </script>

    <script>
        function updateStatus(id) {
            __users__.updateStatus(id);
        }
    </script>
@endsection
