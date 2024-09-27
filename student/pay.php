<?php
session_start();
include('../includes/dbconn.php');
include('../includes/check-login.php');
check_Student_login();
// use Instamojo\Instamojo;
if (isset($_POST['student_name'])) {
    $student_name = $_POST['student_name'];
    $total_fees = $_POST['total_fees'];
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Hostel Management - Payment</title>

    <link href="../dist/css/style.css" rel="stylesheet"><!-- Plain CSS -->
    <link href="../dist/css/mycustom.css" rel="stylesheet"><!-- Plain CSS -->

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


    <!-- ----------------------------------Payment Box----------------------------------  -->
    <div class="container my-4 d-flex justify-content-center align-item-center">
        <div class="card mb-3 mt-4" style="width: 700px;height:540px;">
            <div class="row no-gutters mt-4">
                <div class="col-md-6 col-4 mt-4 ">
                    <img src="../assets/images/payment.jpg" class="card-img" alt="...">
                    <h6 class="text-center text-monospace text-secondary mt-4">
                        <?php echo "Student : " . $student_name; ?>
                    </h6>
                    <h6 class="text-center text-monospace text-secondary">
                        <?php echo "Total Fees To Pay : ₹" . $total_fees; ?>
                    </h6>
                </div>
                <!-- Form Part of payment -->
                <div class="col-md-6">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Pay hostel Fees</h3>

                        <h6 class="text-left mt-4 ml-3">Card Number</h6>
                        <div class="container">
                            <!-- ---------------------Form--------------------- -->
                            <form class="needs-validation" action="thankyou.php" method="post" novalidate>
                                <div class="input-group mb-3 mt-1">
                                    <input type="number" class="form-control" placeholder="ENTER CARD NUMBER" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2"><img style="width: 24px;" class="img" src="../assets/images/credit-card.png" alt=""></span>
                                    </div>
                                </div>


                                <h6 class="text-left">Card Expiry Date</h6>

                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <label for="validationDefault03">Day</label>
                                        <input type="number" class="form-control" id="validationDefault03" placeholder="DD" required>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="validationDefault04">Month</label>
                                        <input type="number" class="form-control" id="validationDefault04" placeholder="MM" required>
                                    </div>

                                    <div class="col-md-4 mb-2">
                                        <label for="validationDefault05">Year</label>
                                        <input type="number" class="form-control" id="validationDefault05" placeholder="YYYY" required>
                                    </div>
                                </div>

                                <div class="p-0 col-md-6">
                                    <label for="inlineFormInputName">CVV</label>
                                    <input type="number" class="form-control" id="inlineFormInputName" placeholder="ENTER CVV" required>
                                </div>

                                <p class="card-text ml-3 mt-2"><small class="text-muted">Fill the imformation Properly and click on Pay</small></p>

                                <div class="text-center mt-4">
                                    <input class="btn btn-danger" type="submit" value="Pay ₹<?php echo $total_fees ?>">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ----------------------------------Payment Box----------------------------------  -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script type="text/javascript">
        setInterval
        $(document).ready(function() {
            setInterval(function() {
                $('.preloader').hide();
            }, 500);
        })
    </script>


    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>


</body>

</html>