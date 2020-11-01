<?php
require_once __DIR__ . "/init.php";

if (!isset($_GET['id'])) {
    echo "Bad Request. Product id is required";
    exit;
}

$id = intval($_GET['id']);
$product = qb_query_parsed('bqxi9mn25', [3, 6, 7, 8, 9, 13, 14, 35, 36, 40, 49, 60], "{3.EX.{$id}}");

if (empty($product)) {
    echo "Bad Request. Product not found";
    exit;
}

$product = $product[0];

$related_products = qb_query_parsed('bqxi9mn25', [3, 6, 9, 12, 13, 14, 35, 47, 49], "{35.EX.{$product['Category']}}", null, null, 0, 4);
$reviews = qb_query_parsed('bqxjn8zkw', [1, 7, 8, 9, 10, 17], "{15.EX.{$id}}")
?>

<!DOCTYPE html>
<html lang="en">
<?php html_head($product['Name'], function () { ?>
    <!-- Vendor -->
    <link rel="stylesheet" href="assets/vendor/fancybox/css/jquery.fancybox-buttons.css">
    <link rel="stylesheet" href="assets/vendor/fancybox/css/jquery.fancybox-thumbs.css">
    <link rel="stylesheet" href="assets/vendor/fancybox/css/jquery.fancybox.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.css" />
<?php }); ?>
<body>
<?php html_header(); ?>

<section id="content" class="shop type1">
    <!-- Start Content-Header -->
    <div class="content-header  breadcrumb-header">
        <div class="wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-left">
                        <h2><?= mb_strtoupper($product['Name']) ?></h2>
                    </div>
                    <ul class="breadcrumb pull-right">
                        <li><a href="#">Home</a></li>
                        <li><?= $product['Category - Name'] ?></li>
                        <li><?= $product['Name'] ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div> <!-- End .content-header -->

    <!-- Start Content-Main -->
    <div class="content-main">
        <div class="wrapper">
            <!-- Start products -->
            <div class="products">
                <div class="product clearfix">
                    <!-- Start product-carousel -->
                    <div class="product-carousel" >
                        <div class="product-image">
                            <img src="files.php?url=<?= $product['Image'] ?>" alt="product">
                            <div class="zoom text-center" role="button">
                                <a href="files.php?url=<?= $product['Image'] ?>" class="fancybox">
                                    <span class="pesto-icon-bottomright icon-button smaller"></span>
                                </a>
                            </div>
                        </div>
                    </div><!-- End product-carousel -->
                    <!-- Start product-summary -->
                    <div class="product-summary">
                        <div class="clearfix">
                            <h1 class="pull-left"><?= $product['Name'] ?></h1>
                        </div>
                        <div class="price">
                            <ins>$<?= number_format($product['Selling Price'], 2) ?></ins>
                            <?php if($product['Buying Price'] > $product['Selling Price']): ?>
                                <del>$<?= number_format($product['Buying Price'], 2) ?></del>
                            <?php endif; ?>
                        </div>
                        <div class="product-review">
                            <span><i class="demo-icon pesto-icon-star-shape"></i> <?php if ($product['Average Rating']): ?><?= $product['Average Rating'] ?>/5 </span>&nbsp;&nbsp;| <?php endif; ?><a href="#target_comments" data-toggle="tab">Add your review</a>
                        </div>
                        <div class="availability">Availability: In Stock</div>
                        <div class="product-code">Product Code: <?= $product['SKU'] ?></div>
                        <p class="product-comment">
                            <?= $product['Description'] ?>
                        </p>
                        <form enctype="multipart/form-data" method="post" class="cart">
                            <ul class="list-float-left clearfix">
                                <li><input value="1" class="qty" name="qty" type="text"></li>
                                <li><a href="#" class="btn btn-md act-cart-add" data-id="<?= $id ?>"> ADD TO CART </a></li>
                                <li><a href="#" class="icon-button small act-wishlist-toggle" data-id="<?= $id ?>"> <i class="theme-icon pesto-icon-loving ind-wishlist"></i></a></li>
                            </ul>
                        </form>
                    </div> <!-- End product-summary -->
                </div>
            </div><!-- End products -->
            <div class="tab">
                <div class="row">
                    <div class="col-md-12">
                        <div class="tabs-vertical tabs-left" id="easy_tabs">
                            <ul class="nav resp-tabs-list tab-part">
                                <li>
                                    <a href="#target_description" data-toggle="tab">DESCRIPTION</a>
                                </li>
                                <li>
                                    <a href="#target_comments" data-toggle="tab">COMMENTS</a>
                                </li>
                            </ul>
                            <div class="resp-tabs-container tab-part">
                                <div id="target_description" class="tab-pane">
                                    <div class="explanation">
                                        <?= $product['Long Description'] ?>
                                    </div>
                                </div>
                                <div id="target_comments" class="tab-pane active">
                                    <div class="comments-header clearfix">
                                        <h3 class="pull-left">
                                            <span class="comment-title"><?= count($reviews) ?> REVIEW(S)</span>for "<?= $product['Name'] ?>"
                                        </h3>
                                        <?php if($product['Average Rating']): ?>
                                            <div class="pull-right">
                                                <span class="font-roboto "><i class="demo-icon pesto-icon-star-shape"></i><?= $product['Average Rating'] ?>/5</span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="reviews clearfix">
                                        <?php foreach($reviews as $review): ?>
                                            <!--Start Review -->
                                            <div class="review">
                                                <div class="image-comment">
                                                    <div class="clearfix">
                                                        <div class="pull-left">
                                                            <span class="review-title font-istok"><i><?= $review['Title'] ?></i></span>
                                                        </div>
                                                        <div class="pull-right">
                                                            <span class="font-roboto"><i class="demo-icon pesto-icon-star-shape">&nbsp;</i><?= $review['Rating'] ?>/5</span>
                                                        </div>
                                                    </div>
                                                    <p><?= $review['Review'] ?></p>
                                                    <span><?= $review['Name'] ?>, <?= date('d-m-Y', strtotime($review['Date Created'])) ?></span>
                                                </div>
                                            </div><!-- End review -->
                                        <?php endforeach ?>
                                    </div><!-- End Reviews -->
                                    <!-- Start Customer's review -->
                                    <div class="review-customer">
                                        <h3>WRITE YOUR REVIEW</h3>
                                        <div class="rating">
                                            Your Rating*&nbsp;&nbsp;&nbsp;<div id="rating_stars"></div>
                                        </div>
                                        <form id="reviewForm" novalidate="novalidate" method="POST">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="name" name="name" maxlength="100" placeholder="Enter your name*" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="email" name="email" maxlength="100" placeholder="Enter your email">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="text" class="form-control" id="title" name="title" maxlength="50" placeholder="Title" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <textarea class="form-control" id="ta_review" name="review" maxlength="5000" rows="10" placeholder="Write your review*" aria-invalid="true" aria-required="true" required></textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="hidden" name="item" value="<?= $id ?>">
                                                    <input type="text" name="rating" id="rating" required hidden>
                                                    <input type="submit" class="btn btn-default" value="SUBMIT REVIEW" data-loading-text="Loading...">
                                                </div>
                                            </div>
                                        </form>
                                    </div><!-- End Customer's review -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End .content-main -->

    <?php if(!empty($related_products)): ?>
        <div class="content-footer">
            <div class="wrapper">
                <div class="row text-center">
                    <h2>RELATED PRODUCTS</h2>
                    <?php foreach($related_products as $product): ?>
                        <div class="col-md-3 col-sm-6 col-xs-12 text-center wow fadeIn" data-wow-duration="1000ms">
                            <?php html_product($product); ?>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</section>

<?php html_footer(); ?>

<?php html_scripts(function () { ?>
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/vendor/fancybox/js/jquery.fancybox.js"></script>
    <script src="assets/vendor/fancybox/js/jquery.fancybox-buttons.js"></script>
    <script src="assets/vendor/fancybox/js/jquery.fancybox-thumbs.js"></script>
    <script src="assets/vendor/fancybox/js/jquery.easing-1.3.pack.js"></script>
    <script src="assets/vendor/fancybox/js/jquery.mousewheel-3.0.6.pack.js"></script>

    <script src="assets/vendor/jquery-rating-js/rating.js"></script>
<?php }); ?>

<?php html_cart();  ?>

<script>
    $(function(){
        $("#rating_stars").rating({
            click: function (e) {
                $('#rating').val(e.stars);
            }
        });
    });

    $('#reviewForm').on('submit', function (e) {
        e.preventDefault();

        $.post('api/product.php?action=review', $(this).serialize(), function (res) {
            if (!res['success']) {
                $.alert(res['message']);
                return;
            }
            $('#reviewForm').find('input[type=text], textarea').val("");
            $.notify("Review Posted");
        }, 'json')
    })
</script>

</body>
</html>
