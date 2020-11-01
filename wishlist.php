<?php
require_once __DIR__ . "/init.php";

$popular_products = qb_query_report_parsed(10, 'bqxi9mn25', 0, 4);
?>

<!DOCTYPE html>
<html lang="en">
<?php html_head('Wish List'); ?>
<body>
<?php html_header(); ?>

<div class="content shopping-cart">
    <!-- Start Content-Header -->
    <div class="content-header  breadcrumb-header">
        <div class="wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-left">
                        <h2>WISHLIST</h2>
                    </div>
                    <ul class="breadcrumb pull-right">
                        <li><a href="#">Home&nbsp;</a></li>
                        <li>Wishlist&nbsp;</li>
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
                    <table class="cart-table wishlist-table table-bordered">
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
                            <th class="move">
                                MOVE TO CART
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
                <div class="col-md-12 text-center">
                    <div class="btn-continue">
                        <button class="btn btn-default font-roboto" href="index.php">CONTINUE SHOPPING</button>
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
    function renderWishlistRow(item) {
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
            <td class="add delete">
                <a href="#" role="button" class="act-wishlist-move" data-id="${id}"><i class="demo-icon pesto-icon-checkmark"></i></a>
            </td>
            <td class="delete">
                <a href="#" role="button" class="act-wishlist-remove" data-id="${id}"><i class="demo-icon pesto-icon-cross-mark"></i></a>
            </td>
        </tr>`;
    }

    function renderWishlistTable(wishlist) {
        const el_body = $('.wishlist-table tbody');
        el_body.empty();

        wishlist.forEach(item => {
            el_body.append(renderWishlistRow(item));
        });
    }

    $.post('api/cart.php?action=wishlist:load', function (res) {
        if (!res['success']) {
            $.alert(res['message']);
        }

        renderWishlistTable(Object.values(res.data));
    }, 'json');

    $(document).on('click', '.act-wishlist-move', function (e) {
        e.preventDefault();

        var id = parseInt($(this).attr('data-id'));
        $.post('api/cart.php?action=wishlist:move', { id: id }, function (res) {
            if (!res['success']) {
                $.alert(res['message']);
            }

            $(`.wishlist-table tbody [data-id=${id}]`).remove();

            $('body').trigger('cart:update', [Object.values(res.data['cart'])])
        }, 'json');
    });

    $('body').on('wishlist:update', function (e, action, id) {
        if (action === 'added') {

        }
        else {
            $(`.wishlist-table tbody [data-id=${id}]`).remove();
        }
    });
</script>
</body>
</html>
