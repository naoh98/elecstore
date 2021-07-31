@extends("backend.layouts.main")
@section("title","Admin List")
@section("content")
    <div class="container-fluid">
        <table class="table">
            <thead class=" thead-dark">
            <tr>
                <th>ID</th>
                <th>Admin Name</th>
                <th>Email</th>
            </tr>
            </thead>
            <tbody>
                @foreach($list as $admin)
                    <tr>
                        <td>{{$admin->id}}</td>
                        <td>{{$admin->name}}</td>
                        <td>{{$admin->email}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection