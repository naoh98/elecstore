
//$('#myModal88').modal('show');

//start-smooth-scrolling
    $(".scroll").click(function(event){
        event.preventDefault();
        $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
    });
//
    var auto;
    $('.hs-wrapper').hover(function () {
        var count=0;
        var img = $(this).find('img');
        auto = setInterval(function () {
            for (var i=0;i<img.length;i++){
                $(img[i]).css('display','none');
            }
            count++;
            if(count>img.length){
                count=1;
            }
            $(img[count-1]).css('display','block');
        },700);
    }, function () {
        clearInterval(auto);
    });


    //ADD TO CART AJAX
    function addToCart(event) {
         event.preventDefault();
         let urlCart = $(this).data('url');
         let card_number = $('.cart__number');
         $.ajax({
            type: 'GET',
            url: urlCart,
            dataType: 'json',
            success: function (data) {
                if (data.code === 200) {

                    alert('Product added successfully, check your cart !');
                    $('#home1').html(data.htmlHeader);
                }
            },

            error: function () {

            }

        });
    }

    $(function () {
        $('.add_to_cart').on('click', addToCart);
    })
//
    $(document).ready(function () {
        var count =0;
        var length = $(".slides>li").length;
        var x = setInterval( function () {
            $(".slides>li").eq(count).hide();
            count++;
            if (count>=length){
                count = 0;
            }
            $(".slides>li").eq(count).show();
        },1500);

    });

