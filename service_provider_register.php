<?php
ob_start();
require 'top.php';
require 'service_provider_login_submit.php';
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
                            <span class="breadcrumb-item active">Service provider Register</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->
<section class="htc__contact__area ptb--100 bg__white">
    <div class="container">
        <div class="row">
            <div class="headline">
                <h1>Become A Proud Service Provider</h1>
                <h4>It's simple!</h4>
            </div>
            <div class="col-md-3">
                <div class="contact-form-wrap mt--60">
                    <div class="col-xs-12">
                        <div class="contact-title">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">

                <div class="contact-form-wrap mt---10">

            <div class="col-xs-12">

                <form id="register-form" action="" method="post" enctype="multipart/form-data">
                <?php include 'login_reg_errors.php';?>

                <div class="single-contact-form">
                    <div class="contact-box name">
                        <input class="form-control" type="text" name="name" id="name" placeholder="Your Name*"  value="<?php echo $sp_name; ?>">
                </div>
                    <div class="invalid-feedback">
                    </div>
                </div>
                <div class="single-contact-form">
                    <div class="contact-box name">
                        <input class="form-control" type="email" name="email" id="email" placeholder="Your Email*"  value="<?php echo $sp_email; ?>">
                    </div>
                    <div class="invalid-feedback">
                    </div>
                </div>
                <div class="single-contact-form">
                    <div class="contact-box name">
                        <input class="form-control" type="text" name="mobile" id="mobile" placeholder="Your Mobile*"  value="<?php echo $sp_mobile; ?>">
                    </div>
                    <div class="invalid-feedback">
                    </div>
                </div>
                <div class="single-contact-form">
                    <div class="contact-box name">
                        <input class="form-control" type="password" name="password" id="password" placeholder="Your Password*" value="<?php echo $sp_password; ?>">
                    </div>
                    <div class="invalid-feedback">
                    </div>
                </div>
                <div class="single-contact-form">
                    <div class="contact-box name">
                        <input class="form-control" type="password" name="c_password" id="password" placeholder="Confirm Your Password*" value="<?php echo $sp_c_password; ?>">
                    </div>
                    <div class="invalid-feedback">
                    </div>
                </div>
                <div class="single-contact-form">
                    <div class="contact-box name">
                        <input class="form-control" type="text" name="address" id="address" placeholder="Your Home Address*"  value="<?php echo $sp_address; ?>">
                    </div>
                    <div class="invalid-feedback">
                    </div>
                </div>
                <div class="single-contact-form">
                    <div class="contact-box name">
                        <input class="form-control" type="text" name="experience" id="experience" placeholder="Your Work Experience*"  value="<?php echo $sp_experience; ?>">
                    </div>
                    <div class="invalid-feedback">
                    </div>
                </div>
                <div class="single-contact-form">
                        <label for="categories" class=" form-control-label">Photo of Your NID
                        </label>
                        <input type="file" name="nid" id="nid" class="form-control">
                </div>

                <div class="contact-btn">
                    <button type="submit" name="sp_register" class="fv-btn">Register</button>
                </div>
                <div class="contact-box name">
                    <p>
                        Already became a service provider? <u><a class="not_register" href="service_provider_login.php">Log in</a></u>
                    </p>
                 </div>
            </form>


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