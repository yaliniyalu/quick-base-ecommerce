<?php
require_once __DIR__ . "/functions.php";

function html_head($title, $call = null) { ?>
    <head>
        <!-- Basic -->
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="keywords" content="Ecommerce" />
        <meta name="description" content="Stationary Shopy" />
        <meta name="author" content="author name" />

        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <title><?= $title ?> | Stationary</title>

        <!-- Web Fonts  -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Istok+Web" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Condensed" />

        <!-- Vendor -->
        <link rel="stylesheet" href="assets/vendor/easy-responsive-tabs/css/easy-responsive-tabs.css" />
        <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/css/theme-font/css/pesto.css" />
        <link rel="stylesheet" href="assets/vendor/animate.css" />
        <link rel="stylesheet" href="assets/vendor/owlcarousel/owl.carousel.css" />
        <link rel="stylesheet" href="assets/vendor/owlcarousel/css/animate.css" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

        <?php if ($call) $call(); ?>

        <!-- Theme Stylesheet -->
        <link rel="stylesheet" href="assets/css/theme-elements.css" />
        <link rel="stylesheet" href="assets/css/theme-shop.css" />
        <link rel="stylesheet" href="assets/css/theme.css" />
    </head>
<?php }

function html_navbar() { ?>
    <div class="navbar-left">
        <ul class="nav navbar-nav">
            <li> <a href="account.php" class="hidden-xs"> My account </a> </li>
            <li> <a href="checkout.php" class="hidden-xs"> Checkout </a> </li>
            <li class="hidden-sm hidden-xs"> <a href="wishlist.php"> My wishlist </a> </li>
            <?php if(!auth_is_logged_in()): ?>
                <li> <a href="login.php"> Login <span class="hidden-sm hidden-xs hidden-md">or Register</span></a> </li>
            <?php else: ?>
                <li> <a href="logout.php"> Logout </a> </li>
            <?php endif; ?>
        </ul>
    </div>
    <div class="navbar-right">
        <ul class="nav navbar-nav">
            <li class="dropdown-search ">
                <a class="dropdown-toggle hidden-sm hidden-xs" href="#">
                    Search
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <form class="search-form" action="products.php" method="get">
                            <input placeholder="Search here..." class="form-control" name="q">
                            <input type="submit" hidden>
                            <a href="#" class="menu-close"><i class="demo-icon pesto-icon-cross-mark"></i></a>
                        </form>
                    </li>
                </ul>
            </li>
            <li class="dropdown mini-cart">
                <a href="#" class="dropdown-toggle">
                    My cart<span class="hidden-xs">: $<span class="cart-total">0</span></span>
                </a>
                <ul class="dropdown-menu cart-top">
                    <li class="cart-header">
                        <div class="total-cart">
                            <span><span class="cart-count">0</span> item(s) in your cart- &nbsp;&nbsp;</span><span class="price"><ins>$<span class="cart-total">0</span></ins></span>
                        </div>
                    </li>
                    <li class="cart-footer">
                        <div class="shopping-info pull-left">
                            <div class="shipping"><span class="info-name"> Shipping:</span> <span class="info-value">0</span></div>
                            <div class="tax"><span class="info-name"> Tax:</span> <span class="info-value">Free</span></div>
                            <div class="total-price"><span class="info-name"> Total:</span> <span class="info-value">$<span class="cart-total">0</span></span></div>
                        </div>
                        <div class="buttons pull-right">
                            <a href="cart.php" class="btn btn-default btn-xs font-istok border-normal">VIEW CART</a>
                            <a href="checkout.php" class=" btn btn-default btn-xs font-istok border-normal">CHECKOUT</a>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
<?php }

function html_header_category() { ?>
        <?php
    $categories = qb_query_report_parsed(5, 'bqxk644vg');
    $category_chunk = array_chunk($categories, 6)
    ?>
    <!-- Start table dropdown -->
    <li class="dropdown dropdown-table">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"  role="button">SHOP</a>
        <ul class="dropdown-menu clearfix type1">
            <li>
                <div class="wrapper">
                    <!-- Start dropdown-table-content -->
                    <ul class="dropdown-table-content">
                        <?php foreach ($category_chunk as $chunk): ?>
                        <li class="col-5-1">
                            <ul class="dropdown-table-sub-nav">
                                <?php foreach ($chunk as $category) { ?>
                                    <li> <a href="products.php?c=<?= $category['Record ID#'] ?>"> <?= mb_strtoupper($category['Name']) ?> </a> </li>
                                <?php } ?>
                            </ul>
                        </li><!--End col-5-1 -->
                        <?php endforeach; ?>
                    </ul> <!-- End dropdown-table-content-->
                </div>
            </li>
        </ul> <!-- End dropdown-menu -->
    </li>
<?php }

function html_header_home() { ?>
    <!-- Start Header -->
    <header id="header" class="header-center responsive-type1">
        <div class="header-body">
            <!-- Start header-top-links -->
            <div class="header-top-links">
                <div class="wrapper-fluid">
                    <!-- Start header-table -->
                    <div class="header-table">
                        <!-- Start header-row -->
                        <div class="header-row">
                            <nav class="navbar navbar-static-top">
                                <div class="navbar-collapse">
                                    <?php html_navbar(); ?>
                                </div>
                            </nav>
                        </div><!-- End header-row -->
                    </div><!-- End header-table -->
                </div> <!-- wrapper-fluid -->
            </div> <!-- End header-top-links -->
            <!-- Start Header-main -->
            <div class="header-main">
                <div class="wrapper-fluid">
                    <!-- Start header-table -->
                    <div class="header-table">
                        <div class="header-row logo">
                            <div class="header-column header-column-center">
                                <div class="header-logo">
                                    <a href="index.php"><img src="assets/img/logo.png" alt="SHOP" style="height: 44px;"> </a>
                                </div> <!-- header-logo -->
                            </div> <!-- header-column -->
                        </div> <!-- header-row -->
                        <!-- Start header-row -->
                        <div class="header-row menu">
                            <!-- Start header-column -->
                            <div class="header-column">
                                <button class="header-btn-search" data-toggle="collapse" type="button"
                                        data-target=".dropdown-search .dropdown-menu"  data-object="dropdown-menu">
                                    <i class="demo-icon pesto-icon-search"></i>
                                </button>
                                <button class="header-btn-collapse-nav" data-toggle="collapse" type="button"
                                        data-target="#main-nav"  data-object="main-nav">
                                    <i class="pesto-icon-menu"></i>
                                </button>
                                <!--  Start header-main-nav -->
                                <div class="collapse header-main-nav"  id="main-nav">
                                    <nav class="nav bar navbar-default">
                                        <ul class="nav navbar-nav navbar-center" >
                                            <li class="classic">
                                                <a href="index.php" class="dropdown-toggle" role="button">HOME</a>
                                            </li>
                                            <?php html_header_category(); ?>
                                            <li>
                                                <a href="#" role="button">ABOUT US</a>
                                            </li>
                                            <li>
                                                <a href="contact-us.php" role="button">CONTACT US</a>
                                            </li>
                                        </ul><!--End navbar-nav-->
                                    </nav><!--End navbar-default-->
                                </div><!-- End header-main-nav-->
                                <?php html_header_mobile(); ?>
                            </div> <!-- End header-column -->
                        </div> <!-- End header-row -->
                    </div><!-- End header-table-->
                </div> <!-- End wrapper-fluid -->
            </div><!-- End Header-main -->
        </div> <!-- End header-body -->
    </header>
<?php }

function html_header() { ?>
    <header id="header" class="header-normal responsive-type1">
        <div class="header-body">
            <!-- Start header-top-links -->
            <div class="header-top-links">
                <nav class="navbar navbar-static-top nav-border-bottom">
                    <div class="wrapper">
                        <?php html_navbar(); ?>
                    </div> <!-- .wrapper -->
                </nav>
            </div> <!-- header-top-links -->
            <!-- Start header table collapsed logo and main navigation-->
            <div class="header-main">
                <div class="wrapper">
                    <div class="header-table">
                        <div class="header-row">
                            <div class="header-column logo">
                                <div class="header-logo">
                                    <a href="index.php"><img src="assets/img/logo.png" alt="Shopy"> </a>
                                </div> <!-- header-logo -->
                            </div> <!-- header-column -->
                            <div class="header-column menu">
                                <button class="header-btn-search hidden-xxs" data-toggle="collapse" type="button"
                                        data-target=".dropdown-search .dropdown-menu"  data-object="dropdown-menu">
                                    <i class="demo-icon pesto-icon-search"></i>
                                </button>
                                <button class="header-btn-collapse-nav" data-toggle="collapse" type="button"
                                        data-target="#main-nav"  data-object="main-nav">
                                    <i class="pesto-icon-menu"></i>
                                </button>
                                <div class="collapse header-main-nav"  id="main-nav">
                                    <nav class="navbar navbar-default navbar-right">
                                        <ul class="nav navbar-nav" >
                                            <li class="classic">
                                                <a href="index.php" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"  role="button">HOME</a>
                                            </li>
                                            <?php html_header_category(); ?>
                                            <li>
                                                <a href="#" role="button">ABOUT US</a>
                                            </li>
                                            <li>
                                                <a href="contact-us.php" role="button">CONTACT US</a>
                                            </li>
                                        </ul><!--End navbar-nav-->
                                    </nav><!-- navbar-default-->
                                </div><!-- header-main-nav-->
                                <?php html_header_mobile(); ?>
                            </div> <!-- header-column -->
                        </div> <!-- header-row -->
                    </div> <!-- header-table -->
                </div> <!-- .wrapper -->
            </div>
        </div> <!-- header-body -->
    </header>
<?php }

function html_header_mobile() { ?>
    <!-- Start Header-mobile -->
    <div class="header-mobile hidden-lg hidden-md hidden-sm">
        <ul>
            <li><a href="#" role="button"><i class="demo-icon pesto-icon-cross-mark menu-close"></i></a></li>
            <li><a href="#" role="button">HOME</a></li>
            <li><a href="#" role="button">ABOUT US</a></li>
            <li><input placeholder="SEARCH HERE..."></li>
            <li><a href="#">MY CART: $0.00</a></li>
            <li><a href="#">REGISTER</a></li>
        </ul>
    </div><!-- End Header-mobile -->
<?php }

function html_footer() { ?>
    <?php
    $category = qb_query_report_parsed(5, 'bqxk644vg', 0, 7);
    $top_selling_products = qb_query_report_parsed(11, 'bqxi9mn25', 0, 7);
    ?>
    <!-- Start Footer -->
    <footer id="footer" class="footer-center">
        <!-- Start Footer-main -->
        <div class="footer-main">
            <div class="wrapper">
                <div class="row">
                    <div class="col-md-3 col-sm-3">
                        <h4>CATEGORY</h4>
                        <!-- Start foot-info-->
                        <div class="foot-info">
                            <ul>
                                <?php foreach($category as $item): ?>
                                    <li><a href="products.php?c=<?= $item['Record ID#'] ?>"><?= mb_strtoupper($item['Name']) ?></a></li>
                                <?php endforeach ?>
                            </ul>
                        </div> <!-- End foot-info -->
                    </div><!-- End col-md-3 -->
                    <div class="col-md-3 col-sm-3">
                        <h4>POPULAR PRODUCTS</h4>
                        <!-- Start foot-service-->
                        <div class="foot-service">
                            <ul>
                                <?php foreach($top_selling_products as $item): ?>
                                    <li><a href="product.php?id=<?= $item['Record ID#'] ?>"><?= mb_strtoupper($item['Name']) ?></a></li>
                                <?php endforeach ?>

                            </ul>
                        </div> <!-- End foot-service -->
                    </div><!-- End col-md-3 -->
                    <div class="col-md-3 col-sm-3">
                        <h4>MY ACCOUNT</h4>
                        <!-- Start foot-account-->
                        <div class="foot-account">
                            <ul>
                                <li><a href="account.php">MY ACCOUNT</a></li>
                                <li><a href="cart.php">MY CART</a></li>
                                <li><a href="wishlist.php">MY WISHLIST</a></li>
                                <li><a href="contact-us.php">CONTACT US</a></li>
                                <li><a href="#">ABOUT US</a></li>
                                <li><a href="#">TERMS AND CONDITIONS</a></li>
                                <li><a href="#">PRIVACY POLICY</a></li>
                            </ul>
                        </div> <!-- End foot-account -->
                    </div><!-- End col-md-3 -->
                    <div class="col-md-3 col-sm-3">
                        <div class="support">
                            <h4>SUPPORT</h4>
                            <!-- Start foot-support-->
                            <div class="foot-support">
                                <ul>
                                    <li class="foot-phone">0203 - 980 - 14 - 79</li>
                                    <li class="foot-phone">0203 - 478 - 12 - 96</li>
                                    <li class="foot-service-hours">Service hours: 09:00 - 20.00</li>
                                </ul>
                            </div> <!-- End foot-support -->
                        </div>
                        <!-- Start follow -->
                        <div class="follow">
                            <!-- Start foot-follow-->
                            <div class="footer-follow">
                                <ul class="list-float-left">
                                    <li><a href="#" class="facebook icon-button smaller border-none"><i class="demo-icon pesto-icon-facebook"></i></a></li>
                                    <li><a href="#" class="twitter icon-button smaller border-none"><i class="demo-icon pesto-icon-twitter"></i></a></li>
                                    <li><a href="#" class="pinterest icon-button smaller border-none"><i class="demo-icon pesto-icon-pinterest"></i></a></li>
                                    <li><a href="#" class="instagram icon-button smaller border-none"><i class="demo-icon pesto-icon-instagram"></i></a></li>
                                    <li><a href="#" class="skype icon-button smaller border-none"><i class="demo-icon pesto-icon-skype"></i></a></li>
                                    <li><a href="#" class="envelope icon-button smaller border-none"><i class="demo-icon pesto-icon-email"></i></a></li>
                                </ul>
                            </div> <!-- End foot-follow -->
                        </div><!-- End follow -->
                    </div><!-- End col-md-3 -->

                </div><!-- End row-->
            </div><!-- End .wrapper -->
            <div class="footer-comment hidden-xs">
                <div class="wrapper text-center">
                    <div class="footer-logo">
                        <a href="index.php"><img src="assets/img/logo.png" alt="Stationary Shop"></a>
                    </div>
                    <div>
                        <p>
                            Easy returns. Free shipping on orders over $100. Need help?
                            <br>Help Center.
                        </p>
                    </div>
                </div>
            </div>
            <div class="join clearfix visible-xs-block">
                <div class="wrapper">
                    <!-- Start footer-join -->
                    <div class="footer-join">
                        <h3>
                            JOIN THE COMMUNITY
                        </h3>
                        <!-- Start emailForm -->
                        <form id="emailForm" action="php/email.php" method="POST" novalidate="novalidate">
                            <div class="input-group">
                                <input class="form-control" placeholder="your@email.com" id="yourEmail" name="yourEmail" type="text" aria-required="true" aria-invalid="true">
                                <button class="btn icon-button large" type="submit"><i class="pesto-icon-keyboard"></i></button>
                            </div>
                        </form>
                        <!-- End emailForm -->
                    </div>
                    <!-- End footer-join -->
                    <div class="clearfix visible-xs">
                        <ul>
                            <li><a href="#">About us</a></li>
                            <li><a href="#">Terms &amp; Conditions</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div><!-- End Footer-main-->
        </div><!-- End Footer-main-->
        <!-- Start Footer-mobile -->
    </footer><!-- End Footer-->
<?php }

function html_scripts($call = null) { ?>
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/wow/wow.js"></script>
    <script src="assets/vendor/easy-responsive-tabs/js/easyResponsiveTabs.js"></script>
    <script src="assets/vendor/owlcarousel/owl.carousel.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/vendor/bootstrap-select/bootstrap_select.js"></script>
    <script src="assets/vendor/notifyjs/notify.js"></script>

    <?php if ($call) $call(); ?>

    <script src="assets/js/theme.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

    <script>
        $('button[href]').on('click', function () {
            location.href = $(this).attr('href');
        });

        $.notify.defaults({ className: "success" })
    </script>
<?php }

function html_product($product) { ?>
    <?php
    $product_url = "product.php?id={$product['Record ID#']}"
    ?>
    <div class="product" data-id="<?= $product['Record ID#'] ?>">
        <div class="image">
            <a href="<?= $product_url ?>">
                <img src="files.php?url=<?= $product['Image'] ?>" alt="">
            </a>
            <div class="over-comment middle">
                <div>
                    <span class="rating font-roboto"><i class="theme-icon pesto-icon-star-shape"></i>&nbsp;<?= $product['Average Rating'] ?>/5</span>
                    <?php if($product['Brand'] ?? false): ?>
                        <span class="brand font-istok"><?= mb_strtoupper($product['Brand']) ?></span>
                    <?php endif; ?>
                    <div class="links">
                        <a href="#" class="icon-button small hidden-sm hidden-xs act-wishlist-toggle" data-id="<?= $product['Record ID#'] ?>"><i class="theme-icon pesto-icon-loving ind-wishlist"></i></a>
                        <a href="#" class="btn btn-default btn-md act-cart-add" data-id="<?= $product['Record ID#'] ?>"> ADD TO CART </a>
                        <a href="<?= $product_url ?>" class="icon-button small hidden-sm hidden-xs"><i class="pesto-icon-connector"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="image-content text-left">
            <h4 class="smaller"><?= $product['Name'] ?></h4>
            <span class="price">
                <ins>$<?= $product['Selling Price'] ?></ins>
                <?php if($product['Buying Price'] != $product['Selling Price']): ?>
                    <del>$<?= $product['Buying Price'] ?></del>
                <?php endif; ?>
            </span>
        </div>
        <form class="form-product">
            <input type="hidden" name="Record ID#" value="<?= $product['Record ID#'] ?>">
            <input type="hidden" name="Buying Price" value="<?= $product['Buying Price'] ?>">
            <input type="hidden" name="Selling Price" value="<?= $product['Selling Price'] ?>">
            <input type="hidden" name="Name" value="<?= $product['Name'] ?>">
        </form>
    </div>
<?php }

function html_product_front($product) { ?>
    <?php
    $product_url = "product.php?id={$product['Record ID#']}"
    ?>
    <div class="product wow fadeInUp" data-wow-duration="500ms" data-id="<?= $product['Record ID#'] ?>">
        <div class="image" role="button">
            <a href="<?= $product_url ?>" class="product-redirect"><img src="files.php?url=<?= $product['Image'] ?>" alt=""></a>
            <div class="over-comment middle">
                <div>
                    <div class="links">
                        <a href="#" class="icon-button small hidden-md act-wishlist-toggle" data-id="<?= $product['Record ID#'] ?>"><i class="theme-icon pesto-icon-loving ind-wishlist"></i></a>
                        <a href="#" class="btn btn-default btn-md act-cart-add" data-id="<?= $product['Record ID#'] ?>"> ADD TO CART </a>
                        <a href="<?= $product_url ?>" class="icon-button small hidden-md"><i class="pesto-icon-connector"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="image-comment">
            <h4 class="small name font-istok">
                <?= $product['Name'] ?>
            </h4>
            <div class="brand"><?= mb_strtoupper($product['Brand']) ?></div>
            <div class="price">
                <ins>$<?= $product['Selling Price'] ?></ins>
                <?php if($product['Buying Price'] != $product['Selling Price']): ?>
                    <del>$<?= $product['Buying Price'] ?></del>
                <?php endif; ?>
            </div>
        </div>
        <div class="rating">
            <?php if($product['Average Rating']): ?>
                <span><i class="demo-icon pesto-icon-star-shape"></i> <?= $product['Average Rating'] ?>/5</span>
            <?php endif; ?>
        </div>
        <form class="form-product">
            <input type="hidden" name="Record ID#" value="<?= $product['Record ID#'] ?>">
            <input type="hidden" name="Buying Price" value="<?= $product['Buying Price'] ?>">
            <input type="hidden" name="Selling Price" value="<?= $product['Selling Price'] ?>">
            <input type="hidden" name="Name" value="<?= $product['Name'] ?>">
        </form>
    </div><!-- End .product -->
<?php }

function html_product_list($product) { ?>
    <?php
    $product_url = "product.php?id={$product['Record ID#']}"
    ?>
    <div class="product">
        <div class="image wow fadeInUp" data-wow-duration="500ms" role="button">
            <a href="<?= $product_url ?>">
                <img src="files.php?url=<?= $product['Image'] ?>" alt="image" class="full-width">
            </a>
            <div class="over-comment middle">
                <div>
                    <?php if($product['Average Rating']): ?>
                        <span class="rating font-roboto"><i class="theme-icon pesto-icon-star-shape"></i>&nbsp;<?= $product['Average Rating'] ?>/5</span>
                    <?php endif; ?>
                    <span class="brand font-istok"><?= mb_strtoupper($product['Brand']) ?></span>
                    <div class="links">
                        <a href="#" class="icon-button small act-wishlist-toggle" data-id="<?= $product['Record ID#'] ?>"><i class="theme-icon pesto-icon-loving ind-wishlist"></i></a>
                        <a href="#" class="btn btn-default btn-md act-cart-add" data-id="<?= $product['Record ID#'] ?>"> ADD TO CART </a>
                        <a href="<?= $product_url ?>" class="icon-button small"><i class="pesto-icon-connector"></i></a>
                    </div>
                </div>
            </div>
        </div><!-- End .image -->

        <div class="image-comment">
            <h4><?= $product['Name'] ?></h4>
            <div class="price">
                <ins>$<?= $product['Selling Price'] ?></ins>
                <?php if($product['Buying Price'] != $product['Selling Price']): ?>
                    <del>$<?= $product['Buying Price'] ?></del>
                <?php endif; ?>
            </div>
        </div><!-- End .image-comment -->
    </div><!-- End .product -->
<?php }

function html_cart() { ?>
    <script>
        function renderCartItem(item) {
            return `
             <li class="cart-item">
                <div class="product pull-left" data-id="${ item['Record ID#'] }">
                    <div class="image">
                        <img alt="" src="files.php?url=${ item['Image'] }">
                    </div>
                    <div class="image-comment">
                        <a href="product.php?id=${ item['Record ID#'] }">
                            ${ item['Name'] }
                        </a>
                        <div class="price"><ins>$${ item['Selling Price'] }</ins><del>$${ item['Buying Price'] }</del></div>
                        <div class="price">$${ item['Selling Price'] } x ${ item['Qty'] } = $${ item['Qty'] * item['Selling Price'] }</div>
                    </div>
                </div>
                <div class="pull-product pull-right">
                    <a href="#" class="demo-icon pesto-icon-cross-mark act-cart-remove" data-id="${ item['Record ID#'] }"></a>
                </div>
                <form class="form-product">
                    <input type="hidden" name="Record ID#" value="${ item['Record ID#'] }">
                    <input type="hidden" name="Buying Price" value="${ item['Buying Price'] }">
                    <input type="hidden" name="Selling Price" value="${ item['Selling Price'] }">
                    <input type="hidden" name="Name" value="${ item['Name'] }">
                </form>
             </li> `
        }

        function renderCart(items, clear = false) {
            var total = 0;
            var count = 0;

            $('.cart-top li').not('.cart-header, .cart-footer').remove();
            items.forEach(v => {
                $(renderCartItem(v)).insertAfter('.cart-top .cart-header');
                count ++;
                total += v['Qty'] * v['Selling Price'];
            });

            $('.cart-total').html(total)
            $('.cart-count').html(count)
        }

        function wishlistColor(id, wish = true) {
            var el = $(`[data-id=${id}] .ind-wishlist`);
            el.css('color', wish ? 'red': '');
        }

        $(document).on('click', '.act-cart-add', function (e) {
            e.preventDefault();
            e.stopPropagation();

            let qty = 1;
            let qty_el = $(this).closest('.product').find('[name=qty]');
            if (qty_el.length) {
                qty = qty_el.val();
            }
            
            var id = parseInt($(this).attr('data-id'));
            $.post('api/cart.php?action=cart:add', { id: id, qty: qty }, function (res) {
                if (!res['success']) {
                    $.alert(res['message']);
                    return;
                }

                $('body').trigger('cart:update', [Object.values(res.data)]);
                $.notify("Item added to cart");
            }, 'json');
        });

        $(document).on('click', '.act-cart-remove', function (e) {
            e.preventDefault();
            e.stopPropagation();

            // var id = $(this).closest('.cart-item').find('.form-product [name="Record ID#"]');
            var id = parseInt($(this).attr('data-id'));
            $.post('api/cart.php?action=cart:remove', { id: id }, function (res) {
                if (!res['success']) {
                    $.alert(res['message']);
                    return;
                }

                $('body').trigger('cart:update', [Object.values(res.data)]);
                $.notify("Item removed from cart");
            }, 'json');
        });

        $(document).on('change', '[name="act-quantity"]', function (e) {
            e.preventDefault();

            var id = parseInt($(this).attr('data-id'));
            $.post('api/cart.php?action=cart:change:qty', { id: id, qty: $(this).val() }, function (res) {
                if (!res['success']) {
                    $.alert(res['message']);
                    return;
                }

                $('body').trigger('cart:update', [Object.values(res.data)]);
                $.notify("Item added to cart");
            }, 'json')
        });

        $(document).on('click', '.act-wishlist-toggle', function (e) {
            e.preventDefault();
            e.stopPropagation();

            var id = parseInt($(this).attr('data-id'));
            $.post('api/cart.php?action=wishlist:toggle', { id: id }, function (res) {
                if (!res['success']) {
                    $.alert(res['message']);
                    return;
                }

                wishlistColor(id, res['data']['action'] === 'added')
                $('body').trigger('wishlist:update', [res['data']['action'], id]);
                $.notify(`Item ${res['data']['action']} to wishlist`);
            }, 'json');
        });

        $(document).on('click', '.act-wishlist-remove', function (e) {
            e.preventDefault();
            e.stopPropagation();

            var id = parseInt($(this).attr('data-id'));
            $.post('api/cart.php?action=wishlist:remove', { id: id }, function (res) {
                if (!res['success']) {
                    $.alert(res['message']);
                    return;
                }

                wishlistColor(id, false);
                $('body').trigger('wishlist:update', ['removed', id]);
                $.notify("Item removed from wishlist");
            }, 'json');
        });

        $('body').on('cart:update', function (e, items) {
            renderCart(items);
        });

        $(document).ready(function () {
            $.post('api/cart.php?action=cart:load', function (res) {
                if (!res['success']) {
                    $.alert(res['message']);
                    return;
                }

                const cart = Object.values(res.data)
                renderCart(cart);
                $('body').trigger('cart:update', [cart]);
            }, 'json');

            $.post('api/cart.php?action=wishlist:load:ids', function (res) {
                if (!res['success']) {
                    $.alert(res['message']);
                }

                res.data.forEach(v => {
                    wishlistColor(v);
                });
            }, 'json');
        });
    </script>
<?php }