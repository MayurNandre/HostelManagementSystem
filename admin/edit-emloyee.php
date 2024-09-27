<?php
session_start();
include('../includes/dbconn.php');
include('../includes/check-login.php');
check_login();
/* ------------Handling Edit Room------------ */
if (isset($_POST['submit'])) {
    $work = $_POST['empWork'];
    $id = $_GET['id'];
    $query = "UPDATE employees set e_work=? where e_id=?";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('si', $work, $id);
    $stmt->execute();
    echo "<script>alert('Room details has been updated');
        window.location.href='emloyees.php';
        </script>";
}
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- ----------------Favicon---------------- -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>Hostel Management System</title>
    <!-- Custom CSS -->
    <link href="../assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="../assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <!-- <link href="../dist/css/style.min.css" rel="stylesheet"> --><!-- Minified CSS -->
    <link href="../dist/css/style.css" rel="stylesheet"><!-- Plain CSS -->

</head>

<body>
    <!-- -------------Preloader------------- -->
    <!-- <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div> -->
    <!-- -------------Preloader End------------- -->

    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">

        <!-- Topbar header -  (pages.scss) -->
        <header class="topbar" data-navbarbg="skin6">
            <?php include 'includes/navigation.php' ?>
        </header>
        <!-- End Topbar header -->


        <!-- Left Sidebar -  (sidebar.scss ) -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <?php include 'includes/sidebar.php' ?>
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- End Left Sidebar -    sidebar.scss  -->


        <!-- Page wrapper  -->
        <div class="page-wrapper">

            <!-- Bread crumb and right sidebar toggle -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 align-self-center">
                        <h2 class="page-title text-center text-dark font-weight-medium mb-1">Edit Emloyee Details</h2>
                        <div class="d-flex align-items-center">
                            <!-- <nav aria-label="breadcrumb">
                                
                            </nav> -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- End Bread crumb and right sidebar toggle -->

            <!-- --------------Container fluid--------------  -->
            <div class="container-fluid">
                <!-- ---------------------Form--------------------- -->
                <form method="POST">

                    <div class="row">

                        <?php
                        $id = $_GET['id'];
                        $ret = "SELECT * from employees where e_id=?";
                        $stmt = $mysqli->prepare($ret);
                        $stmt->bind_param('i', $id);
                        $stmt->execute(); //ok
                        $res = $stmt->get_result();
                        //$cnt=1;
                        while ($row = $res->fetch_object()) {
                        ?>


                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Emloyee Name</h4>
                                        <div class="form-group">
                                            <input type="text" name="empName" value="<?php echo $row->e_name; ?>" id="empName" class="form-control" disabled>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Work</h4>
                                        <div class="form-group">
                                            <input type="text" name="empWork" id="empWork" value="<?php echo $row->e_work; ?>" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>

                    </div>

                    <div class="form-actions">
                        <div class="text-center">
                            <button type="submit" name="submit" class="btn btn-success">Update</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                        </div>
                    </div>
                </form>
                <!-- ---------------------Form--------------------- -->
            </div>
            <!-- End Container fluid  -->

            <!-- footer -->
            <?php include '../includes/footer.php' ?>
            <!-- End footer -->

        </div>

        <!-- End Page wrapper  -->
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

</body>

</html>