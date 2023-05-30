<?php
ob_start();
require('top.php');
require 'service_provider_login_submit.php';


// if (isset($_SESSION['SERVICE_PROVIDER_LOGIN']) && $_SESSION['SERVICE_PROVIDER_LOGIN']=='yes'){
//     header('location:service_provider/manage_service.php');
//     die();
// }
// service_provider_login();

//?>
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
                                <span class="breadcrumb-item active">Service provider Login</span>
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
                            <h2 class="title__line--6">Login</h2>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <form id="login-form" action="" method="post">
                            <div class="single-contact-form">
                              	<?php include 'login_reg_errors.php';?>
                                <div class="contact-box name">
                                    <input class="form-control in-invalid" type="email" name="email" id="login_email" placeholder="Your Email*" style="width:100%" value="<?php echo $sp_email; ?>">
                                </div>
                                <span class="field_error" id="login_email_error" </span>
                            <div class="invalid-feedback">
                               
                            </div>
                            </div>
                            <div class="single-contact-form">
                                <div class="contact-box name">
                                    <input class="form-control" type="password" name="password" id="login_password" placeholder="Your Password*" style="width:100%">
                                </div>
                                <span class="field_error" id="login_password_error"></span>
                            </div>
                            <div class="contact-btn">
                                <button type="submit" name="sp_login" class="fv-btn">Login</button>
                               
                            </div>
                            <div class="contact-box name">
                            <p>
                                Not yet a member? <u><a class="not_register" href="service_provider_register.php">Register</a></u>
                            </p>
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
<?php
require 'footer.php';

?>