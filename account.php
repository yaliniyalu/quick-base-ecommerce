<?php
require_once __DIR__ . "/init.php";

if (!auth_is_logged_in()) {
    header('Location: login.php?r=account.php');
    exit;
}

$customer = qb_query_parsed('bqxjj8g7e', [3, 6, 7, 9, 15, 23, 24, 25], "{3.EX.'{$_SESSION['user_id']}'}");
if (empty($customer)) {
    echo 'User Not found';
    exit;
}

$customer = $customer[0];

$contact = qb_query_parsed('bqvgeh94y', [6, 7, 9, 10, 11, 12, 13, 14, 29], "{3.EX.{$customer['Contact']}}");
if (count($contact)) {
    $contact = $contact[0];
}
?>

<!DOCTYPE html>
<html lang="en">
<?php html_head('Account'); ?>
<body class="body-myaccount page-type-1">
<?php html_header(); ?>

<style>
    .page-type-1 .widget .content {
        min-height: 208px;
    }

    input.form-control {
        border: 1px solid #f3f3f3;
        border-radius: 0;
        height: 45px;
        box-shadow: none;
        width: 100%;
        color: rgb(136, 136, 136);
    }

    label {
        color: #ababab !important;
        font-family: "Istok Web";
        font-size: 12px;
        font-weight: normal;
    }
</style>

<!-- Start Content -->
<section class="content">
    <!-- Start Content-Header -->
    <div class="content-header breadcrumb-header">
        <div class="wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-left">
                        <h1>MY ACCOUNT</h1>
                    </div>
                    <ul class="breadcrumb pull-right">
                        <li><a href="#">Home&nbsp;</a></li>
                        <li>&nbsp;My account</li>
                    </ul>
                </div>
            </div>
        </div>
    </div> <!-- End .content-header -->

    <!-- Start Content-Main -->
    <div class="content-main">
        <div class="wrapper">
            <div class="pt-one-8" >
                <div class="myaccount">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="introduction pt-one-8">
                                <h1 class="introduction">Hello, <?= $customer['Name'] ?>!</h1>
                                <div class="row mt-sm">
                                    <div class="guide-text col-md-12 mt-one-6">
                                        <p>From your My Account Dashboard you have the ability to view a snapshot of your recent account activity and update your account information. Select a link below to view or edit information.</p>
                                    </div>
                                </div>
                            </div><!-- End .introduction -->
                            <div class="account-information mt-one-26">
                                <h2 class="pt-one-8 pb-one-8">ACCOUNT INFORMATION</h2>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="widget mt-xlg">
                                            <div class="header">
                                                <div class="title pull-left">CONTACT INFORMATION</div>
                                                <a class="edit pull-right" data-toggle="modal" data-target="#modal-info">Edit</a>
                                            </div>
                                            <div class="content">
                                                <p><?= $customer['Name'] ?></p>
                                                <p><?= $customer['Email'] ?></p>
                                                <p><?= $customer['Phone'] ?></p>
                                                <div class="mt-one-25">
                                                    <a class="btn btn-thin-border btn-transparent pt-one-10 pr-one-19 pb-one-10 pl-one-20" data-toggle="modal" data-target="#modal-password">CHANGE PASSWORD</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- End .col-md-6 -->
                                    <div class="col-md-6 col-sm-6">
                                        <div class="widget mt-xlg">
                                            <div class="header">
                                                <div class="title pull-left">NEWSLETTER</div>
                                            </div>
                                            <div class="content">
                                                <?php if ($customer['Newsletter Subscription']): ?>
                                                    <p>You are subscribed to newsletter.</p>
                                                <?php else: ?>
                                                    <p>You are currently not subscribed to any newsletter.</p>
                                                <?php endif; ?>
                                                <div class="mt-one-23">
                                                    <?php if ($customer['Newsletter Subscription']): ?>
                                                        <a class="btn btn-thin-border btn-transparent pt-one-10 pr-one-19 pb-one-10 pl-one-20" id="newsletter" data-type="unsubscribe">UN SUBSCRIBE</a>
                                                    <?php else: ?>
                                                        <a class="btn btn-thin-border btn-transparent pt-one-10 pr-one-19 pb-one-10 pl-one-20" id="newsletter" data-type="subscribe">SUBSCRIBE</a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- End .col-md-6 -->
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="widget mt-xlg">
                                            <div class="header">
                                                <div class="title pull-left">ADDRESS BOOK</div>
                                            </div>

                                            <div class="content">
                                                <div class="row mr-minus-two-28">
                                                    <div class="col-md-12 col-sm-12">
                                                        <div class="title">
                                                            DEFAULT ADDRESS
                                                        </div>
                                                        <div class="address-box">
                                                            <p><?= $contact['First Name'] ?> <?= $contact['Last Name'] ?></p>
                                                            <p><?= $contact['Street 1'] ?>,</p>
                                                            <p><?= $contact['Street 2'] ?>,</p>
                                                            <p><?= $contact['City'] ?>,</p>
                                                            <p><?= $contact['State / Region'] ?></p>
                                                            <p><?= $contact['Phone'] ?></p>
                                                        </div>
                                                        <div class="mt-one-23">
                                                            <a class="btn btn-thin-border btn-transparent pt-one-10 pr-one-19 pb-one-10 pl-one-20" data-toggle="modal" data-target="#modal-contact">EDIT ADDRESS</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- End .col-md-12 -->
                                    <div class="col-md-6 col-sm-12">
                                        <div class="widget mt-xlg">
                                            <div class="header">
                                                <div class="title pull-left">MY ORDERS</div>
                                            </div>

                                            <div class="content">
                                                <div class="row mr-minus-two-28">
                                                    <div class="col-md-12 col-sm-12">
                                                        <div class="mt-one-23">
                                                            <a class="btn btn-thin-border btn-transparent pt-one-10 pr-one-19 pb-one-10 pl-one-20" href="orders.php">VIEW ORDERS</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- End .col-md-12 -->
                                </div><!-- End .row -->
                            </div><!-- End .account-information -->
                        </div><!-- End .col-md-9 -->

                        <div class="col-md-3">
                            <div class="widget-sidebar mt-one-12">
                                <div class="header">
											<span class="title">
												MY ACCOUNT
											</span>
                                </div><!-- End .widget-sidebar -->
                                <div class="content">
                                    <div class="element">
                                        <a href="account.php">My Account</a>
                                    </div>
                                    <div class="element">
                                        <a href="orders.php">My Orders</a>
                                    </div>
                                    <div class="element">
                                        <a href="cart.php">My Cart</a>
                                    </div>
                                    <div class="element">
                                        <a href="wishlist.php">My Wishlist</a>
                                    </div>
                                </div><!-- End .content -->
                            </div> <!--widget-sidebar -->
                        </div><!-- .col-md-3 -->
                    </div><!-- End .col-md-6 -->
                </div><!-- End .myaccount-->
            </div><!-- End ACCOUNT INFORMATION -->
        </div><!-- End .wrapper -->
    </div><!-- End .content-main -->
</section><!-- End .ontent -->

<?php html_footer(); ?>

<!-- Modal Info Form-->
<div class="modal fade" id="modal-info" tabindex="-1" role="dialog" aria-labelledby="modelInfoLabel" aria-hidden="true">
    <form id="info-form" method="get" action="#">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="modelInfoLabel">MY INFO</h4>
                </div><!-- End .modal-header -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="if_first_name">FIRST NAME&#42;</label>
                                <input type="text" id="if_first_name" name="first_name" required class="form-control" value="<?= $customer['First Name'] ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="if_last_name">LAST NAME&#42;</label>
                                <input type="text" id="if_last_name" name="last_name" required class="form-control" value="<?= $customer['Last Name'] ?>">
                            </div><!-- End .input-group -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="if_email">EMAIL&#42;</label>
                                <input type="email" id="if_email" name="email" required class="form-control" value="<?= $customer['Email'] ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="if_phone">PHONE&#42;</label>
                                <input type="text" id="if_phone" name="phone" required class="form-control" value="<?= $customer['Phone'] ?>">
                            </div>
                        </div>
                    </div>
                </div><!-- End .modal-body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">CLOSE</button>
                    <button type="submit" class="btn btn-info">UPDATE</button>
                </div><!-- End .modal-footer -->
            </div><!-- End .modal-content -->
        </div><!-- End .modal-dialog -->
    </form>
</div><!-- End .modal -->

<!-- Modal Password Form-->
<div class="modal fade" id="modal-password" tabindex="-1" role="dialog" aria-labelledby="modelPasswordLabel" aria-hidden="true">
    <form id="password-form" method="get" action="#">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="modelPasswordLabel">CHANGE PASSWORD</h4>
                </div><!-- End .modal-header -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pf_old_password">OLD PASSWORD&#42;</label>
                                <input type="password" id="pf_old_password" name="old_password" required class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pf_new_password">NEW PASSWORD&#42;</label>
                                <input type="password" id="pf_new_password" name="password" required class="form-control">
                            </div><!-- End .input-group -->
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pf_confirm_password">RE-ENTER NEW PASSWORD&#42;</label>
                                <input type="password" id="pf_confirm_password" name="confirm_password" required class="form-control">
                            </div>
                        </div>
                    </div>
                </div><!-- End .modal-body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">CLOSE</button>
                    <button type="submit" class="btn btn-info">UPDATE</button>
                </div><!-- End .modal-footer -->
            </div><!-- End .modal-content -->
        </div><!-- End .modal-dialog -->
    </form>
</div><!-- End .modal -->

<!-- Modal Contact Form-->
<div class="modal fade" id="modal-contact" tabindex="-1" role="dialog" aria-labelledby="modelContactLabel" aria-hidden="true">
    <form id="contact-form" method="get" action="#">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="modelContactLabel">DEFAULT CONTACT</h4>
                </div><!-- End .modal-header -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cf_first_name">FIRST NAME&#42;</label>
                                <input type="text" id="cf_first_name" name="first_name" required class="form-control" value="<?= $contact['First Name'] ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cf_last_name">LAST NAME&#42;</label>
                                <input type="text" id="cf_last_name" name="last_name" required class="form-control" value="<?= $contact['Last Name'] ?>">
                            </div><!-- End .input-group -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cf_email">EMAIL&#42;</label>
                                <input type="email" id="cf_email" name="email" required class="form-control" value="<?= $contact['Email'] ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cf_phone">PHONE&#42;</label>
                                <input type="text" id="cf_phone" name="phone" required class="form-control" value="<?= $contact['Phone'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cf_street_1">STREET 1&#42;</label>
                                <input type="text" id="cf_street_1" name="address_1" required class="form-control" value="<?= $contact['Street 1'] ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cf_street_2">STREET 2&#42;</label>
                                <input type="text" id="cf_street_2" name="address_2" required class="form-control" value="<?= $contact['Street 2'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cf_city">CITY&#42;</label>
                                <input type="text" id="cf_city" name="city" required class="form-control" value="<?= $contact['City'] ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cf_region">STATE / REGION&#42;</label>
                                <input type="text" id="cf_region" name="region" required class="form-control" value="<?= $contact['State / Region'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cf_postal_code">POSTAL CODE&#42;</label>
                                <input type="text" id="cf_postal_code" name="postal_code" required class="form-control" value="<?= $contact['Postal Code'] ?>">
                            </div>
                        </div>
                    </div>
                </div><!-- End .modal-body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">CLOSE</button>
                    <button type="submit" class="btn btn-info">UPDATE</button>
                </div><!-- End .modal-footer -->
            </div><!-- End .modal-content -->
        </div><!-- End .modal-dialog -->
    </form>
</div><!-- End .modal -->


<?php html_scripts(); ?>
<?php html_cart();  ?>

<script>
    $('#info-form').on('submit', function (e) {
        e.preventDefault();

        $.post('api/account.php?action=update-info', $(this).serialize(), function (res) {
            if (!res.success) {
                $.alert(res.message);
                return;
            }

            $('#modal-info').modal('hide');
            $.notify('Customer info updated');
            setTimeout(function () {
                location.reload();
            }, 1000);
        }, 'json')
    });

    $('#newsletter').on('click', function (e) {
        e.preventDefault();

        const type = $(this).attr('data-type');
        $.post('api/account.php?action=newsletter', { type: type }, function (res) {
            if (!res.success) {
                $.alert(res.message);
                return;
            }

            $.notify(`Newsletter ${type}d`);
            setTimeout(function () {
                location.reload();
            }, 1000);
        }, 'json')
    });

    $('#contact-form').on('submit', function (e) {
        e.preventDefault();

        $.post('api/account.php?action=update-contact', $(this).serialize(), function (res) {
            if (!res.success) {
                $.alert(res.message);
                return;
            }

            $('#modal-contact').modal('hide');
            $.notify('Contact info updated');
            setTimeout(function () {
                location.reload();
            }, 1000);
        }, 'json')
    });

    $('#password-form').on('submit', function (e) {
        e.preventDefault();

        $.post('api/account.php?action=update-password', $(this).serialize(), function (res) {
            if (!res.success) {
                $.alert(res.message);
                return;
            }

            $('#modal-password').modal('hide');
            $.notify('Password Updated');
        }, 'json')
    });
</script>
</body>
</html>
