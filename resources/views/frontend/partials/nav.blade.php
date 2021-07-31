<!-- navigation -->
<div class="navigation">
    <div class="container">
        <nav class="navbar navbar-default">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header nav_2">
                <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
                <ul class="nav navbar-nav">
                    <li><a href="{{url('/')}}">Home</a></li>
                    <!-- Mega Menu -->
                    <li class="dropdown">
                        <a href="{{url('/shop-category')}}" style="display: inline-block; padding: 20px 8px 20px 30px;">Product</a>
                        <span class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                        </span>
                            <div class="menucat dropdown-menu">
                                <?php showcat($menu); ?>
                            </div>
                    </li>
                    <li><a href="{{ route('news.index') }}">News</a></li>
                    <li><a href="{{ route('about') }}">About</a></li>
                    <li><a href="{{ route('contact') }}">Contact Us</a></li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<!-- end navigation -->

<?php
function showcat(&$categories,$parent_id = 0){
$cat_child = [];
foreach ($categories as $key => $item){
    if($item->parent_id==$parent_id){
        $cat_child[] = $item;
        unset($categories[$key]);
    }
}
if ($cat_child){

echo '<ul>';
foreach ($cat_child as $key => $item){?>
<li class="show">
    <a href="{{url('/shop-category/'.$item->category_id)}}"> {{$item->category_name}}
        <?php showcat($categories,$item->category_id); ?>
    </a>
</li>
<?php }
echo '</ul>';

}
} ?>
