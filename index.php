<?php
require('top.php');

?>
    <br>
  <div class="container">
      <div class="row">
          <div class="col-md-6 right-inner-gap-6">
              <select name="location" id="location" class="form-control">
                  <option value="">Select Location</option>
                  <?php
                  $sql = "select * from locations where status = '1' order by locations asc";
                  $res = mysqli_query($con,$sql);
                   while($row = mysqli_fetch_assoc($res)){
                  ?>
                    <option value="<?=$row["id"]; ?>"><?=$row["locations"]; ?></option>
                  <?php } ?>
              </select>
          </div>
          <div class="col-md-6 left-inner-gap-6">
              <select name="category" id="category" class="form-control">
                  <option value="">Select Category</option>
                  <?php
                  $sql = "select * from categories where status = '1' order by categories asc";
                  $res = mysqli_query($con,$sql);
                  while($row = mysqli_fetch_assoc($res)){?>
                      <option value="<?=$row["id"]; ?>"><?=$row["categories"]; ?></option>
                  <?php } ?>
              </select>
          </div>
      </div>
  </div>
<div class="body__overlay"></div>
        <section class="htc__category__area ptb--100">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="section__title--2 text-center">
                            <h2 class="title__line">New Arrivals Services</h2>
                            <p>Explore new arrival services. Accomplish your demands with highest satisfactoin</p>
                        </div>
                    </div>
                </div>
                <div class="htc__service__container">
                    <div class="row">
                        <div class="service__list clearfix mt--30">
                             <?php
                             $get_services = get_services($con,4);
                            foreach($get_services as $list){
                             ?>
                            <!-- Start Single Category -->
                            <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                                <div class="category">
                                    <div class="ht__cat__thumb">
                                        <a href="services.php?id=<?php echo $list['id'] ?>">
                                            <img src="<?php echo SERVICE_IMAGE_SITE_PATH.$list['img'] ?>" alt="Service images">
                                        </a>
                                    </div>
                                    <div class="fr__service__inner">
                                        <h4><a href="services.php"><?php echo $list['name'] ?></a></h4>
                                        <ul class="fr__pro__prize">
                                            <!-- <li class="old__prize"><?php echo $list['unit_price'] ?></li>
                                            <li><?php echo $list['total_price'] ?></li> -->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Category -->
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Category Area -->
        <!-- Start service Area -->
        <section class="ftr__service__area ptb--100">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="section__title--2 text-center">
                            <h2 class="title__line">High Demand Services</h2>
                            <p>People often takes these services. Get on demand home services by one click instantly. Save your valuable time </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="service__list clearfix mt--30">
                        <?php
                        $get_services = get_services($con,8);
                        foreach($get_services as $list){
                            ?>
                            <!-- Start Single Category -->
                            <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                                <div class="category">
                                    <div class="ht__cat__thumb">
                                        <a href="services.php?id=<?php echo $list['id'] ?>">
                                            <img src="<?php echo SERVICE_IMAGE_SITE_PATH.$list['img'] ?>" alt="Service images">
                                        </a>
                                    </div>
                                    <div class="fr__service__inner">
                                        <h4><a href="services.php"><?php echo $list['name'] ?></a></h4>
                                        <ul class="fr__pro__prize">
                                            <!-- <li class="old__prize"><?php echo $list['unit_price'] ?></li>
                                            <li><?php echo $list['total_price'] ?></li> -->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Category -->
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- End service Area -->
<?php

require('footer.php');

?>