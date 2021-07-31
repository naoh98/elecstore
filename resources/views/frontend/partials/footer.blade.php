<!-- footer -->
<div class="footer">
    <div class="container">
        <div class="w3_footer_grids">
            <div class="col-md-4 w3_footer_grid">
                <h3 class="text-center">Information Contact</h3>
                <ul class="footer_quick_contact">
                    <li><p>{{ getConfigValue('address') }}</p></li>
                    <li><p>{{ getConfigValue('phone_contact') }}</p></li>
                    <li>Email:
                        <ul>
                            <li>{{ getConfigValue('email1') }}</li>
                            <li>{{ getConfigValue('email2') }}</li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="col-md-4 w3_footer_grid">
                <h3 class="text-center">Payment Method</h3>
                <ul class="pmethod">
                    <li><a href="#"><i class="fa fa-cc-visa" style="color: dodgerblue;"></i></a></li>
                    <li><a href="#"><i class="fa fa-credit-card" style="color: rebeccapurple;"></i></a></li>
                    <li><a href="#"><i class="fa fa-cc-paypal" style="color: royalblue;"></i></a></li>
                    <li><a href="#"><i class="fa fa-cc-jcb" style="color: green;"></i></a></li>
                    <li><a href="#"><i class="fa fa-cc-mastercard" style="color: red;"></i></a></li>
                    <li><a href="#"><i class="fa fa-money" style="color: #9c996e;"></i></a></li>
                </ul>
            </div>
            <div class="col-md-4 w3_footer_grid">
                <h3 class="text-center">Follow Us</h3>
                <ul class="followus">
                    <li><a href="#"><i class="fa fa-youtube" style="color: red;"></i></a></li>
                    <li><a href="#"><i class="fa fa-facebook-square" style="color: blue;"></i></a></li>
                    <li><a href="#"><i class="fa fa-google-plus" style="color: salmon; margin-left: 20px;"></i></a></li>
                    <li><a href="#"><i class="fa fa-steam" style="color: black;"></i></a></li>
                </ul>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
    <div class="footer-copy">
        <div class="footer-copy1">
            <div class="footer-copy-pos">
                <a href="#home1" class="scroll"><img src="{{asset('/electronic_store')}}/images/arrow.png" alt=" " class="img-responsive" /></a>
            </div>
        </div>
    </div>
</div>
<!-- end footer -->
<script type="text/javascript">




    $(document).ready(function () {
        $('#horizontalTab').easyResponsiveTabs({
            type: 'default', //Types: default, vertical, accordion
            width: 'auto', //auto or any width like 600px
            fit: true   // 100% fit in a container
        });


    });

    //Dropdown user
    function dropdownUser() {
        $('#myDropdown').toggleClass('show');
    }
    $('.w3l_login__btn').on('click', (e) => {
        e.preventDefault();
        dropdownUser();
    });


    // $(window).click(function (e) {
    //
    //     if (!e.target.matches('#myDropdown')) {
    //         let isopened = $('#myDropdown');
    //         let i;
    //         for (i = 0; i < isopened.length; i++) {
    //             let openDropdown = isopened[i];
    //             if (openDropdown.hasClass('show')){
    //                 openDropdown.removeClass('show');
    //             }
    //         }
    //     }
    // });




    // VALIDATE FORM SIGN UP
    const email = $('#myEmail');
    const password = $('#myPassWord');
    const name = $('#myName');
    const rePassword = $('#myRePassword');
    let messages = [];
    $( "#form_register" ).submit(function( event ) {

        if (email.val() === '' || email.val() == null) {
            $('#error-email').addClass('visible-input').text('Email is required');
            event.preventDefault();

        }
        if (name.val() === '' || name.val() == null) {
            $('#error-name').addClass('visible-input').text('Name is required');
            event.preventDefault();

        }

        if (password.val().length < 8) {
            $('#error-password').addClass('visible-input').text('Password must be greater than 8 characters');
            event.preventDefault();

        }
        if (password.val() !== rePassword.val()) {
            $('#error-repassword').addClass('visible-input').text('Password must match Confirm password');
            event.preventDefault();
        }
    });
    // JS FOR USER PROFILE

    $('#checkpass').on('click', function () {
        if ($(this).is(":checked")) {
            $('.check_password').addClass('show');
        }
        else {
            $('.check_password').removeClass('show');
        }
    });

    const profileEmail = $('#profile_email');
    const profilePassword = $('#profile_password');
    const confirmPassword = $('#confirm_password');
    const errorConfirmPassword =  $('#error-profile-repassword');

    $('#form_profile').submit(function (event) {

        if ( profileEmail.val() === '' && profileEmail.val() == null) {
            $('#error-profile-email').addClass('visible-input').text('Email is required !');
            event.preventDefault();
        }

    });

    $('#profile_password, #confirm_password').on('keyup', function () {
        if (profilePassword.val() !== confirmPassword.val()) {
           errorConfirmPassword.removeClass('invisible-input');
           errorConfirmPassword.addClass('visible-input').text('Password do not match !');

        } else {
            errorConfirmPassword.removeClass('visible-input').text('Password do not match !');
            errorConfirmPassword.addClass('invisible-input');
        }

    });








</script>
