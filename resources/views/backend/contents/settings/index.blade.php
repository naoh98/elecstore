@extends("backend.layouts.main")
@section("title","Settings")
@section("content")
    <div class="cf_del_pro">
        <p>Are you sure want to delete this setting ?</p>
    </div>
    <div class="d-sm-flex">
        <h1 class="h3 mb-0 text-gray-800 mb-3" style="text-align: center;width: 100%">Settings</h1>
    </div>
    <div class="container-fluid">
        <div>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Add settings
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{route('settings.create'). '?type=Text'}}">Text</a>
                    <a class="dropdown-item" href="{{route('settings.create'). '?type=Textarea'}}">Textarea</a>
                </div>
            </div>
        </div>
        @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
        <br>
        <table class="table qlproduct">
            <thead class=" thead-dark">
            <tr>
                <th>ID</th>
                <th>Config key</th>
                <th>Config value</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($settings as $setting)
            <tr>
                <td>{{ $setting->id }}</td>
                <td>{{ $setting->config_key }}</td>
                <td>{{ $setting->config_value }}</td>
                <td style="text-align: right;">
                    <a href="{{ route('settings.edit', ['id' => $setting->id]) . '?type=' . $setting->type }}" class="btn btn-warning" style="width: 43px;">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form class="del_pro" action="{{ route('settings.delete', ['id' => $setting->id]) }}" method="post" style="display: inline;">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger" style="width: 43px" type="submit">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <div class="row pages">
            {{ $settings->links() }}
        </div>
    </div>

@endsection
