<?php
require 'top.php';
//pr($_SESSION['cart']);
if (isset($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN'] !== 'yes') {
    header('location:login.php');
    die();
}

ob_end_flush();

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
                                <span class="breadcrumb-item active">Service Booking Cart</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bradcaump area -->
    <!-- cart-main-area start -->
    <div class="cart-main-area ptb--100 bg__white">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <form action="#">
                        <div class="table-content table-responsive">
                            <table>
                                <thead>
                                <tr>
                                    <th class="service-thumbnail">services photo</th>
                                    <th class="service-name">name of services</th>
                                    <th class="service-name">category</th>
                                    <th class="service-name">location</th>
                                    <th class="service-name">service provider</th>
                                    <th class="service-price">Price</th>
                                    <th class="service-subtotal">Total</th>
                                    <th class="service-remove">Remove</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    if (isset($_SESSION['cart'])) {
                                        foreach ($_SESSION['cart'] as $key => $val) {
                                            $serviceArr = get_services($con, '', '', $key);
                                            $name = $serviceArr[0]['name'];
                                            $category_name = $serviceArr[0]['category_name'];
                                            $location_name = $serviceArr[0]['location_name'];
                                            $provider_name = $serviceArr[0]['provider_name'];
                                            $unit_price = $serviceArr[0]['unit_price'];
                                            $total_price = $serviceArr[0]['total_price'];
                                            $img = $serviceArr[0]['img'];
                                            //$qty = $val['qty'];

                                ?>
                                <tr>
                                    <td class="service-thumbnail"><a href="#"><img src="<?php echo SERVICE_IMAGE_SITE_PATH . $img ?>" /></a></td>
                                    <td class="service-name"><a href="#"><?php echo $name ?></a>
                                        <ul  class="pro__prize">
                                            <li class="old__prize"></li>
                                            <li></li>
                                        </ul>
                                    </td>
                                    <td class="service-name"><a href="#"><?php echo $category_name ?></a>
                                        <ul  class="pro__prize">
                                            <li class="old__prize"></li>
                                            <li></li>
                                        </ul>
                                    </td>
                                    <td class="service-name"><a href="#"><?php echo $location_name ?></a>
                                        <ul  class="pro__prize">
                                            <li class="old__prize"></li>
                                            <li></li>
                                        </ul>
                                    </td>
                                    <td class="service-name"><a href="#"><?php echo $provider_name ?></a>
                                        <ul  class="pro__prize">
                                            <li class="old__prize"></li>
                                            <li></li>
                                        </ul>
                                    </td>
                                    <td class="service-price"><span class="amount"><?php echo $total_price ?></span></td>
                                    <!-- <td class="service-quantity"><input type="number" id="<?php // echo $key ?> qty" value="<?php // echo $qty ?>" />
                                        <br/><a href="javascript:void(0)" onclick="manage_cart('<?php //echo $key ?>','update')">Update</a>
                                    </td> -->
                                    <!-- <td class="service-subtotal"><?php //echo  (int)$qty*(int)$total_price ?></td> -->

                                    <td class="service-subtotal"><?php echo $total_price ?></td>
                                    <td class="service-remove"><a href="javascript:void(0)" onclick="manage_booking('<?php echo $key ?>','remove')"><i class="icon-trash icons"></i></a></td>
                                </tr>
                                    <?php
}
}
?>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="buttons-cart--inner">
                                    <div class="buttons-cart">
                                        <a href="<?php echo SITE_PATH ?>">Continue Choosing Services</a>
                                    </div>
                                    <div class="buttons-cart checkout--btn">

                                        <a href="<?php echo SITE_PATH ?>checkout.php">checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- cart-main-area end -->
    <!-- End Banner Area -->
<?php

require 'footer.php';

?>