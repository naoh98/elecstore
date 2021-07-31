
@section('scripts')
    <script>
        // ADD TO CART AJAX

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
                        $('#home1').html(data);
                    }
                },

                error: function () {

                }

            });
        }

        $(function () {
            $('.add_to_cart').on('click', addToCart);
        })
    </script>

@endsection
