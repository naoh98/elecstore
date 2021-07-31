@extends('backend.layouts.main')
@section('title','Attributes management')
@section('content')
    <div class="cf_del_att">
        <p>This attribute will be permanently removed from the whole system</p>
    </div>
    <div class="container-fluid">
        <div>
            <a href="{{url("/admin/attribute/create")}}" class="btn btn-success">Add New Attribute</a>
        </div>
        @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                {{session('error')}}
            </div>
        @endif
        <br>
        <table class="table">
            <thead class=" thead-dark">
            <tr>
                <th>Attribute</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($att as $value){ ?>
            <tr>
                <td>{{$value->attribute_name}}</td>
                <td style="text-align: right;">
                    <a href="{{url("/admin/attribute/edit/$value->attribute_id")}}" class="btn btn-warning">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form class="del_att" action="{{url("/admin/attribute/delete/$value->attribute_id")}}" method="post" style="display: inline;">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger" type="submit">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            <?php }
            ?>
            </tbody>
        </table>
        <div class="row pages">{{$att->links()}}</div>
    </div>
@endsection