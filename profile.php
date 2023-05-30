<?php
require('top.php');
$userId = $_SESSION['USER_ID'];
$name = '';
$email = '';
$mobile = '';


$sql = "select * from users where id ='$userId'";

$res = mysqli_query($con, $sql);
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
                                <span class="breadcrumb-item active">User Profile</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bradcaump area -->
    <!-- wishlist-area start -->
    <div class="wishlist-area ptb--100 bg__white">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="wishlist-content">
                        <div class="order" id="order_btn">
                        <a href="logout.php"><button type="button" class="btn btn-primary">Logout</button></a>

                        </div>
                            <div class="wishlist-table table-responsive">
                            <table>
                                    <thead>
                                    <tr>
                                        <th class="service-name"><span class="nobr"> Name</span></th>
                                        <th class="service-name"><span class="nobr"> Email</span></th>
                                        <th class="service-name"><span class="nobr"> Mobile Number</span></th>
                                     <?php 
                                      while ($row = mysqli_fetch_assoc($res)) {
                                     ?>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                         <td class="service-name"><?php echo $row['name'] ?></td>
                                        <td class="service-name"><?php echo $row['email'] ?></td>
                                        <td class="service-name"><?php echo $row['mobile'] ?></td>
                                      </tr>
                                    <?php }?>
                                    </tbody>
                                </table>
                            </div>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- wishlist-area end -->

    <!-- cart-main-area end -->

<?php
require('footer.php');

?>