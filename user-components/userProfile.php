<?php
//session_start();
require_once("conf/conf.php");
require_once "utils/constants.php";

// fetch user details
$sql = "  SELECT 
            students.id, students.first_name, students.last_name, students.email,students.date_of_birth,
            students.gender, students.phone_number,  students.reg_num,  students.status, 
            students.year_of_study,students.faculty_id,faculties.name AS faculty_name, 
            students.department_id,departments.name AS department_name
        FROM 
            students
        INNER JOIN 
            faculties ON students.faculty_id = faculties.id
        INNER JOIN 
            departments ON students.department_id = departments.id
        WHERE students.email = '" . $_SESSION['userEmail'] . "'";
$result = mysqli_query($conn, $sql);
$currentUser = mysqli_fetch_array($result, MYSQLI_ASSOC);

?>



<div class="tab-pane fade" id="profile">
    <div class="container d-flex justify-content-center align-items-center ">
        <div class="row border-red rounded-5 p-3 shadow box-area blur-background bg-white">
            <div class="mx-auto">
                <div class="row align-items-center">


                    <div class="row justify-content-center">

                        <img src="images/user.png" class="img-fluid user-image" alt="User-image" style="width:250px; height:auto; padding:10px;">


                        <h1 class="text-center mt-3 text-primary font-weight-bold">
                            <?php echo $currentUser['last_name'] . '&nbsp;&nbsp; ' . $currentUser['first_name']; ?>
                        </h1>
                        <div class="text-center">
                            <i class="fas fa-envelope fa-lg mr-2"></i>&nbsp;
                            <h6 class="d-inline-block font-weight-bold">
                                <?php echo $currentUser['email']; ?>
                            </h6>
                        </div>


                        <h6 class="text-center font-weight-bold" style="color: <?php echo ($currentUser['status'] === 'ACTIVE') ? 'green' : 'red'; ?>;">
                            <?php echo $currentUser['status']; ?>
                        </h6>




                    </div>

                    <hr>
                    <div class="row m-4">
                        <div class="col-sm-4">
                            <label class="form-label">Registration Number:</label>
                            <p>
                                <b><?php echo $currentUser['reg_num'] ?></b>
                            </p>
                        </div>

                        <div class="col-sm-4">
                            <label class="form-label">Faculty:</label>
                            <p>
                                <b><?php echo $currentUser['faculty_name'] ?></b>
                            </p>
                        </div>

                        <div class="col-sm-4">
                            <label class="form-label">Department:</label>
                            <p>
                                <b><?php echo $currentUser['department_name'] ?></b>
                            </p>
                        </div>
                    </div>



                    <div class="row m-4">
                        <div class="col-sm-4">
                            <i class="fas fa-phone-alt fa-lg mr-2"></i>
                            <p>
                                <b><?php echo $currentUser['phone_number'] ?></b>
                            </p>
                        </div>

                        <div class="col-sm-4">
                            <i class="fas fa-venus-mars fa-lg mr-2"></i>
                            <p>
                                <b><?php echo $currentUser['gender'] ?></b>
                            </p>
                        </div>

                        <div class="col-sm-4">
                            <i class="fas fa-calendar-alt fa-lg mr-2"></i>
                            <p>
                                <b><?php echo $currentUser['date_of_birth'] ?></b>
                            </p>
                        </div>
                    </div>

                    <div class="row align-item-center">
                        <div class="col-sm-12 d-flex justify-content-center">
                            <a href="resetPassword.php" class="btn btn-primary">Change Password</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>