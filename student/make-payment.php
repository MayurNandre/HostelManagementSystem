<?php
session_start();
include('../includes/dbconn.php');
include('../includes/check-login.php');
check_Student_login();
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>Hostel Management System</title>
    <!-- Custom CSS -->
    <link href="../assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="../assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <!-- <link href="../dist/css/style.min.css" rel="stylesheet"> --><!-- Minified CSS -->
    <link href="../dist/css/style.css" rel="stylesheet"><!-- Plain CSS -->
    <link href="../dist/css/mycustom.css" rel="stylesheet"><!-- For Improvement CSS -->

</head>

<body>
    <!-- -------------Preloader------------- -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- -------------Preloader End------------- -->

    <!-- Main wrapper -  (pages.scss )-->
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">

        <!-- Topbar header -  (pages.scss )-->
        <header class="topbar" data-navbarbg="skin6">
            <?php include '../includes/student-navigation.php' ?>
        </header>
        <!-- End Topbar header -->

        <!-- Left Sidebar -  (sidebar.scss)  -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <?php include '../includes/student-sidebar.php' ?>
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- End Left Sidebar -    (sidebar.scss)  -->

        <!-- Accessing student detail -->
        <?php
        $aid = $_SESSION['login'];
        $ret = "SELECT * from registration where emailid=?";
        $stmt = $mysqli->prepare($ret);
        $stmt->bind_param('s', $aid);
        $stmt->execute();
        $res = $stmt->get_result();
        $cnt = 1;
        $row = $res->fetch_object();
        ?>
        <!-- Accessing student detail end-->


        <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Container fluid  -->
            <div class="container-fluid">
                <div class="col-12 align-self-center">
                    <h2 class="page-title text-truncate text-dark font-weight-medium text-center ">Hostel Fee Payment</h2>
                </div>
<?php

if($row)
{
?>
                <div class="container my-4">
                    <!-- ---------------------Payment detail table--------------------- -->
                    <table class=" text-monospace mb-4">
                        <tr>
                            <th colspan="2" class="text-center text-danger ">Payment Detail</th>
                        </tr>

                        <tr>
                            <td>Student Name</td>
                            <td class="font-weight-bold"><?php echo $student_name = $row->firstName . " " . $row->lastName; ?></td>
                        </tr>

                        <tr>
                            <td>Staying From</td>
                            <td class="font-weight-bold"><?php echo $row->stayfrom; ?></td>
                        </tr>

                        <tr>
                            <td>Duration(In months)</td>
                            <td class="font-weight-bold"> <?php echo $dr = $row->duration; ?> Months</td>
                        </tr>

                        <tr>
                            <td>Meal(Required/Not Required)</td>
                            <td class="font-weight-bold"><?php $status = $row->foodstatus;
                                                            if ($status == 1) {
                                                                echo "Required";
                                                            } else {
                                                                echo "Not Required";
                                                            } ?>
                            </td>
                        </tr>

                        <tr>
                            <td>Fee Status(Paid/Not Paid)</td>
                            <td class="">
                                <?php
                                $status = $row->fee_status;
                                if ($status == 0) {
                                    echo "<a class='text-danger font-weight-bold'>NOT PAID</a>";
                                } else {
                                    echo "<a class='text-success font-weight-bold'>PAID</a>";
                                } ?>
                            </td>
                        </tr>

                        <tr>
                            <td>Hostel Room Fee</td>
                            <td class="font-weight-bold"><?php
                                                            $fpm = $row->feespm;
                                                            echo "₹" . $fpm * $dr;
                                                            ?>
                            </td>
                        </tr>

                        <tr>
                            <td>Meal Fee</td>
                            <td class="font-weight-bold"><?php
                                                            if ($row->foodstatus == 1) {
                                                                $fd = 3000;
                                                                echo '₹' . $fd;
                                                            } else {
                                                                echo '₹' . "0";
                                                            }   ?></td>
                        </tr>

                        <tr>
                            <td>Total Fees To pay</td>
                            <td class="font-weight-bold text-danger"><?php
                                                                        $fpm = $row->feespm;
                                                                        if ($row->foodstatus == 1) {
                                                                            $fd = 3000;
                                                                            echo '₹' . (($fd + $fpm) * $dr);
                                                                        } else {
                                                                            echo '₹' . $dr * $fpm;
                                                                        }   ?></td>
                        </tr>
                    </table>
                    <!-- ---------------------Payment detail table End--------------------- -->
                </div>
                <form action="pay.php" method="post" accept-charset="utf-8">
                    <input type="hidden" name="student_name" value="<?php echo $student_name; ?>">
                    <input type="hidden" name="total_fees" value="<?php echo $dr * $fpm; ?>">
                    <?php
                    if ($row->fee_status == 0) {
                        echo '
                <h1 class="text-center text-danger mt-4">You Have To Pay Your Fee !</h1>
                    <div class="form-group text-center mt-4">
                        <input id="btn" type="submit" name="submit" class="btn btn-success btn-block" value="Pay Your Fee">
                    </div>';
                    } else {
                        echo "<h1 class='text-center text-warning mt-4'>You allready paid your hostel fee !</h1>";
                    }
                    ?>
                </form>
            </div>
            <!-- Container fluid End -->
<?php }
else{
 echo   "
 <div class='card my-4'>
                            <div class='card-body'>
                                <h4 class='card-title text-center text-success'>NOTE</h4>
                                <h1 class='my-4 text-danger font-weight-bold text-center'>You Don't Have Any booked  room</h1>
                            </div>
                        </div>
 ";
}
?>

</div>
<!-- End Page wrapper  -->


<!-- footer -->
<?php include '../includes/footer.php' ?>
<!-- End footer -->



    </div>
    <!-- End Wrapper -->
    <!-- End Wrapper -->

    <!-- All Jquery -->
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- apps -->
    <!-- apps -->
    <script src="../dist/js/app-style-switcher.js"></script>
    <script src="../dist/js/feather.min.js"></script>
    <script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="../dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <script src="../assets/extra-libs/c3/d3.min.js"></script>
    <script src="../assets/extra-libs/c3/c3.min.js"></script>
    <script src="../assets/libs/chartist/dist/chartist.min.js"></script>
    <script src="../assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="../dist/js/pages/dashboards/dashboard1.min.js"></script>
    <!-- Custom -->
</body>

</html>