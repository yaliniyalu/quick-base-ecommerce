<?php
require_once __DIR__ . "/init.php";

$category_id = $_GET['c'] ?? null;
$search = $_GET['q'] ?? null;
$query = [];
$category = null;
if ($category_id) {
    $category = qb_query_parsed('bqxk644vg', [3, 6, 12], "{3.EX.{$category_id}} AND {9.EX.'Active'}");

    if (empty($category)) {
        die("Bad Request");
    }

    $category = $category[0];
    $query[] = "{35.EX.{$category_id}}";
}

if ($search) {
    $query[] = "{6.SW.{$search}}";
}

if (!empty($_GET['pf'])) {
    $price_from = $_GET['pf'];
    $query[] = "{14.GTE.{$_GET['pf']}}";
}

if (!empty($_GET['pt'])) {
    $price_to = $_GET['pt'];
    $query[] = "{14.LTE.{$_GET['pt']}}";
}

$resultsCount = intval($_GET['rc'] ?? 15);
$page = $_GET['pg'] ?? 1;

$skip = ($resultsCount * ($page - 1));

$sort = $_GET['srt'] ?? 'top_selling_desc';

$parts = explode('_', $sort);
$last = array_pop($parts);
$parts = [implode('_', $parts), $last];
$sortBy = $parts[0];
$sortDir = $parts[1];


$field_map = ['price' => 14, 'rating' => 49, 'top_selling' => 55, 'name' => 6, 'created' => 1];
$sortBy = [
    [ 'fieldId' => $field_map[$sortBy], 'order' => strtoupper($sortDir) ],
];

$items = qb_query_parsed('bqxi9mn25', [3, 6, 9, 12, 13, 14, 47, 49], implode(' AND ', $query), $sortBy, [], $skip, $resultsCount);

?>

<!DOCTYPE html>
<html lang="en">
<?php html_head('Products'); ?>
<body class="page-type-1 category_page category_no_sidebar">
<?php html_header(); ?>

<!-- Start Content -->
<section class="content" role="main">

    <?php if($category): ?>
        <!-- Start Content-Header -->
        <div class="image-breadcrumb page-top content-header">
            <div class="wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <?php if ($category['Banner']): ?>
                        <img class="full-width" src="files.php?url=<?= $category['Banner'] ?>" alt="picture" />
                        <?php endif; ?>
                        <div class="center-text">
                            <div>
                                <h1 class="m-none"><?= mb_strtoupper($category['Name']) ?></h1>
                            </div>
                            <ul class="breadcrumb">
                                <li><a href="#">Home&nbsp;</a></li>
                                <li>&nbsp;Category Page&nbsp;</li>
                                <li>&nbsp;<?= $category['Name'] ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- End .page-top -->
    <?php endif; ?>

    <?php if($search || !$category): ?>
        <!-- Start Content-Header -->
        <div class="content-header breadcrumb-header">
            <div class="wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <div class="pull-left">
                            <h1><?= $search ? 'Showing Results for "' . $search . '"' : 'PRODUCTS' ?></h1>
                        </div>
                        <ul class="breadcrumb pull-right">
                            <li><a href="#">Home&nbsp;</a></li>
                            <li>&nbsp;Products</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div> <!-- End .content-header -->
    <?php endif; ?>

    <!-- Start Content-Main -->
    <div class="wrapper" style="padding-top: 15px">
        <div class="category-top row pb-sm">
            <div class="pull-left">
                <div class="pull-left">
                    <a class="btn-filter toggle" href=".filter-container" data-toggle="collapse"  id="btn_filter">FILTER +</a>
                </div>
            </div><!-- End .pull-left -->

            <div class="pull-right">
                <div class="select_show inline-block mr-five-10">
                    <select class="bootstrap-select type_show show_count">
                        <option value="15">15</option>
                        <option value="30">30</option>
                        <option value="60">60</option>
                        <option value="100">100</option>
                        <option value="200">200</option>
                    </select>
                </div><!-- End .select_show -->
                <div class="pull-right">
                    <?php html_pagination($page); ?>
                </div>
            </div><!-- End .pull-right -->
        </div><!-- End .category-top -->

        <div class="category-container products pt-md">
            <div class="collapsable collapse filter-option-group filter-container">
                <div class="row">
                    <div class="filter-column col-md-2">
                        <div class="title">
                            <h2>SORT BY</h2>
                        </div><!-- End .title -->
                        <div class="content">
                            <ul>
                                <?php html_sort_option("Price Low to High", 'price_asc'); ?>
                                <?php html_sort_option("Price High to Low", 'price_desc'); ?>
                                <?php html_sort_option("Name Ascending", 'name_asc'); ?>
                                <?php html_sort_option("Name Descending", 'name_desc'); ?>
                            </ul>
                        </div><!-- End .content -->
                    </div><!-- End .filter-column -->
                    <div class="filter-column col-md-2">
                        <div class="title">
                            <h2>SORT BY</h2>
                        </div><!-- End .title -->
                        <div class="content">
                            <ul>
                                <?php html_sort_option("Top Selling", 'top_selling_desc'); ?>
                                <?php html_sort_option("Rating", 'rating_desc'); ?>
                                <?php html_sort_option("Newest First", 'created_desc'); ?>
                                <?php html_sort_option("Oldest First", 'created_asc'); ?>
                            </ul>
                        </div><!-- End .content -->
                    </div><!-- End .filter-column -->
                    <div class="filter-column col-md-2">
                        <div class="title">
                            <h2>PRICE</h2>
                        </div><!-- End .title -->
                        <div class="content">
                            <ul>
                                <?php html_price_range_option(0, 100); ?>
                                <?php html_price_range_option(101, 250); ?>
                                <?php html_price_range_option(251, 500); ?>
                                <?php html_price_range_option(501, 1000); ?>
                            </ul>
                        </div><!-- End .content -->
                    </div><!-- End .filter-column -->
                </div><!-- End .row -->
            </div><!-- End .filter-option-group -->

            <div class="row grid">
                <?php foreach($items as $item): ?>
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 grid-item">
                        <?php html_product_list($item); ?>
                    </div>
                <?php endforeach ?>
            </div><!-- End .row -->
        </div><!-- End .products -->

        <div class="category-bottom clearfix mt-sm">
            <div class="pagination-container">
                <div class="clearfix">
                    <div class="title pull-left">
                        <!--<span>Items 1 to 18 of 120 total</span>-->
                    </div>
                    <div class="pull-right">
                        <?php html_pagination($page); ?>
                    </div>
                </div>
            </div><!-- End .pagination-container -->
        </div><!-- End .category-bottom -->

        <div class="lg-margin hidden-xs hidden-sm"></div><!-- space -->

    </div><!-- End .wrapper -->
</section><!-- End .content -->

<?php html_footer(); ?>

<?php html_scripts(); ?>
<?php html_cart();  ?>

<script>
    function reloadWithParam(p, v) {
        const url = new URL(location.href);
        const params = url.searchParams;
        params.set(p, v);
        if (v === null) {
            params.delete(p);
        }
        url.search = params.toString();
        location.href = url.toString();
    }

    function reloadToggleParam(p, v) {
        const url = new URL(location.href);
        const params = url.searchParams;

        if (params.get(p) === v) {
            params.delete(p);
        }
        else {
            params.set(p, v);
        }

        url.search = params.toString();
        location.href = url.toString();
    }

    $('[data-page]').on('click', function (e) {
        e.preventDefault();

        const page = $(this).attr('data-page');
        reloadWithParam('pg', page);
    });

    $('.show_count').on('change', function (e) {
        e.preventDefault();

        const show = $(this).val();
        reloadWithParam('rc', show);
    });

    $('[name=sort_by]').on('change', function (e) {
        const sort_by = $(this).val();

        reloadToggleParam('srt', sort_by);
    });

    $('[name=price_range]').on('change', function (e) {
        const price_range = $(this).val();
        let p_ranges = price_range.split('-');

        const url = new URL(location.href);
        const params = url.searchParams;
        params.set('pf', p_ranges[0]);
        params.set('pt', p_ranges[1]);
        url.search = params.toString();
        location.href = url.toString();
    });

    $(document).ready(function () {
        $('[data-page="<?= $page ?>"]').closest('li').addClass('active');
        $('.show_count option[value="<?= $resultsCount ?>"]').prop('selected', 'selected');
        $('.input-skin[data-sort="<?= $sort ?>"]').addClass('checked');
        $('.input-skin[data-price-range="<?= ($price_from ?? 0) . '-' . ($price_to ?? 0) ?>"]').addClass('checked');
    })
</script>

</body>
</html>

<?php

function html_pagination($page) { ?>
    <ul class="pagination pagination-normal">
        <li class="prev hidden"><a href="#" role="button" data-page="<?= $page > 1 ? $page - 1 : 1 ?>"><i class="theme-icon pesto-icon-left-open-big"></i></a></li>
        <li><a href="#" role="button" data-page="1">1</a></li>
        <li><a href="#" role="button" data-page="2">2</a></li>
        <li><a href="#" role="button" data-page="3">3</a></li>
        <li><a href="#" role="button" data-page="4">4</a></li>
        <li class="next"><a href="#" role="button" data-page="<?= $page + 1 ?>"><i class="theme-icon pesto-icon-right-open-big"></i></a></li>
    </ul>
<?php }

function html_sort_option($title, $sort) { ?>
    <li>
        <div class="inputbox-container" >
            <input data-filter="*" type="checkbox" name="sort_by" value="<?= $sort ?>" class="smart_input"/>
            <div class="input-skin" data-sort="<?= $sort ?>">
                <i class="visible-checked theme-icon pesto-icon-cross"></i>
            </div>
        </div>
        <label class="inline-block input-text">
            <?= mb_strtoupper($title) ?>
        </label>
    </li>
<?php }

function html_price_range_option($price_from, $price_to) { ?>
        <?php $val = $price_from . '-' . $price_to; ?>
    <li>
        <div class="inputbox-container" >
            <input data-filter="*" type="checkbox" name="price_range" value="<?= $val ?>" class="smart_input"/>
            <div class="input-skin" data-price-range="<?= $val ?>">
                <i class="visible-checked theme-icon pesto-icon-cross"></i>
            </div>
        </div>
        <label class="inline-block input-text">
            $<?= number_format($price_from, 2) ?> - $<?= number_format($price_to, 2) ?>
        </label>
    </li>
<?php }
