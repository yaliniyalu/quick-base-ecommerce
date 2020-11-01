<?php
require_once __DIR__ . "/init.php";

if (!auth_is_logged_in()) {
    header('location: login.php?r=' . trim($_SERVER['REQUEST_URI'], '/'));
    exit;
}

if (empty($_SESSION['cart'])) {
    header('location: index.php');
    exit;
}

$user_id = $_SESSION['user_id'];

$contact = qb_query_parsed('bqvgeh94y', [6, 7, 9, 10, 11, 12, 13, 14, 29], "{3.EX.{$_SESSION['user_contact']}}");
if (count($contact)) {
    $contact = $contact[0];
}

$shipping_methods = qb_query_parsed('bqxjsruvy', [3, 6, 7]);

?>

<!DOCTYPE html>
<html lang="en">
<?php html_head('Checkout') ?>

<body class="body-checkout page-type-1">
<style>
    .checkout .content-main .billing-information-group .personal-information {
        margin-bottom: 24px;
    }

    .checkout .content-main .billing-information-group .personal-information label {
        letter-spacing: 0;
    }

    .checkout .content-main .billing-information-group {
        padding-top: 19px;
    }
</style>

<?php html_header(); ?>

<!-- Start Content -->
<section class="content checkout">
    <div class="content-header breadcrumb-header">
        <div class="wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-left">
                        <h1>CHECKOUT</h1>
                    </div>
                    <ul class="breadcrumb pull-right">
                        <li><a href="#">Home&nbsp;</a></li>
                        <li>&nbsp;Checkout</li>
                    </ul>
                </div>
            </div>
        </div>
    </div> <!-- End .content-header -->

    <!-- Start Content-Main -->
    <div class="content-main">
        <div class="wrapper">
            <form class="formCheckout">
                <!-- Start billing-information -->
                <div class="billing-information">
                    <h1>1. BILLING INFORMATION </h1>
                    <div class="register_account_row row" id="#form_personal_details">
                        <div class="col-md-6">
                            <div class="personal-details">
                                <h2>YOUR PERSONAL DETAILS</h2>
                                <div class="billing-information-group">
                                    <div class="personal-information">
                                        <label for="b_first_name">ENTER YOUR FIRST NAME*</label>
                                        <input class="form-control" id="b_first_name" name="b_first_name" required value="<?= $contact['First Name'] ?>">
                                    </div>
                                    <div class="personal-information">
                                        <label for="b_last_name">ENTER YOUR LAST NAME*</label>
                                        <input class="form-control" id="b_last_name" name="b_last_name" required value="<?= $contact['Last Name'] ?>">
                                    </div>
                                    <div class="personal-information">
                                        <label for="b_email">ENTER YOUR E-MAIL*</label>
                                        <input class="form-control" id="b_email" name="b_email" required value="<?= $contact['Email'] ?>">
                                    </div>
                                    <div class="personal-information">
                                        <label for="b_phone">ENTER YOUR TELEPHONE*</label>
                                        <input class="form-control" id="b_phone" name="b_phone" required value="<?= $contact['Phone'] ?>">
                                    </div>
                                </div>
                            </div><!-- End .personal-details -->
                        </div><!-- End .col-md-6 -->
                        <div class="col-md-6">
                            <div class="your-address">
                                <h2>YOUR ADDRESS</h2>
                                <div class="billing-information-group">
                                    <div class="personal-information">
                                        <label for="b_address_1">ENTER YOUR ADDRESS*</label>
                                        <input class="form-control" id="b_address_1" name="b_address_1" required value="<?= $contact['Street 1'] ?>">
                                    </div>
                                    <div class="personal-information">
                                        <label for="b_address_2">ENTER YOUR ADDRESS*</label>
                                        <input class="form-control" id="b_address_2" name="b_address_2" required value="<?= $contact['Street 2'] ?>">
                                    </div>
                                    <div class="personal-information">
                                        <label for="b_city">ENTER YOUR CITY*</label>
                                        <input class="form-control" id="b_city" name="b_city" required value="<?= $contact['City'] ?>">
                                    </div>
                                    <div class="personal-information">
                                        <label for="b_postal_code">ENTER YOUR POST CODE*</label>
                                        <input class="form-control" id="b_postal_code" name="b_postal_code" required value="<?= $contact['Postal Code'] ?>">
                                    </div>
                                    <div class="personal-information">
                                        <label for="b_region">ENTER YOUR REGION/STATE*</label>
                                        <input class="form-control" id="b_region" name="b_region" required value="<?= $contact['State / Region'] ?>">
                                    </div>
                                </div>
                            </div><!-- End .personal-address -->
                        </div><!-- End .col-md-6 -->
                    </div><!-- End .row -->
                </div><!-- End .billing-information -->

                <!-- Start Delivery details -->
                <div class="delivery-details billing-information">
                    <h1>2. DELIVERY DETAILS </h1>
                    <div class="register_account_row row">
                        <div class="col-md-6">
                            <div class="personal-details">
                                <h2>YOUR PERSONAL DETAILS</h2>
                                <div class="billing-information-group">
                                    <div class="personal-information">
                                        <label for="s_first_name">ENTER YOUR FIRST NAME*</label>
                                        <input class="form-control" id="s_first_name" name="s_first_name" required value="<?= $contact['First Name'] ?>">
                                    </div>
                                    <div class="personal-information">
                                        <label for="s_last_name">ENTER YOUR LAST NAME*</label>
                                        <input class="form-control" id="s_last_name" name="s_last_name" required value="<?= $contact['Last Name'] ?>">
                                    </div>
                                    <div class="personal-information">
                                        <label for="s_email">ENTER YOUR E-MAIL*</label>
                                        <input class="form-control" id="s_email" name="s_email" required value="<?= $contact['Email'] ?>">
                                    </div>
                                    <div class="personal-information">
                                        <label for="s_phone">ENTER YOUR TELEPHONE*</label>
                                        <input class="form-control" id="s_phone" name="s_phone" required value="<?= $contact['Phone'] ?>">
                                    </div>
                                </div>
                            </div><!-- End .personal-details -->
                        </div><!-- End .col-md-6 -->
                        <div class="col-md-6">
                            <div class="your-address">
                                <h2>YOUR ADDRESS</h2>
                                <div class="billing-information-group">
                                    <div class="personal-information">
                                        <label for="s_address_1">ENTER YOUR ADDRESS*</label>
                                        <input class="form-control" id="s_address_1" name="s_address_1" required value="<?= $contact['Street 1'] ?>">
                                    </div>
                                    <div class="personal-information">
                                        <label for="s_address_2">ENTER YOUR ADDRESS*</label>
                                        <input class="form-control" id="s_address_2" name="s_address_2" required value="<?= $contact['Street 2'] ?>">
                                    </div>
                                    <div class="personal-information">
                                        <label for="s_city">ENTER YOUR CITY*</label>
                                        <input class="form-control" id="s_city" name="s_city" required value="<?= $contact['City'] ?>">
                                    </div>
                                    <div class="personal-information">
                                        <label for="s_postal_code">ENTER YOUR POST CODE*</label>
                                        <input class="form-control" id="s_postal_code" name="s_postal_code" required value="<?= $contact['Postal Code'] ?>">
                                    </div>
                                    <div class="personal-information">
                                        <label for="s_region">ENTER YOUR REGION/STATE*</label>
                                        <input class="form-control" id="s_region" name="s_region" required value="<?= $contact['State / Region'] ?>">
                                    </div>
                                </div>
                            </div><!-- End .personal-address -->
                        </div><!-- End .col-md-6 -->
                    </div><!-- End .row -->
                </div><!-- End Delivery details -->

                <div class="delivery-method">
                    <h1>3. DELIVERY METHOD</h1>
                    <div class="row">
                        <div class="col-md-6">
                            <?php foreach($shipping_methods as $key => $method): ?>
                                <div class="form-group">
                                    <div class="input-container">
                                        <input class="smart_input" name="delivery_method" type="radio" value="<?= $method['Name'] ?>" <?= $key == 0 ? 'checked' : '' ?>>
                                        <div class="input-skin <?= $key == 0 ? 'checked' : '' ?>">
                                            <i class="visible-unchecked theme-icon pesto-icon-circle-empty"></i>
                                            <i class="visible-checked theme-icon pesto-icon-ok"></i>
                                        </div>
                                    </div>
                                    <label><?= $method['Name'] ?> - $<?= $method['Price'] ?></label>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
                <div class="payment-method">
                    <h1>4. PAYMENT METHOD</h1>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-container">
                                    <input class="smart_input" name="payment_method" type="radio" value="Cash" checked>
                                    <div class="input-skin checked">
                                        <i class="visible-unchecked theme-icon pesto-icon-circle-empty"></i>
                                        <i class="visible-checked theme-icon pesto-icon-ok"></i>
                                    </div>
                                </div>
                                <label>Cash</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="confirm-order">
                    <h1>5. CONFIRM ORDER</h1>
                    <table class="cart-table table-bordered">
                        <colgroup>
                            <col style="width: 41.88%;">
                            <col style="width: 14.53%;">
                            <col style="width: 12.05%;">
                            <col style="width: 13.68%;">
                            <col style="width: 12.05%;">
                        </colgroup>
                        <thead>
                        <tr>
                            <th class="product-name">
                                PRODUCT NAME
                            </th>
                            <th class="product-code">
                                PRODUCT CODE
                            </th>
                            <th class="unit-price">
                                UNIT PRICE
                            </th>
                            <th class="quantity">
                                QUANTITY
                            </th>
                            <th class="subtotal">
                                SUBTOTAL
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $subtotal = 0; ?>
                        <?php foreach($_SESSION['cart'] as $product): ?>
                            <?php $subtotal += ($product['Selling Price'] * $product['Qty']); ?>
                            <tr>
                                <td class="product-name">
                                    <div class="image">
                                        <a href="product.php?id=<?= $product['Record ID#'] ?>"><img src="files.php?url=<?= $product['Image'] ?>" alt="product1"></a>
                                    </div>
                                    <div class="image-comment text-left">
                                        <div class="product-title">
                                            <p><?= $product['Name'] ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="product-code">
                                    <?= $product['SKU'] ?>
                                </td>
                                <td class="unit-price">
                                    <ins>$<?= number_format($product['Selling Price']) ?></ins>
                                </td>
                                <td class="quantity">
                                    <span><?= $product['Qty'] ?></span>
                                </td>
                                <td class="subtotal">
                                    $<?= number_format($product['Selling Price'] * $product['Qty']) ?>
                                </td>
                            </tr>
                        <?php endforeach ?>

                        <tr class="subtotal">
                            <td colspan="4" class="text-left">
                                <div class="price-title pull-right">
                                    SUBTOTAL:
                                </div>
                            </td>
                            <td colspan="2">
                                $<?= number_format($subtotal) ?>
                            </td>
                        </tr>
                        <tr class="shipping">
                            <td colspan="4" class="text-left">
                                <div class="price-title pull-right">
                                    SHIPPING:
                                </div>
                            </td>
                            <td colspan="2">
                                $0.00
                            </td>
                        </tr>
                        <tr class="tax">
                            <td colspan="4" class="text-left">
                                <div class="price-title pull-right">
                                    TAX (0%):
                                </div>
                            </td>
                            <td colspan="2">
                                $0.00
                            </td>
                        </tr>
                        <tr class="total">
                            <td colspan="4" class="text-left">
                                <div class="price-title pull-right">
                                    TOTAL:
                                </div>
                            </td>
                            <td colspan="2">
                                <span class="price">$<?= number_format($subtotal) ?></span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="confirm-action-field pull-right">
                        <button type="submit" class="btn-default btn-confirm-order">CONFIRM ORDER</button>
                    </div>
                </div><!-- End .confirm-order -->
            </form>
        </div><!-- End .wrapper -->
    </div><!-- End .content-main -->
</section><!-- End .content -->

<?php html_footer(); ?>

<?php html_scripts(); ?>
<?php html_cart();  ?>

<script>
    $('.formCheckout').on('submit', function (e) {
        e.preventDefault();

        $.post('api/order.php?action=checkout', $(this).serialize(), function (res) {
            if (!res['success']) {
                $.alert(res['message']);
                return;
            }

            $.notify('Order placed');

            setTimeout(function () {
                location.href = 'index.php';
            }, 2000)
        }, 'json')
    });
</script>

</body>
</html>
