<?php
include 'includes/dbh.php';
include 'includes/user.inc.php';
include 'includes/delivery_init.inc.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script type="application/javascript" src="./vendor/jquery/deliver_order.js"></script>
    <script type="application/javascript" src="./vendor/jquery/shifts.js"></script>
    <script type="application/javascript" src="./vendor/jquery/endShift.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Deliveroo</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link rel="icon"  href="img/burger.png">
    <!-- Plugin CSS -->
    <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="css/freelancer.min.css" rel="stylesheet">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">

</head>

<body id="page-top">

<!-- Navigation -->
<nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">Deliveroo <br> <p class="lead mb-0">

                <?=$name?>


            </p></a>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">


                <li class="nav-item mx-0 mx-lg-1">
                    <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="includes/logout.inc.php">Log Out</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<br><br><br><br><br><br><br><br>
<?php if($is_avail[0]) : ?>
    <div style="text-align: center;" >You are currently available for delivery!</div> <br>
<?php else : ?>
    <div style="text-align: center;">You are not available for delivery!</div> <br>
<?php endif; ?>
<button type="button" style="margin:auto;display:block" class="btn btn-primary btn-x1" onclick="executeQuery()">
<?php
    if($is_avail[0] == 0) :
        echo "Press to become available";
    else :
        echo "Press to become unavailable";

    endif;
?>
</button>

<br>

<?php if($is_avail[0]) : ?>
    <table id="menu" class="table table-bordered" style="width: 700px; " align="center">
        <col width="130">
        <col width="110">
        <col width="110">
        <col width="110">
        <col width="110">

        <thead>
        <tr>
            <th scope="col">Order ID</th>
            <th scope="col">lat</th>
            <th scope="col">lng</th>
            <th scope="col">Date and time</th>
            <th scope="col">Deliver</th>
        </tr>
        </thead>
        <tbody>

        <?php while ($row = mysqli_fetch_array($result)): ?>
            <?php  $order = $row['ID'];
            if ($row['is_delivered'] == 1)
                continue;
            ?>
            <tr>
                <td id="rowID"><?php echo $row['ID'];?></td>
                <td><?php echo $row['lat'];?></td>
                <td><?php echo $row['lng'];?></td>
                <td><?php echo $row['placed_order'];?></td>
                <td>
                    <button id="<?=$row['prod_name']?>" onclick="deliver('<?php echo $order ?>')" type="button" class="btn btn-primary btn-x1" name="cart" >Just Delivered!</button>
                </td>

            </tr>
        <?php  endwhile; ?>

        </tbody>

    </table>
<?php endif; ?>



<br><br>

<table id="menu2" class="table table-bordered" style="width: 700px; " align="center">
    <col width="150">

    <thead>
    <tr>
        <th scope="col">Salary For Current Day</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>
            <?php $row = mysqli_fetch_row($result2);
            $row2 = mysqli_fetch_row($result3);
            echo "Total kilometers for current day: ".$row[0]/1000;
            echo "<br>";
            echo "Total delivery guy salary for today: ".($row2[0]*5 + $row[0]*0.10/1000);
            ?>
        </td>

    </tr>

    </tbody>

</table>



<br>

<div style="text-align: center;" id="container">
<button type="button" style="display: inline-block;" class="btn btn-primary btn-x1" onclick="setShift()"> Start Shift</button>
<button type="button" style="display: inline-block;" class="btn btn-primary btn-x1" onclick="endShift()"> End Shift</button>
</div>

<br><br>
<script>
function executeQuery() {

$.ajax({
    url: "./includes/delivery.inc.php",
    type: "post",
    data: {},
    success: function (resp) {
        // you will get response from your php page (what you echo or print)
        //alert(resp);
        location.reload();
    },
    error: function(jqXHR, textStatus, errorThrown) {
        console.log(textStatus, errorThrown);
    }


});

}



</script>




<!-- Footer -->
<footer class="footer text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-5 mb-lg-0">
                <h4 class="text-uppercase mb-4">Location</h4>
                <p class="lead mb-0">Korinthou 1
                    <br>Patras, Greece 26223</p>
            </div>

            <div class="col-md-4 mb-5 mb-lg-0"></div>

            <div class="col-md-4">
                <h4 class="text-uppercase mb-4">Contact us</h4>
                <p class="lead mb-0">
                    Tel:	261012345
                    <br> Email:	Deliveroo@info.com
            </div>
        </div>
    </div>
</footer>

<div class="copyright py-4 text-center text-white">
    <div class="container">
        <small>Copyright &copy; CEID 2017</small>
    </div>
</div>

<!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
<div class="scroll-to-top d-lg-none position-fixed ">
    <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top">
        <i class="fa fa-chevron-up"></i>
    </a>
</div>


<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Plugin JavaScript -->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

<!-- Contact Form JavaScript -->
<script src="js/jqBootstrapValidation.js"></script>

<!-- Custom scripts for this template -->
<script src="js/freelancer.min.js"></script>

</body>

</html>



