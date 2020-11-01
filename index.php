<?php
require_once __DIR__ . '/init.php';

$carousal = qb_query_parsed("bqxnpzgiv", [6, 7, 8, 9, 11]);

$latest_products = qb_query_report_parsed(9, 'bqxi9mn25', 0, 6);
$popular_products = qb_query_report_parsed(10, 'bqxi9mn25', 0, 6);
$top_selling_products = qb_query_report_parsed(11, 'bqxi9mn25', 0, 6);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="keywords" content="ECom" />
    <meta name="description" content="ECom" />
    <meta name="author" content="author name" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <title>Stationary Shop</title>

    <!-- Web Fonts  -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Istok+Web" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Condensed" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=PT+Sans" />

    <!-- Vendor -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/theme-font/css/pesto.css" />
    <link rel="stylesheet" href="assets/vendor/animate.css" />
    <link rel="stylesheet" href="assets/vendor/owlcarousel/owl.carousel.css" />
    <link rel="stylesheet" href="assets/vendor/owlcarousel/css/animate.css" />
    <link rel="stylesheet" href="assets/vendor/revolution/css/settings.css">
    <link rel="stylesheet" href="assets/vendor/revolution/css/layers.css">
    <link rel="stylesheet" href="assets/vendor/revolution/css/navigation.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

    <!-- Theme Stylesheet -->
    <link rel="stylesheet" href="assets/css/theme-elements.css" />
    <link rel="stylesheet" href="assets/css/theme-shop.css" />
    <link rel="stylesheet" href="assets/css/theme.css" />

    <link rel="stylesheet" href="/css/style.css" />
</head>
<body>

<?php html_header_home(); ?>

<!-- Start Content -->
<section id="content" class="home1">
    <!-- Start Content-Header -->
    <div class="content-header">
        <div class="wrapper-fluid">
            <div id="rev_slider_wrapper1" class="rev-slider-wrapper" style="position: relative">
                <div id="rev_slider1" class="rev-slider fullwidthbanner" data-version="5.0.7">
                    <ul>
                        <?php foreach($carousal as $item): ?>
                            <li data-transition="boxslide">
                                <img src="files.php?url=<?= $item['Image'] ?>" alt="" data-bgposition="center center"
                                     data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg">
                                <div class="tp-caption"
                                     data-x="left"
                                     data-hoffset="['259','116','40']"
                                     data-y="center"
                                     data-start="1000"
                                     data-voffset="-61"
                                     data-fontsize="['27','23','19']"
                                     data-transform_in="y:[100%];s:500;"
                                     data-transform_out="opacity:0;s:500;"
                                     data-whitespace="nowrap"
                                     style="color:#444444;font-weight: normal; z-index: 5;">
                                    <?= $item['Title'] ?>
                                </div>
                                <div class="tp-caption font-istok"
                                     data-x="left"
                                     data-hoffset="['259','116','40']"
                                     data-y="center"
                                     data-voffset="-11"
                                     data-fontsize="['18','17','16']"
                                     data-lineheight="23"
                                     data-transform_idle="o:1;"
                                     data-transform_in="y:[100%];z:0;rZ:-35deg;sX:1;sY:1;skX:0;skY:0;opacity:0;s:500;e:Power4.easeInOut;"
                                     data-transform_out="opacity:0;s:500;"
                                     data-splitin="chars"
                                     data-splitout="none"
                                     data-start="1500"
                                     data-width="370"
                                     data-elementdelay="0.02"
                                     style="color:#666666;letter-spacing: 0;z-index: 6;"><?= $item['Text'] ?>
                                </div>
                                <div class="tp-caption btn btn-default btn-lg border-normal font-istok"
                                     data-x="left"
                                     data-hoffset="['260','117','41']"
                                     data-y="center"
                                     data-voffset="49"
                                     data-whitespace="nowrap"
                                     data-fontsize="['15','14','13']"
                                     data-start="2800"
                                     data-transform_idle="o:1;"
                                     data-transform_in="y:[100%];s:500;"
                                     data-transform_out="opacity:0;s:500;"
                                     style="z-index: 8; line-height: 15px;" onclick="location.href='<?= $item['Category'] ? 'item.php?id=' . $item['Category'] : 'items.php?c=' . $item['Item'] ?>">
                                    TAKE A LOOK
                                </div>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Start Content-Main -->
    <div class="content-main">
        <div class="wrapper">
            <div class="row text-center">
                <h2>LATEST PRODUCTS</h2>
                <?php foreach($latest_products as $product): ?>
                    <div class="col-md-3 col-sm-6 col-xs-12 text-center wow fadeIn" data-wow-duration="1000ms">
                        <?php html_product_front($product); ?>
                    </div>
                <?php endforeach ?>
            </div>
            <div class="row text-center">
                <h2>TOP SELLING PRODUCTS</h2>
                <?php foreach($top_selling_products as $product): ?>
                    <div class="col-md-3 col-sm-6 col-xs-12 text-center wow fadeIn" data-wow-duration="1000ms">
                        <?php html_product_front($product); ?>
                    </div>
                <?php endforeach ?>
            </div>
            <div class="row text-center">
                <h2>POPULAR PRODUCTS</h2>
                <?php foreach($popular_products as $product): ?>
                    <div class="col-md-3 col-sm-6 col-xs-12 text-center wow fadeIn" data-wow-duration="1000ms">
                        <?php html_product_front($product); ?>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div><!-- End .content-main -->
</section><!-- End .content -->

<?php html_footer(); ?>

<?php html_scripts(function () { ?>
    <script src="assets/vendor/isotope/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.js"></script>

    <script src="assets/vendor/revolution/js/jquery.themepunch.tools.min.js?rev=5.0"></script>
    <script src="assets/vendor/revolution/js/jquery.themepunch.revolution.min.js?rev=5.0"></script>
    <script src="assets/vendor/revolution/js/extensions/revolution.extension.actions.min.js"></script>
    <script src="assets/vendor/revolution/js/extensions/revolution.extension.carousel.min.js"></script>
    <script src="assets/vendor/revolution/js/extensions/revolution.extension.kenburn.min.js"></script>
    <script src="assets/vendor/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
    <script src="assets/vendor/revolution/js/extensions/revolution.extension.migration.min.js"></script>
    <script src="assets/vendor/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
    <script src="assets/vendor/revolution/js/extensions/revolution.extension.parallax.min.js"></script>
    <script src="assets/vendor/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
    <script src="assets/vendor/revolution/js/extensions/revolution.extension.video.min.js"></script>
<?php }); ?>

<?php html_cart(); ?>

<script>
    var revapi26;
    $(document).ready(function() {
        //setTimeout(setHeightOfAdvertisements(),300);
        if($("#rev_slider1").revolution == undefined){
            revslider_showDoubleJqueryError("#rev_slider1");
        }else{
            revapi26 = $("#rev_slider1").show().revolution({
                sliderType:"standard",
                jsFileLocation:"vendor/revolution/js/",
                sliderLayout:"auto",
                dottedOverlay:"none",
                delay:9000,
                navigation: {
                    keyboardNavigation:"off",
                    keyboard_direction: "horizontal",
                    mouseScrollNavigation:"off",
                    onHoverStop:"on",
                    touch:{
                        touchenabled:"on",
                        swipe_threshold: 75,
                        swipe_min_touches: 1,
                        swipe_direction: "horizontal",
                        drag_block_vertical: false
                    }
                    ,
                    arrows: {
                        style: "rev_pesto",
                        enable: true,
                        hide_onmobile: true,
                        hide_under: 600,
                        hide_onleave: true,
                        hide_delay: 200,
                        hide_delay_mobile: 1200,
                        left:{
                            h_align:"left",
                            v_align:"center",
                            h_offset:30,
                            v_offset:0
                        },
                        right:{
                            h_align:"right",
                            v_align:"center",
                            h_offset:30,
                            v_offset:0
                        }
                    }
                    ,
                    thumbnails: {
                        style: 'rev_pesto',
                        enable: true,
                        width: 20,
                        height: 20,
                        min_width: 14,
                        wrapper_padding: 0,
                        wrapper_color: 'transparent',
                        wrapper_opacity: '1',
                        tmp: '<span class="tp-thumb-icon-circle"><i class="theme-icon pesto-icon-circle"></i></span>',
                        visibleAmount: 5,
                        hide_onmobile: true,
                        hide_under: 800,
                        hide_onleave: true,
                        direction: 'horizontal',
                        span: false,
                        position: 'inner',
                        space: 5,
                        h_align: 'center',
                        v_align: 'bottom',
                        h_offset: 0,
                        v_offset: 20
                    }
                },
                responsiveLevels:[1920,992,768],
                gridwidth: [1840,754,280],
                gridheight: [850,348,280],
                parallax: {
                    type:"mouse+scroll",
                    origo:"slidercenter",
                    speed:2000,
                    levels:[1,2,3,20,25,30,35,40,45,50],
                    disable_onmobile:"on"
                },
                spinner:"spinner3",
                stopLoop:"on",
                stopAfterLoops:0,
                stopAtSlide:1,
                shuffle:"off",
                autoHeight:"on",
                minHeight:"280",
                disableProgressBar:"on",
                hideThumbsOnMobile:"on",
                hideSliderAtLimit:0,
                hideCaptionAtLimit:0,
                hideAllCaptionAtLilmit:0,
                debugMode:false,
                fallbacks: {
                    simplifyAll:"off",
                    nextSlideOnWindowFocus:"off",
                    disableFocusListener:false,
                }
            });
        }
    }); /*ready*/
</script>
</body>
</html>
