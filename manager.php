<?php
include "includes/manager.inc.php";
include 'includes/dbh.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        table, th, td {
            border: 1px solid black;
        }
    </style>
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
    <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
            height: 100%;
        }
        /* Optional: Makes the sample page fill the window. */
        html, body {
            height: 100%;
            margin: 0;
            padding: 40px;
        }
        #description {
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
        }

        #infowindow-content .title {
            font-weight: bold;
        }

        #infowindow-content {
            display: none;
        }

        #map #infowindow-content {
            display: inline;
        }

        .pac-card {
            margin: 10px 10px 0 0;
            border-radius: 2px 0 0 2px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            outline: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
            background-color: #fff;
            font-family: Roboto;
        }

        #pac-container {
            padding-bottom: 12px;
            margin-right: 12px;
        }

        .pac-controls {
            display: inline-block;
            padding: 5px 11px;
        }

        .pac-controls label {
            font-family: Roboto;
            font-size: 13px;
            font-weight: 300;
        }

        #pac-input {
            background-color: #fff;
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
            margin-left: 12px;
            padding: 0 11px 0 13px;
            text-overflow: ellipsis;
            width: 400px;
        }

        #pac-input:focus {
            border-color: #4d90fe;
        }

        #title {
            color: #fff;
            background-color: #4d90fe;
            font-size: 25px;
            font-weight: 500;
            padding: 6px 12px;
        }
    </style>
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





<br><br><br><br><br><br>





<div align="center"><b align="center" >Update Stock</b>  </div><br>
<table id="menu2" class="table table-bordered"  border="1" border="1"style="width: 700px;" align="center">

    <col width="130">
    <col width="110">
    <col width="110">

    <thead>
    <tr>
        <th scope="col">Product name</th>
        <th scope="col">Stock</th>
        <th scope="col">Quantity</th>

    </tr>
    </thead>
    <tbody>

    <?php while ($row = mysqli_fetch_array($result)): ?>
     <?php
                $coffees = array("frappe", "espresso", "greek coffee", "cappuccino", "filter coffee" );
                if (in_array($row['prod_name'], $coffees))
                    continue;
                ?>
        <tr>
            <td>
                <?php
                    echo $row['prod_name'];
                ?>
            </td>
            <td><?php  $res = mysqli_query($conn, "SELECT qnt  FROM stock WHERE  '".$row['prod_name']."' = prod_name_st AND store_id ='".$store_id[0]."'");
                $resss = mysqli_fetch_row($res);
            echo  $resss[0];?></td>
            <td>
                <input type="number" style="width: 40px;" name="quantity" value="1">
                <button id="<?=$row['prod_name']?>" onclick="AddStock(this)" type="button" class="btn btn-primary btn-x1" name="cart" >Update Stock</button>
            </td>


        </tr>
    <?php  endwhile; ?>

    </tbody>

</table>

<div align="center"><b align="center" >Remaining Orders</b>  </div>

<script src="./vendor/jquery/updateStock.js"></script>

<div align="center" id="mycart"> </div> <br>


<table id="menu" class="table table-bordered" style="width: 700px; " align="center">
    <col width="150">
    <col width="150">

    <thead>
    <tr>
        <th scope="col">Order ID</th>
        <th scope="col">Delivery Guy ID</th>

    </tr>
    </thead>
    <tbody>
    <?php $orders = array(); ?>
    <?php while ($row = mysqli_fetch_array($result2)): ?>
        <tr>
            <td>
                <?php
                echo $row['ID'];
                ?>
            </td>
            <td><?php
                echo  $row['delivery_guy'];
                ?>
            </td>



        </tr>
    <?php  endwhile; ?>

    </tbody>

</table>


<table id="menu3" class="table table-bordered" style="width: 700px; " align="center">
    <col width="150">

<thead>
<tr>
    <th scope="col">Salary For Current Month</th>
</tr>
</thead>
<tbody>
    <tr>
        <td>
            <?php $row = mysqli_fetch_row($result3);
            echo "Earning for current store at this month is: ".$row[0];
            echo "<br>";
            echo "Total manager salary: ".($row[0]*0.02 + 800);
            ?>
        </td>

    </tr>

</tbody>

</table>








<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>






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






































