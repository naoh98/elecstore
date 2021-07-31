@extends("backend.layouts.main")
@section("title","Category management")
@section("content")
    <div class="cf_del_cat">
        <p>This category will be permanently removed from the whole system</p>
    </div>
    <div class="container-fluid">
        <div>
            <a href="{{url("/admin/product_category/create")}}" class="btn btn-success">Add New Category</a>
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
                <th>Category</th>
                <th>Category ID</th>
                <th>Parent ID</th>
                <th>Level</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php viewmenu($category); ?>
            </tbody>
        </table>
    </div>
    <?php
    function viewmenu(&$categories,$parent_id=0,$level=0,$char=''){
    foreach ($categories as $key => $manage){
    if ($manage->parent_id==$parent_id){
        $a = $level+1;

    ?>
    <tr>
        <td>
            <?php echo $char.$manage->category_name; ?>
        </td>
        <td>
            <?php echo $manage->category_id; ?>
        </td>
        <td>
            <?php echo $manage->parent_id; ?>
        </td>
        <td>
            <?php echo $a; ?>
        </td>
        <td style="text-align: right;">
            <a href="{{url("/admin/product_category/edit/$manage->category_id")}}" class="btn btn-warning" >
                <i class="fas fa-edit"></i>
            </a>
            <form class="del_cat" action="{{url("/admin/product_category/delete/$manage->category_id")}}" method="post" style="display: inline;">
                @method('delete')
                @csrf
                <button class="btn btn-danger" type="submit">
                    <i class="fa fa-trash"></i>
                </button>
            </form>
        </td>
    </tr>
    <?php
    unset($categories[$key]);
    viewmenu($categories,$manage->category_id,$a,$char.$manage->category_name.' > ');
    }
    }
    }
    ?>
@endsection
