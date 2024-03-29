<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:dashboard.php');
} else {
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Manage Enquiries</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
        .row.content {
            height: 550px
        }

        /* Set gray background color and 100% height */
        .sidenav {
            background-color: #f1f1f1;
            height: 100%;
            width: auto;
        }

        /* On small screens, set height to 'auto' for the grid */
        @media screen and (max-width: 767px) {
            .row.content {
                height: auto;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-3 col-md-2 sidebar">
                <br>
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="manage-hotels.php">Manage Hotels</a></li>
                    <li><a href="manage-packages.php">Manage Packages</a></li>
                    <li><a href="manage-bookings.php">Manage Bookings</a></li>
                    <li class="active"><a href="manage-enquiries.php">Manage Enquiries</a></li>
                </ul><br>
            </div>
            <br>

            <div class="col-sm-9">
                <div class="well">
                    <h4>Manage Enquiries</h4><br>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Posted on</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sql = "SELECT * from contact";
                            $query = $dbh->prepare($sql);
                            //$query -> bindParam(':city', $city, PDO::PARAM_STR);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            $cnt = 1;
                            if ($query->rowCount() > 0) {
                                foreach ($results as $result) { ?>
                                    <tr>
                                        <td><?php echo htmlentities($cnt); ?></td>
                                        <td><?php echo htmlentities($result->user_name); ?></td>
                                        <td><?php echo htmlentities($result->user_email); ?></td>
                                        <td><?php echo htmlentities($result->user_subject); ?></td>
                                        <td><?php echo htmlentities($result->user_message); ?></td>
                                        <td><?php echo htmlentities($result->posting_date); ?></td>
                                    </tr>
                            <?php $cnt = $cnt + 1;
                                }
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
<?php } ?>