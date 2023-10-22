@extends('admin.index')

@section('breadcrump-header')
    Users
@endsection

@section('content')
    <div id="usersSection" class="row">
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
                                    <th>Actions</th>
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
                                        <td>
                                            <button type="button" :disabled="loading" class="btn btn-danger" onclick="deleteUser('{{ $user->id }}')">
                                                Delete
                                            </button>
                                        </td>
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
            el: '#usersSection',
            data: {
                loading: false,
            },
            methods: {
                deleteUser(id, event) {
                    let route = '{{route('admin.deleteUser', ':id')}}'
                    route = route.replace(':id', id);
                    axios.delete(route).then((res) => {
                        event.target.closest('tr').remove()
                        alert('done, deleted successfully.');
                    }).catch((error) => {
                        alert(error.response.data.error);
                    });
                }
            }
        });

        function deleteUser(id) {
            if(confirm('Are you sure ? ')) {
                __users__.deleteUser(id, event);
            }
        }
    </script>
@endsection
