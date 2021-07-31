@extends("backend.layouts.main")
@section("title","Customer management")
@section("content")
    <div class="d-sm-flex">
        <h1 class="h3 mb-0 text-gray-800 mb-3" style="text-align: center;width: 100%">Customer</h1>
    </div>
    <div class="container-fluid">
        <table class="table qlproduct">
            <thead class=" thead-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
            </thead>
            <tbody>

            @foreach($customers as $customer)
                <tr>
                    <td>{{$customer->id}}</td>
                    <td>{{$customer->name}}</td>
                    <td>{{$customer->email}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="row pages">
{{--            {{ $customers->links() }}--}}
        </div>
    </div>

@endsection
