<?php
include_once __DIR__ . '/init.php';

$error = "";
if (empty($_GET['token']) || empty($_GET['email'])) {
    $error = "Invalid Request";
    goto start_html;
}

$customer = qb_query_parsed('bqxjj8g7e', [3, 6, 7, 8, 15], "{7.EX.'{$_GET['email']}'}");
if (empty($customer)) {
    $error = 'Email Id Not found';
    goto start_html;
}
$customer = $customer[0];

if ($customer['Password'] != $_GET['token']) {
    echo $customer['Password'];
    $error = 'Invalid Token';
    goto start_html;
}


$id = qb_insert('bqxjj8g7e', [3 => $customer['Record ID#'], 16 => 1]);
if (!$id) {
    $error = "Unknown Error";
    goto start_html;
}


start_html:
?>

<!DOCTYPE html>
<html lang="en">
<?php html_head('Email Verification'); ?>
<body>
<?php html_header(); ?>

<div class="content shopping-cart">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <?php if ($error): ?>
                <div class="alert alert-danger">
                    <strong>Danger!</strong> <?= $error ?>
                </div><!-- End .alert-danger -->
            <?php else: ?>
                <div class="alert alert-success">
                    <strong>Success!</strong> Email Verified Successfully
                </div><!-- End .alert-success -->
            <?php endif; ?>
        </div><!-- End .col-md-12 -->
    </div>
</div>

</body>
</html>
