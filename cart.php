<?php
require_once __DIR__ . "/init.php";

$popular_products = qb_query_report_parsed(10, 'bqxi9mn25', 0, 4);
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
                        <h2>SHOPPING CART</h2>
                    </div>
                    <ul class="breadcrumb pull-right">
                        <li><a href="#">Home&nbsp;</a></li>
                        <li>Shopping cart&nbsp;</li>
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
                            <th class="product-name">
                                PRODUCT <span class="hidden-xs">NAME</span>
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
                            <th class="delete">
                                <a href="#" role="button"><i class="demo-icon pesto-icon-cross-mark"></i></a>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table><!-- End Cart-table -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-sm-12"></div>
                <div class="col-md-4 col-sm-12">
                    <table class="table-bordered total-table">
                        <tbody>
                        <tr>
                            <td class="total-table-title">Subtotal:</td>
                            <td class="cart-subtotal">$0.00</td>
                        </tr>
                        <tr>
                            <td class="total-table-title">Shipping:</td>
                            <td>$0.00</td>
                        </tr>
                        <tr>
                            <td class="total-table-title">TAX (0%):</td>
                            <td>$0.00</td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td>TOTAL:</td>
                            <td class="cart-total">$0.00</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="btn-continue">
                        <button class="btn btn-default font-roboto" href="index.php">CONTINUE SHOPPING</button>
                    </div>
                    <div class="btn-checkout">
                        <button class="btn btn-default font-roboto" href="checkout.php">CHECKOUT</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Start Content-Footer -->
    <div class="content-footer">
        <div class="wrapper">
            <div class="row text-center">
                <h2>POPULAR PRODUCTS</h2>
                <?php foreach($popular_products as $product): ?>
                    <div class="col-md-3 col-sm-6 col-xs-12 text-center">
                        <?php html_product($product); ?>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>

<?php html_footer(); ?>

<?php html_scripts(); ?>
<?php html_cart();  ?>

<script>
    function renderCartRow(item) {
        const id = item['Record ID#'];
        return `
        <tr class="product" data-id="${id}">
            <td class="product-name">
                <div class="image">
                    <a href="product.php?id=${id}" role="button">
                        <img src="files.php?url=${ item['Image'] }" alt="${ item['Name'] }">
                    </a>
                </div>
                <div class="image-comment  ">
                    <a href="#"><h2 class="small font-istok">${ item['Name'] }</h2></a>
                </div>
            </td>
            <td class="product-code">
                ${ item['SKU'] }
            </td>
            <td class="unit-price">
                <ins>$${ item['Selling Price'].toFixed(2) }</ins>
            </td>
            <td class="quantity">
                <input class="form_control" name="act-quantity" aria-required="true" type="text" value="${ item['Qty'] }" data-id="${id}">
            </td>
            <td class="subtotal">
                $${ (item['Selling Price'] * item['Qty']).toFixed(2) }
            </td>
            <td class="delete">
                <a href="#" role="button" class="act-cart-remove" data-id="${id}"><i class="demo-icon pesto-icon-cross-mark"></i></a>
            </td>
        </tr>`;
    }

    function renderCartTable(cart) {
        const el_body = $('.cart-table tbody');
        el_body.empty();

        let subtotal = 0;
        cart.forEach(item => {
            el_body.append(renderCartRow(item));
            subtotal += (item['Qty'] * item['Selling Price']);
        });

        $('.cart-subtotal, .cart-total').html(subtotal.toFixed(2))
    }

    $('body').on('cart:update', function (e, items) {
        renderCartTable(items);
    });
</script>
</body>
</html>
