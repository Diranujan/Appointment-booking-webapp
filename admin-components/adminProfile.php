<?php
//session_start();
require_once("conf/conf.php");
require_once "utils/constants.php";

// fetch user details
$sql = "SELECT 
            staffs.id, staffs.first_name, staffs.last_name, staffs.email, staffs.contact_email, staffs.password, 
            staffs.gender, staffs.phone_number, staffs.department_id, staffs.profession_id, 
            staffs.created_at, staffs.updated_at, staffs.faculty_id, 
            departments.name AS department_name, faculties.name AS faculty_name
        FROM 
            staffs
        LEFT JOIN 
            departments ON staffs.department_id = departments.id
        LEFT JOIN 
            faculties ON staffs.faculty_id = faculties.id
        WHERE 
            staffs.email = '" . $_SESSION['userEmail'] . "'
            AND staffs.department_id IS NOT NULL
            AND staffs.faculty_id IS NOT NULL; ";


$result = mysqli_query($conn, $sql);
$currentUser = mysqli_fetch_array($result, MYSQLI_ASSOC);

?>



<div class="tab-pane fade" id="adminprofile">
    <div class="container d-flex justify-content-center align-items-center ">
        <div class="row border-red rounded-5 p-3 shadow box-area blur-background bg-white">
            <div class="mx-auto">
                <div class="row align-items-center">


                    <div class="row justify-content-center">

                        <img src="images/user.png" class="img-fluid user-image" alt="User-image" style="width:250px; height:auto; padding:10px;">


                        <h1 class="text-center mt-3 text-primary font-weight-bold">
                            <?php echo $currentUser['first_name'] . '&nbsp; ' . $currentUser['last_name']; ?>
                        </h1>
                        <div class="text-center">
                            <i class="fas fa-envelope fa-lg mr-2"></i>
                            <h6 class="d-inline-block font-weight-bold">
                                <?php echo $currentUser['email']; ?>
                            </h6>
                        </div>


                        <h6 class="text-center font-weight-bold mb-4" style="color:  green ">
                            ACTIVE
                        </h6>




                    </div>

                    <hr>
                    <div class="row m-4">

                        <div class="col-sm-4">
                            <label class="form-label">Faculty:</label>
                            <b><p>
                                <?php echo $currentUser['faculty_name'] ?>
                            </p></b>
                        </div>

                        <div class="col-sm-4">
                            <label class="form-label">Department:</label>
                            <b><p>
                                <?php echo $currentUser['department_name'] ?>
                            </p></b>
                        </div>
                    </div>



                    <div class="row m-4">
                        <div class="col-sm-4">
                            <i class="fas fa-phone-alt fa-lg mr-2"></i>
                            <b><p>
                                <?php echo $currentUser['phone_number'] ?>
                            </p></b>
                        </div>

                        <div class="col-sm-4">
                            <i class="fas fa-venus-mars fa-lg mr-2"></i>
                            <b><p>
                                <?php echo $currentUser['gender'] ?>
                            </p></b>
                        </div>


                    </div>

                    <div class="row align-item-center">
                        <div class="col-sm-12 d-flex justify-content-center">
                            <a href="resetPassword.php" class="btn btn-primary" >Change Password</a>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>