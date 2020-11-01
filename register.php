<?php
require_once __DIR__ . "/init.php";

?>

<!DOCTYPE html>
<html lang="en">
<?php html_head('Register'); ?>
<body class="register-account">
<?php html_header(); ?>

<section class="content checkout">
    <div class="content-header breadcrumb-header">
        <div class="wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-left">
                        <h1>REGISTER ACCOUNT</h1>
                    </div>
                    <ul class="breadcrumb pull-right">
                        <li><a href="#">Home&nbsp;</a></li>
                        <li>&nbsp;Register Account</li>
                    </ul>
                </div>
            </div>
        </div>
    </div> <!-- End .content-header -->

    <div class="content-main">
        <div class="wrapper">
            <div class="pt-one-3" >
                <form action="/" method="POST" id="form_register">
                    <div class="register_account_row row">
                        <div class="col-md-6">
                            <div class="personal-details">
                                <h2>YOUR PERSONAL DETAILS</h2>
                                <div class="row pt-xlg mt-sm">
                                    <div class="col-md-12 input-field">
                                        <label for="first_name">ENTER YOUR FIRST NAME*</label>
                                        <input class="form-control" id="first_name" name="first_name" required="required">
                                    </div>
                                    <div class="col-md-12 input-field">
                                        <label for="last_name">ENTER YOUR LAST NAME*</label>
                                        <input class="form-control" id="last_name" name="last_name" required="required">
                                    </div>
                                    <div class="col-md-12 input-field">
                                        <label for="detail_email">ENTER YOUR E-MAIL*</label>
                                        <input class="form-control" id="detail_email" name="email" required="required">
                                    </div>
                                    <div class="col-md-12 input-field">
                                        <label for="detail_telephone">ENTER YOUR TELEPHONE*</label>
                                        <input class="form-control" id="detail_telephone" name="phone" required="required">
                                    </div>
                                </div>
                            </div><!-- End .personal-details -->
                        </div><!-- End .col-md-6 -->
                        <div class="col-md-6">
                            <div class="your-address">
                                <h2>YOUR ADDRESS</h2>
                                <div class="row pt-xlg mt-sm">
                                    <div class="col-md-12 input-field">
                                        <label for="address_1">ENTER YOUR ADDRESS 1*</label>
                                        <input class="form-control" id="address_1" name="address_1" required="required">
                                    </div>
                                    <div class="col-md-12 input-field">
                                        <label for="address_2">ENTER YOUR ADDRESS 2*</label>
                                        <input class="form-control" id="address_2" name="address_2" required>
                                    </div>
                                    <div class="col-md-12 input-field">
                                        <label for="city">ENTER YOUR CITY*</label>
                                        <input class="form-control" id="city" name="city" required="required">
                                    </div>
                                    <div class="col-md-12 input-field">
                                        <label for="post-code">ENTER YOUR POST CODE*</label>
                                        <input class="form-control" id="post-code" name="post-code">
                                    </div>
                                    <div class="col-md-12 input-field">
                                        <label for="country">ENTER YOUR COUNTRY*</label>
                                        <input class="form-control" id="country" name="country" required="required">
                                    </div>
                                    <div class="col-md-12 input-field">
                                        <label for="region">ENTER YOUR REGION/STATE*</label>
                                        <input class="form-control" id="region" name="region" required="required">
                                    </div>
                                </div>
                            </div><!-- End .your-address -->
                        </div><!-- End .col-md-6 -->
                    </div><!-- End .row -->

                    <div class="register_account_row row">
                        <div class="col-md-6">
                            <div class="your-password">
                                <h2>YOUR PASSWORD</h2>
                                <div class="row pt-one-40">
                                    <div class="col-md-12 input-field">
                                        <label for="password">ENTER YOUR PASSWORD*</label>
                                        <input type="password" class="form-control" id="password" name="password" required="required">
                                    </div>
                                    <div class="col-md-12 input-field">
                                        <label for="confirm_password">ENTER YOUR PASSWORD*</label>
                                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required="required">
                                    </div>
                                </div>
                            </div><!-- End .your-password -->
                        </div><!-- End .col-md-6 -->
                        <div class="col-md-6">
                            <div class="your-newsletter ml-one-10">
                                <h2>NEWSLETTER</h2>
                                <div class="row pt-xlg">
                                    <div class="col-md-12 checkbox-field pt-one-14">
                                        <div class="inputbox-type1" >
                                            <input type="checkbox" class="smart_input" name="newsletter"/>
                                            <div class="input-skin">
                                                <i class="visible-checked theme-icon pesto-icon-ok"></i>
                                            </div>
                                        </div>
                                        <label>I wish to subscribe to the Vigo Shop newsletter.</label>
                                    </div>
                                    <div class="col-md-12 checkbox-field mt-one-29">
                                        <div class="inputbox-type1" >
                                            <input type="checkbox" class="smart_input" name="agree-privacy" required/>
                                            <div class="input-skin">
                                                <i class="visible-checked theme-icon pesto-icon-ok"></i>
                                            </div>
                                        </div>
                                        <label>I have reed and agree to the <a class="action-privacy" href="#">Privacy Policy.</a></label>
                                    </div>
                                    <div class="col-md-12 action-field">
                                        <button class="btn-default btn-continue" type="submit">CONTINUE</button>
                                    </div>
                                </div>
                            </div><!-- End .your-newsletter -->
                        </div><!-- End .col-md-6 -->
                    </div><!-- End .row -->
                </form><!-- End Form -->
            </div>
        </div><!-- End .wrapper -->
    </div><!-- End .content-main -->
</section><!-- End .content -->

<?php html_footer(); ?>

<?php html_scripts(); ?>
<?php html_cart();  ?>

<script>
    $('#form_register').on('submit', function (e) {
        e.preventDefault();

        $.post('api/auth.php?action=register', $(this).serialize(), function (res) {
            if (!res['success']) {
                $.alert(res['message']);
                return;
            }

            location.href = 'login.php';
        }, 'json')
    })
</script>

</body>
</html>
