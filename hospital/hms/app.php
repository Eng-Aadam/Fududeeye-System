<?php
session_start();
error_reporting(0);
include('include/config.php');

if (strlen($_SESSION['id']) == 0) {
    header('location:logout.php');
} else {
    if (isset($_GET['cancel'])) {
        mysqli_query($con, "update appointment set userStatus='0' where id = '" . $_GET['id'] . "'");
        $_SESSION['msg'] = "Your appointment canceled !!";
    }

    // Handle manual mobile money payment submission
    if (isset($_POST['submit_payment'])) {
        $payment_method = mysqli_real_escape_string($con, $_POST['payment_method']);
        $sender_phone = mysqli_real_escape_string($con, $_POST['sender_phone']);
        $transaction_reference = mysqli_real_escape_string($con, $_POST['transaction_reference']);
        $postedAppointmentId = isset($_POST['appointment_id']) ? intval($_POST['appointment_id']) : 0;

        // Update latest appointment for this user with payment info and set status to Pending
        $userId = $_SESSION['id'];
        if ($postedAppointmentId > 0) {
            $updateSql = "UPDATE appointment 
                           SET payment_method='$payment_method',
                               payment_phone='$sender_phone',
                               payment_reference='$transaction_reference',
                               payment_status='Pending'
                           WHERE userId='$userId' AND id='$postedAppointmentId'";
        } else {
            $updateSql = "UPDATE appointment 
                           SET payment_method='$payment_method',
                               payment_phone='$sender_phone',
                               payment_reference='$transaction_reference',
                               payment_status='Pending'
                           WHERE userId='$userId'
                           ORDER BY id DESC
                           LIMIT 1";
        }
        mysqli_query($con, $updateSql);

        $_SESSION['msg'] = 'Payment details submitted. Status: Pending admin approval.';
    }
}
?>

<!DOCTYPE html>
<html lang="en" ng-app="calcApp">

<head>
    <title>User | Appointment History</title>

    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script>
        var receiptFileName = 'appointment-receipt.png';

        function captureScreenshot() {
            var target = document.querySelector(".receipt-capture");
            if (!target) {
                return;
            }
            html2canvas(target, {
                scale: 2
            }).then(function(canvas) {
                var link = document.createElement('a');
                link.href = canvas.toDataURL('image/png');
                link.download = receiptFileName;
                link.click();
            });
        }
    </script>
    <script>setTimeout(function () {
            document.getElementById('messageBox').style.display = 'block';
        }, 5000);</script>
    <style>
        .loading-container {
            text-align: center;
        }

        .loading-animation {
            display: inline-block;
            width: 50px;
            height: 50px;
            border: 8px solid #3498db;
            border-top: 8px solid #e74c3c;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .message-box {
            display: none;
            background-color: #3498db;
            color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            margin-top: 20px;
        }

        .receipt-card {
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 18px;
            background: #ffffff;
        }

        .receipt-card .receipt-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .receipt-card .receipt-title {
            font-size: 18px;
            font-weight: 700;
            margin: 0;
        }

        .receipt-card .receipt-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            background: #f1f5f9;
            color: #0f172a;
        }

        .receipt-card .receipt-badge.approved {
            background: #dcfce7;
            color: #166534;
        }

        .receipt-card .receipt-badge.pending {
            background: #fef9c3;
            color: #854d0e;
        }

        .receipt-card .table {
            margin-bottom: 0;
        }
    </style>

    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
    <link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
    <link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
    <link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="screen">
    <link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
    <link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/plugins.css">
    <link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
</head>

<body>
    <div id="app">
        <?php include('include/sidebar.php'); ?>
        <div class="app-content">
            <?php include('include/header.php'); ?>
            <div class="main-content">
                <div class="wrap-content container" id="container">
                    <main class="print-content">
                        <section id="page-title">
                            <div class="row">
                                <div class="col-sm-8">
                                    <h1 class="mainTitle">User | Appointment Receipt</h1>
                                </div>
                                <ol class="breadcrumb">
                                    <li><span>User </span></li>
                                    <li class="active"><span>Appointment Receipt</span></li>
                                </ol>
                            </div>
                        </section>
                        <div class="container-fluid container-fullw bg-white">
                            <div class="row">
                                <div class="col-md-12">
                                    <p style="color:red;"><?php echo htmlentities($_SESSION['msg']); ?>
                                        <?php echo htmlentities($_SESSION['msg'] = ""); ?></p>
                                    <loader ng-show="processing">
                                        <div class="loading-container">
                                            <div class="loading-animation"></div>
                                        </div>
                                    </loader>
                                    <?php
                                    $selectedAppointmentId = isset($_GET['id']) ? intval($_GET['id']) : 0;
                                    $appointmentSql = "SELECT doctors.doctorName AS docname, appointment.*
                                    FROM appointment
                                    JOIN doctors ON doctors.id = appointment.doctorId
                                    WHERE appointment.userId='" . $_SESSION['id'] . "'";
                                    if ($selectedAppointmentId > 0) {
                                        $appointmentSql .= " AND appointment.id='" . $selectedAppointmentId . "'";
                                    }
                                    $appointmentSql .= " ORDER BY appointment.id DESC LIMIT 1";
                                    $appointmentQuery = mysqli_query($con, $appointmentSql);
                                    $appointmentRow = mysqli_fetch_array($appointmentQuery);
                                    if ($appointmentRow) {
                                        $receiptName = 'appointment-receipt-' . intval($appointmentRow['id']) . '.png';
                                    ?>
                                        <script>
                                            receiptFileName = <?php echo json_encode($receiptName); ?>;
                                        </script>
                                        <div class="receipt-capture">
                                            <div class="receipt-card">
                                                <div class="receipt-header">
                                                    <p class="receipt-title">Fududeeye Appointment Receipt</p>
                                                    <?php if (isset($appointmentRow['payment_status']) && $appointmentRow['payment_status'] == 'Approved') { ?>
                                                        <span class="receipt-badge approved">Paid</span>
                                                    <?php } elseif (isset($appointmentRow['payment_status']) && $appointmentRow['payment_status'] == 'Pending') { ?>
                                                        <span class="receipt-badge pending">Pending</span>
                                                    <?php } else { ?>
                                                        <span class="receipt-badge">Not Submitted</span>
                                                    <?php } ?>
                                                </div>
                                                <table class="table table-hover" id="sample-table-1" ng-show="!processing">
                                                    <thead>
                                                        <tr>
                                                            <th>Receipt No.</th>
                                                            <td><?php echo intval($appointmentRow['id']); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Patient Name</th>
                                                            <td>
                                                                <span class="username">
                                                                    <?php $query1 = mysqli_query($con, "select fullName from users where id='" . $_SESSION['id'] . "'");
                                                                    while ($row1 = mysqli_fetch_array($query1)) {
                                                                        echo $row1['fullName'];
                                                                    }
                                                                    ?>
                                                                </span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="hidden-xs">Doctor Name</th>
                                                            <td class="hidden-xs"><?php echo htmlentities($appointmentRow['docname']); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Specialization</th>
                                                            <td><?php echo htmlentities($appointmentRow['doctorSpecialization']); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Consultancy Fee</th>
                                                            <td><?php echo htmlentities($appointmentRow['consultancyFees']); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Appointment Date / Time </th>
                                                            <td><?php echo htmlentities($appointmentRow['appointmentDate']); ?> / <?php echo htmlentities($appointmentRow['appointmentTime']); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Appointment Creation Date </th>
                                                            <td><?php echo htmlentities($appointmentRow['postingDate']); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Payment Status</th>
                                                            <td><?php echo isset($appointmentRow['payment_status']) ? htmlentities($appointmentRow['payment_status']) : 'Not Submitted'; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Payment Method</th>
                                                            <td><?php echo isset($appointmentRow['payment_method']) ? htmlentities($appointmentRow['payment_method']) : '-'; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Sender Phone</th>
                                                            <td><?php echo isset($appointmentRow['payment_phone']) ? htmlentities($appointmentRow['payment_phone']) : '-'; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Transaction Reference</th>
                                                            <td><?php echo isset($appointmentRow['payment_reference']) ? htmlentities($appointmentRow['payment_reference']) : '-'; ?></td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    <?php } else { ?>
                                        <p>No appointment found.</p>
                                    <?php } ?>
                                    <?php if ($appointmentRow && isset($appointmentRow['payment_status']) && $appointmentRow['payment_status'] == 'Approved') { ?>
                                        <div style="text-align: center; margin-bottom: 20px;">
                                            <button id="printButton" onclick="captureScreenshot()" style="background-color: #4CAF50;
                                                border: none;
                                                color: white;
                                                padding: 10px 24px;
                                                text-align: center;
                                                text-decoration: none;
                                                display: inline-block;
                                                font-size: 16px;
                                                margin: 4px 2px;
                                                cursor: pointer;
                                                border-radius: 12px;">
                                                Download Receipt
                                            </button>
                                        </div>
                                    <?php } ?>
                                    <h3>Mobile Money Payment</h3>
                                    <p>
                                        Select a payment method and send the consultancy fee to the displayed phone number.
                                        Then enter your sender phone number and transaction reference so the admin can verify.
                                    </p>
                                    <?php if ($appointmentRow && (!isset($appointmentRow['payment_status']) || $appointmentRow['payment_status'] != 'Approved')) { ?>
                                        <form method="post">
                                            <input type="hidden" name="appointment_id" value="<?php echo intval($appointmentRow['id']); ?>">
                                            <div class="form-group">
                                                <label for="payment_method">Payment Method</label>
                                                <select name="payment_method" id="payment_method" class="form-control" required>
                                                    <option value="">Select Method</option>
                                                    <option value="EVC Plus (Hormuud)">EVC Plus (Hormuud)</option>
                                                    <option value="Golis Sahal">Golis Sahal</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="sender_phone">Your Mobile Money Number</label>
                                                <input type="text" name="sender_phone" id="sender_phone" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="transaction_reference">Transaction Reference / Note</label>
                                                <input type="text" name="transaction_reference" id="transaction_reference" class="form-control" required>
                                            </div>
                                            <button type="submit" name="submit_payment" class="btn btn-primary">Submit Payment Details</button>
                                        </form>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>
    <!-- start: MAIN JAVASCRIPTS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/modernizr/modernizr.js"></script>
    <script src="vendor/jquery-cookie/jquery.cookie.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="vendor/switchery/switchery.min.js"></script>
    <!-- end: MAIN JAVASCRIPTS -->
    <!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
    <script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
    <script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="vendor/autosize/autosize.min.js"></script>
    <script src="vendor/selectFx/classie.js"></script>
    <script src="vendor/selectFx/selectFx.js"></script>
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
    <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
    <!-- start: CLIP-TWO JAVASCRIPTS -->
    <script src="assets/js/main.js"></script>
    <!-- start: JavaScript Event Handlers for this page -->
    <script src="assets/js/form-elements.js"></script>
    <script>
        jQuery(document).ready(function () {
            Main.init();
            FormElements.init();
        });
    </script>
    <!-- end: JavaScript Event Handlers for this page -->
    <!-- end: CLIP-TWO JAVASCRIPTS -->
</body>

</html>
