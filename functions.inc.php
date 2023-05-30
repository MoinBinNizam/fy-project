<?php
function pr($arr)
{
    echo '<pre>';
    print_r($arr);
}
function prx($arr)
{
    echo "<pre>";
    print_r($arr);
    die();
}
function get_safe_value($con, $str)
{
    if ($str != '') {
        $str = trim($str);
        $str = stripslashes($str);
        $str = htmlspecialchars($str);
        return mysqli_real_escape_string($con, $str);
    }
}

// function test_input($data) {
//     $data = trim($data);
//     $data = stripslashes($data);
//     $data = htmlspecialchars($data);
//     return $data;
//   }
//optional function
function check_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function get_services($con, $limit = '', $cat_id = '', $service_id = '', $search_str = '')
{
    $sql = "SELECT a.*,b.name AS provider_name,c.categories AS category_name,d.locations AS location_name FROM `services` AS a LEFT JOIN service_provider as b ON a.service_provider_id = b.id LEFT JOIN categories AS c ON a.categories_id = c.id LEFT JOIN locations as d ON a.locations_id = d.id";
    //$sql="select services.*,categories.categories from services,categories where services.status=1 ";
    if ($cat_id != '') {
        $sql .= " WHERE a.categories_id=$cat_id ";
    }
    if ($service_id != '') {
        $sql .= " WHERE a.id=$service_id ";
    }
    if ($search_str != '') {
        $sql .= " WHERE (a.name like '%$search_str%' or a.descpt like '%$search_str%') ";
    }
    $sql .= " AND a.status = 1 order by a.id desc";
    if ($limit != '') {
        $sql .= " limit $limit";

    }
    //echo $sql;
    $res = mysqli_query($con, $sql);
    $data = array();
    while ($row = mysqli_fetch_assoc($res)) {
        $data[] = $row;
    }
    return $data;
}
