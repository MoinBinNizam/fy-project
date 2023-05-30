<?php
require ('connection.inc.php');
require ('functions.inc.php');
require ('add_to_booking.php');
    $sid=get_safe_value($con,$_POST['sid']);
    $qty=get_safe_value($con,$_POST['qty']);
    $type=get_safe_value($con,$_POST['type']);

     $obj = new add_to_booking();

     if($type == 'add'){
         $obj->addService($sid,$qty);
     }
    if($type == 'remove'){
        $obj->removeService($sid);
    }
    if($type == 'update'){
        $obj->updateService($sid,$qty);
    }
     echo $obj->totalService();