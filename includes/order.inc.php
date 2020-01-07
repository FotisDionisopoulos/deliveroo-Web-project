<?php
if(!isset($_SESSION))
{
    session_start();
}
include 'dbh.php';
if(empty($_SERVER['HTTP_X_REQUESTED_WITH']) || !strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    exit;
}
$_SESSION["variables"]=$_POST["out"];

$coffees = array("frappe", "espresso", "cappuccino", "filter coffee", "greek coffee" );

// start sql transaction
$query = "SELECT ID, lat, lng FROM stores";
$sql_res = mysqli_query($conn, $query);
$stores = array();
$katastimata = '';
while ($store_inf = mysqli_fetch_assoc( $sql_res)) {
    $stores[] = array(
        "lat" => $store_inf['lat'],
        "lng" => $store_inf['lng']
    );

    $katastimata .= $store_inf['lat'].','.$store_inf['lng'].'|';

}
echo "ddd";

$katastimata = substr($katastimata, 0, -1);
$pelatis =  $_POST['location']['lat'].','.$_POST['location']['lng'];

    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=$pelatis&destinations=$katastimata&key=AIzaSyCIA_hzAcghVGcuNn3p0Fy6w9nQL56zuEc";
$matrix = json_decode(file_get_contents($url), true);
echo ($url);

$i = 0;
foreach ($matrix['rows'][0]["elements"] as $element )
{
    if ( $element["status"] == 'OK') {
        $dist["$i"] = $element["distance"]["value"];

    }
    else $dist["$i"] = INF;
    $i += 1;

}
asort($dist);


//var_dump($dist);
foreach ($dist as $id_kat=> $dist_kat_pel)
{
    $flag = true;
    $id_kat = (int)$id_kat +1;
    $query = "SELECT lat, lng, name FROM stores WHERE ID = '$id_kat'";
    $sql_res = mysqli_query($conn, $query);
    $store_inf = mysqli_fetch_row( $sql_res);
    //echo ' '.$row[0].' '.$row[1];
    foreach($_POST['items'] as $proion => $zitisi) {

        //echo $proion . ' ' . $zitisi . ' ';
        if (!in_array($proion, $coffees)) {
            $qnt_guery = "SELECT qnt FROM stock WHERE prod_name_st = '$proion' AND store_id = '$id_kat'";
            $sql_res2 = mysqli_query($conn, $qnt_guery);
            $stock = mysqli_fetch_row($sql_res2);

            //echo ' Katastima:' . $store_inf[2] . ' proion ' . $proion . ' apothema ' . $stock[0] . ' zhthsh: ' . $zitisi;

            if ($stock[0] < $zitisi) {
               // echo ' paparia elegxos gia to allo katasthma';
                $flag = false;
                break;
            }


        } else {
            $epil_kat = $store_inf[0].','.$store_inf[1];
            continue;
        }
    }

    if ($flag == true) {
        echo ' epilexthike to katasthma ths ' . $store_inf[2];
        $epil_kat = $store_inf[0] . ',' . $store_inf[1];
        $kmdel = $dist[$id_kat - 1];
        break;
    }

}

$total_price = 0;
foreach($_POST['items'] as $proion => $zitisi) {
    $sql = mysqli_query($conn,"SELECT price FROM menu  WHERE prod_name = '$proion'");
    $sql_row = mysqli_fetch_row($sql);
    $total_price += $zitisi* $sql_row[0];

    if(!in_array($proion, $coffees)) {
        $sql = "UPDATE stock SET qnt=qnt -'$zitisi'  WHERE store_id = '$id_kat' AND prod_name_st = '$proion';";
        $sql_ins = mysqli_query($conn, $sql);



    }

}
//Epilogh Delivera
$query = "SELECT lat, lng FROM delivery";

$sql_res = mysqli_query($conn, $query);
$delivery_guys = array();
$dest_del = '';
while ($store_inf = mysqli_fetch_assoc( $sql_res)) {
    $delivery_guys[] = array(
        "lat" => $store_inf['lat'],
        "lng" => $store_inf['lng']
    );

    $dest_del .= $store_inf['lat'].','.$store_inf['lng'].'|';

}

$dest_del = substr($dest_del, 0, -1);

ini_set('max_execution_time', 300);

$url2 = "https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=$epil_kat&destinations=$dest_del&key=AIzaSyCIA_hzAcghVGcuNn3p0Fy6w9nQL56zuEc";
echo '222';
$matrix = json_decode(file_get_contents($url2), true);

$i = 0;
foreach ($matrix['rows'][0]["elements"] as $element )
{echo '11';

    if ( $element["status"] == 'OK') {
        $dist["$i"] = $element["distance"]["value"];
    }
    else $dist["$i"] = INF;
        $i += 1;

}

asort($dist);
var_dump( $dist);
//DELIVERADES sto dist
foreach ($dist as $id_del=> $dist_del_kat) {
    $flag = true;
    $id_del = (int)$id_del + 1;
    $query = "SELECT is_avail, ID FROM delivery WHERE ID = '$id_del'";
    $sql_res = mysqli_query($conn, $query);
    $del_inf = mysqli_fetch_row($sql_res);


    if ($del_inf[0] == 1) {
    echo ' epilogh delivera me id: ' . $del_inf[1];
    $kmdel += $dist[$id_del - 1];
    echo $kmdel;
    break;
    }
}

//apostash gia ton delivera
//insert order details
$lat = $_POST['location']['lat'];
$lng = $_POST['location']['lng'];

$sql = "INSERT INTO orders(store_id, lat, lng, delivery_guy, placed_order, total_price, distance) VALUES( '$id_kat', '$lat','$lng', '$id_del', now(), '$total_price', '$kmdel')";
$sql_ins = mysqli_query($conn, $sql);


echo '   done  ';
