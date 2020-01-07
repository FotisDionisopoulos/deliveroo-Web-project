<?php
$file = './includes/test.xml';
file_put_contents($file, "");
// Open the file to get existing content
$current = file_get_contents($file);

$month = $_GET['month'];
$year = $_GET['year'];

echo $year;
$current .= "<xml>\n";
$current .= "\t<header>\n";
$current .= "\t\t<transaction>\n";
$current .= "\t\t\t<period month=\"".$month."\" year=\"".$year."\"/>\n";
$current .= "\t\t</transaction>\n";
$current .= "\t</header>\n";
$current .= "\t<body>\n";
$current .= "\t\t<employees>\n";

$result = mysqli_query($conn, "SELECT * FROM manages");
while ($row = mysqli_fetch_array($result)):

    $current .= "\t\t\t<employee>\n";
    $current .= "\t\t\t\t<firstName>".$row['name']."</firstName>\n";
    $current .= "\t\t\t\t<lastName>".$row['surname']."</lastName>\n";
    $current .= "\t\t\t\t<amka>".$row['AMKA']."</amka>\n";
    $current .= "\t\t\t\t<afm>".$row['afm']."</afm>\n";
    $current .= "\t\t\t\t<iban>".$row['IBAN']."</iban>\n";

    $sql = "SELECT TRUNCATE(SUM(total_price), 2) FROM orders WHERE ".$row['store_id']." = store_id AND MONTH(placed_order) = $month AND YEAR(placed_order) = $year";
    $result2 = mysqli_query($conn, $sql);
    $row2 = mysqli_fetch_row($result2);
    $current .= "\t\t\t\t<ammount>".($row2[0]*0.02 + 800)."</ammount>\n";

    $current .= "\t\t\t</employee>\n";

endwhile;


$result = mysqli_query($conn, "SELECT * FROM delivery");
while ($row = mysqli_fetch_array($result)):

    $current .= "\t\t\t<employee>\n";
    $current .= "\t\t\t\t<firstName>".$row['name']."</firstName>\n";
    $current .= "\t\t\t\t<lastName>".$row['surname']."</lastName>\n";
    $current .= "\t\t\t\t<amka>".$row['AMKA']."</amka>\n";
    $current .= "\t\t\t\t<afm>".$row['afm']."</afm>\n";
    $current .= "\t\t\t\t<iban>".$row['IBAN']."</iban>\n";
    //$current .= "\t\t\t\t<ammount>850.58</ammount>\n";

    $sql = "SELECT SUM(distance) FROM orders WHERE delivery_guy = ".$row['ID']." = ID AND MONTH(placed_order) = $month AND YEAR(placed_order) = $year AND is_delivered = 1";
    $result2 = mysqli_query($conn, $sql);

    $sql = "SELECT SUM(time_to_sec(timediff(end_sh, start_sh)))/3600 FROM shifts WHERE MONTH(start_sh) = $month AND delivery_guy = ".$row['ID'];
    $result3 = mysqli_query($conn, $sql);

    $row2 = mysqli_fetch_row($result2);
    $row3 = mysqli_fetch_row($result3);
    $current .= "\t\t\t\t<ammount>".($row3[0]*5 + $row2[0]*0.10/1000)."</ammount>\n";
    $current .= "\t\t\t</employee>\n";




endwhile;

$current .= "\t\t</employees>\n";
$current .= "\t</body>\n";
$current .= "</xml>\n";

file_put_contents($file, $current);




