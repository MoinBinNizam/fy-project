<?php
ob_start();
require 'top.php';
require 'login_reg_submit.php';

?>

<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/2.jpg) no-repeat scroll center center / cover ;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner">
                        <nav class="bradcaump-inner">
                            <a class="breadcrumb-item" href="index.php">Home</a>
                            <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                            <span class="breadcrumb-item active">Forgot Password</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->
<section class="htc__contact__area ptb--50 bg__white">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="contact-form-wrap mt--60">
                    <div class="col-xs-12">
                        <div class="contact-title">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="contact-form-wrap mt--10">
                    <div class="col-xs-12">
                        <div class="contact-title">
                            <h2 class="title__line--6">Forgot Password</h2>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <form id="login-form" action="" method="post">
                            <div class="single-contact-form">
                              	<?php include 'login_reg_errors.php';?>
                                <div class="contact-box name">
                                    <input class="form-control in-invalid" type="email" name="email" id="email" placeholder="Your Email*" style="width:100%" value="<?php echo $email; ?>">
                                </div>
                                <span class="field_error" id="email_error" </span>
                            <div class="invalid-feedback">
                            </div>
                            </div>
                            <div class="contact-btn">
                                <button type="button" name="login_user" class="fv-btn" onclick="forgot_password()">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="contact-form-wrap mt--60">
                    <div class="col-xs-12">
                        <div class="contact-title">

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>

<script>
    function forgot_password() {
    var email = jQuery('#email').val();
    if (email == '') {
        jQuery('#email_error').html('Please enter Email'); 
    } else{
        jQuery.ajax({
            url: 'forgot_password_submit.php',
            type: 'post',
            data: 'email=' + email,
            success: function (result) {
                jQuery('#email_error').html(result); 
                
                if (result == 'wrong') {
                    jQuery('.login_msg p').html('Please enter valid login details');
                }
                if (result == 'valid') {
                    window.location.href = window.location.href;

                }
            }
        });
    }
}
</script>

<?php
require 'footer.php';

?>