<?php
require_once __DIR__ . "/init.php";

$orders = qb_query_report_parsed(1, 'bqxjmg5c7')
?>

<!DOCTYPE html>
<html lang="en">
<?php html_head('Cart'); ?>
<body>
<?php html_header(); ?>

<div class="content shopping-cart">
    <!-- Start Content-Header -->
    <div class="content-header  breadcrumb-header">
        <div class="wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-left">
                        <h2>MY ORDERS</h2>
                    </div>
                    <ul class="breadcrumb pull-right">
                        <li><a href="#">Home&nbsp;</a></li>
                        <li>Orders&nbsp;</li>
                    </ul>
                </div>
            </div>
        </div>
    </div> <!-- End .content-header -->

    <!-- Start Content-Main -->
    <div class="content-main">
        <div class="wrapper">
            <div class="row">
                <div class="col-md-12">
                    <!-- Start Cart-table -->
                    <table class="cart-table table-bordered">
                        <thead>
                        <tr>
                            <th class="product-code">ORDER NO</th>
                            <th class="product-name">PRODUCT NAME</th>
                            <th class="unit-price">UNIT PRICE</th>
                            <th class="quantity">QUANTITY</th>
                            <th class="subtotal">SUBTOTAL</th>
                            <th class="subtotal">STATUS</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($orders as $order) { ?>
                            <tr>
                                <td class="product-code"><?= $order['Order No'] ?></td>
                                <td class="product-name"><?= $order['Item - Name'] ?></td>
                                <td class="unit-price"><?= $order['Price'] ?></td>
                                <td class="quantity"><?= $order['Qty'] ?></td>
                                <td class="subtotal"><?= $order['Total'] ?></td>
                                <td class="subtotal"><?= $order['Status'] ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table><!-- End Cart-table -->
                </div>
            </div>
        </div>
    </div>
</div>

<?php html_footer(); ?>

<?php html_scripts(); ?>
<?php html_cart();  ?>

<script>

</script>
</body>
</html>
