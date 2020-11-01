<?php
require_once __DIR__ . "/init.php";
?>

<!DOCTYPE html>
<html lang="en">
<?php html_head('Login'); ?>
<body class="body-login">
<?php html_header(); ?>

<!-- Start Content -->
<section class="content checkout">
    <!-- Start Content-Header -->
    <div class="content-header breadcrumb-header">
        <div class="wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-left">
                        <h1>LOGIN</h1>
                    </div>
                    <ul class="breadcrumb pull-right">
                        <li><a href="#">Home&nbsp;</a></li>
                        <li>&nbsp;Login</li>
                    </ul>
                </div>
            </div>
        </div>
    </div> <!-- End .content-header -->

    <!-- Start Content-Main -->
    <div class="content-main">
        <div class="wrapper">
            <div class="pt-one-41" >
                <form action="/" method="POST" id="form_login">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div>
                                <h1>NEW CUSTOMERS</h1>
                                <div class="pt-xlg mt-sm">
                                    <div class="guide-text">
                                        By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="right-field">
                                <h1>REGISTERED CUSTOMERS</h1>
                                <div class="row pt-xlg mt-sm">
                                    <div class="col-md-12 mb-one-20">
                                        <p class="m-none">If you have an account with us, please log in.</p>
                                    </div>
                                    <div class="col-md-12 input-field">
                                        <label for="email">ENTER YOUR E-MAIL*</label>
                                        <input type="text" class="form-control" id="email" name="email" required="required">
                                    </div>
                                    <div class="col-md-12 input-field">
                                        <label for="password">ENTER YOUR PASSWORD*</label>
                                        <input type="password" class="form-control" id="password" name="password" required="required">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="row mt-one-7">
                                <div class="col-md-12 action-field">
                                    <button type="button" class="btn-default btn-create-an-account" href="register.php">CREATE AN ACCOUNT</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="right-field">
                                <div class="row mt-xs">
                                    <div class="col-md-12 action-field">
                                        <button type="submit" class="btn-default btn-login">LOGIN</button>
                                        <a class="pull-right" href="#">Forgot Your Password?</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div><!-- End .billing-information -->
        </div><!-- End .wrapper -->
    </div><!-- End .content-main -->
</section><!-- End .content -->

<?php html_footer(); ?>

<?php html_scripts(); ?>
<?php html_cart();  ?>

<script>
    $('#form_login').on('submit', function (e) {
        e.preventDefault();

        $.post('api/auth.php?action=login', $(this).serialize(), function (res) {
            if (!res['success']) {
                $.alert(res['message']);
                return;
            }

            location.href = "<?= $_GET['r'] ?? 'index.php' ?>";
        }, 'json')
    })
</script>

</body>
</html>
