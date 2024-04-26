<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="./assets/js/search.js"></script>

    <link href="./assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="./assets/bootstrap/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            background-color: #ecf0f1;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="javascript:void(0)">
                    <img src="./assets/img/logo.png" height="60">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mynavbar">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="registration.php">Registration</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Dashboard</a>
                        </li>   
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Dashboard</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>

        <!-- Student Information -->

        <div class="container">
            <br>
            <p>You can add record for student here.</p>
            <div class="card mt-3">

                <form action="save.php" method="POST">
                    <div class="card-header h3">Registration Form</div>
                    <div class="card-body">
                        <?php
                        if (isset($_GET['success'])) {
                            ?>
                            <div class="alert alert-success">
                                <b>New Student Added:</b> Congratulations! New STUDENT added.
                            </div>
                            <?php
                        } elseif (isset($_GET['invalid'])) {
                            ?>
                            <div class="alert alert-danger">
                                <b>Existed Application ID:</b> Details below are already EXISTED, Please try another.
                            </div>
                            <?php
                        }
                        ?>
                        <div class="row">
                            <div class="col-md-3">
                                <label> Student ID : <b class="text-danger">*</b></label>
                                <input name="inp_sid" required type="text" placeholder="Enter student ID here.."
                                    class="form-control mt-1">
                            </div>
                            <div class="col-md-4">
                                <label> Application ID : <b class="text-danger">*</b></label>
                                <input name="inp_appid" required type="text" placeholder="Enter Application ID here.."
                                    class="form-control mt-1">
                            </div>
                            <div class="col-md-5">
                                <label> TES Award Number : <b class="text-danger">*</b></label>
                                <input name="inp_tesno" required type="text" placeholder="Enter TES Award Number here.."
                                    class="form-control mt-1">
                            </div>

                        </div>
                        <div class="row mt-3">
                            <div class="col-md-3">
                                <label>First Name : <b class="text-danger">*</b></label>
                                <input name="inp_fname" required type="text" placeholder="Enter first name here.."
                                    class="form-control mt-1">
                            </div>
                            <div class="col-md-4">
                                <label>Last Name : <b class="text-danger">*</b></label>
                                <input name="inp_lname" required type="text" placeholder="Enter last name here.."
                                    class="form-control mt-1">
                            </div>
                            <div class="col-md-2">
                                <label>Ext. Name : <small>(Optional)</small></label>
                                <input name="inp_ename" type="text" placeholder="Ext. name here.."
                                    class="form-control mt-1">
                            </div>
                            <div class="col-md-3">
                                <label>Middle Name : <small>(Optional)</small></label>
                                <input name="inp_mname" type="text" placeholder="Enter middle name here.."
                                    class="form-control mt-1">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-3">
                                <label>Gender : <b class="text-danger">*</b></label>
                                <select name="inp_gender" required class="form-control mt-2">
                                    <option value="" disabled selected>-- SELECT GENDER --</option>
                                    <option value="Female">Female</option>
                                    <option value="Male">Male</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Contact Number : <b class="text-danger">*</b></label>
                                <input name="inp_contact" required type="text" placeholder="09 XXXX XXXX"
                                    class="form-control mt-1">
                            </div>
                            <div class="col-md-2">
                                <label>Award Batch : <b class="text-danger">*</b></label>
                                <input name="inp_batch" required type="text" placeholder="Batch X"
                                    class="form-control mt-1">
                            </div>
                            <div class="col-md-3">
                                <label>Status : <small>(Optional)</small></label>
                                <input name="inp_status" type="text" placeholder="Enter the student status here.."
                                    class="form-control mt-1">
                            </div>
                        </div>

                        <?php
                        include './config/database.php';
                        ?>
                        <div class="col-md-12">
                            <hr>
                        </div>
                        <div class="col-md-12">
                            <label>Region : <b class="text-danger">*</b></label>
                            <select name="inp_region" id="inp_region" onchange="display_province(this.value)" required
                                class="form-control mt-2">
                                <option value="" disabled selected>-- SELECT REGION --</option>

                                <?php
                                $sql = "SELECT * FROM ph_region";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <option value="<?= $row['regCode'] ?>"><?= $row['regDesc'] ?></option>
                                        <?php
                                    }
                                } else {
                                    echo "0 results";
                                }

                                $conn->close();
                                ?>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label>Province : <b class="text-danger">*</b></label>
                            <select name="inp_province" id="inp_province" onchange="display_citymun(this.value)"
                                required class="form-control mt-2">
                                <option value="" disabled selected>-- SELECT PROVINCE --</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label>City / Municipality : <b class="text-danger">*</b></label>
                            <select name="inp_citymun" id="inp_citymun" onchange="display_brgy(this.value)" required
                                class="form-control mt-2">
                                <option value="" disabled selected>-- SELECT CITY / MUNICIPALITY --</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label>Barangay : <b class="text-danger">*</b></label>
                            <select name="inp_brgy" id="inp_brgy" required class="form-control mt-2">
                                <option value="" disabled selected>-- SELECT BARANGAY --</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <hr>
                        </div>
                        <div class="card-footer">
                            <div class="row mt-12">
                                <div>
                                    <span style="float: right">
                                        <button class="btn btn-success">
                                            Add New Student
                                        </button>
                                    </span>
                                </div>
                            </div>
                </form>
            </div>
        </div>
    </main>
    <footer>
        <div>
            <p>
                <center>TCC-2024&#174;</center>
            </p>
        </div>
    </footer>
</body>

<script>
    function display_province(regCode) {
        $.ajax({
            url: './models/ph_address.php',
            type: 'POST',
            data: {
                'type': 'region',
                'post_code': regCode
            },
            success: function (response) {
                $('#inp_province').html(response);
            }
        });

    }

    function display_citymun(provCode) {
        $.ajax({
            url: './models/ph_address.php',
            type: 'POST',
            data: {
                'type': 'province',
                'post_code': provCode
            },
            success: function (response) {
                $('#inp_citymun').html(response);
            }
        });

    }

    function display_brgy(citymunCode) {
        $.ajax({
            url: './models/ph_address.php',
            type: 'POST',
            data: {
                'type': 'citymun',
                'post_code': citymunCode
            },
            success: function (response) {
                $('#inp_brgy').html(response);
            }
        });

    }

</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="./assets/js/registration.js"> </script>

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>

</html>