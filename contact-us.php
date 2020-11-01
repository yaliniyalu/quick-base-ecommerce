<?php
require_once __DIR__ . "/init.php";
?>

<!DOCTYPE html>
<html lang="en">
<?php html_head('Contact us'); ?>
<body>

<link rel="stylesheet" href="assets/css/theme-contactus.css" />

<?php html_header(); ?>

<!-- Start Content -->
<section id="content" class="contactus type3">
        <!-- Start Content-Header -->
        <div class="content-header  breadcrumb-header">
            <div class="wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <div class="pull-left">
                            <h2>CONTACT US</h2>
                        </div>
                        <ul class="breadcrumb pull-right">
                            <li><a href="#">Home&nbsp;</a></li>
                            <li>&nbsp;Contact us</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div> <!-- End .content-header -->

        <!-- Start Content-Main -->
        <div class="content-main">
            <div class="wrapper">
                <div class="row review-customer">
                    <div class="col-md-12">
                        <h3>WRITE YOUR REVIEW</h3>
                        <div class="alert alert-success hidden" id="contactSuccess">
                            <strong>
                                Success!
                            </strong>
                            Your message has been sent to us.
                        </div>
                        <div class="alert alert-danger hidden" id="contactDanger">
                            <strong>
                                Danger!
                            </strong>
                            <span class="error_message">Error on sending your message. Please try again.</span>
                        </div>
                        <form id="contactForm" method="POST" novalidate="novalidate">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name"> Enter your name</label>
                                    <input type="text" id="name" class="form-control" name="name" maxlength="100" aria-required="true" aria-invalid="false">
                                    <label for="email"> Enter your email</label>
                                    <input type="text" id="email" class="form-control" name="email" maxlength="100" aria-required="true" aria-invalid="false">
                                    <label for="subject"> Enter your subject</label>
                                    <input type="text" id="subject" class="form-control" name="subject" maxlength="100" aria-required="true" aria-invalid="false">
                                </div>
                                <div class="col-md-6">
                                    <label for="message"> Enter your message</label>
                                    <textarea rows="10" id="message" class="form-control pb-sm" name="message" maxlength="5000" aria-required="true" aria-invalid="false"></textarea>
                                    <input type="submit" name="review" value="POST COMMENT" class="btn btn-default" data-loading-text="Loading...">
                                </div>
                            </div>
                        </form> <!-- End Form -->
                    </div><!-- End .col-md-12 -->
                </div><!-- End .row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="map-container">
                            <div id="google_map" class="bottom-map type1"></div>
                        </div>
                    </div>
                </div><!-- End .row -->
            </div><!-- End .wrapper -->
        </div><!-- End .content-main -->

        <!-- Start Content-Footer -->
        <div class="content-footer">
            <div class="wrapper">
                <div class="row">
                    <div class="col-md-4 text-center location fadeInUp wow" data-wow-duration="500ms">
                        <a href="#"><i class="demo-icon pesto-icon-gps"></i></a>
                        <h4>OUR LOCATION</h4>
                        <div>Fake Street 48/188 , Fake City 02587, </div>
                        <div >Fake Country, 24-157</div>
                    </div>
                    <div class="col-md-4 text-center details fadeInUp wow" data-wow-duration="700ms">
                        <a href="#"><i class="demo-icon pesto-icon-email"></i></a>
                        <h4>CONTACT DETAILS</h4>
                        <div>Email: fake_email@gmail.com </div>
                    </div>
                    <div class="col-md-4 text-center phone fadeInUp wow" data-wow-duration="900ms">
                        <a href="#"><i class="demo-icon pesto-icon-telephone"></i></a>
                        <h4>CONTACT US</h4>
                        <div>Phone: 0203 - 980 - 14 - 79</div>
                        <div>Mobile: 0203 - 478 - 12 - 96 </div>
                    </div>
                </div><!-- End .row -->
            </div><!-- End .wrapper -->
        </div><!-- End .content-footer -->
    </section><!-- End .content -->

<?php html_footer(); ?>

<?php html_scripts(); ?>
<?php html_cart();  ?>

<script src="assets/vendor/jquery.gmap/jquery.gmap.min.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

<script>
    $('#contactForm').on('submit', function (e) {
        e.preventDefault();

        const el_c_danger = $('#contactDanger');
        const el_c_success = $('#contactSuccess');

        $.post('api/contact.php?action=contact', $(this).serialize(), function (res) {
            if (!res['success']) {
                el_c_danger.removeClass('hidden');
                el_c_danger.find('.error_message').text(res.message);
                el_c_success.addClass('hidden')
                return;
            }

            el_c_danger.addClass('hidden')
            el_c_success.removeClass('hidden')

            $('#contactForm').trigger('reset')
        }, 'json')
    })
</script>
</body>
</html>
