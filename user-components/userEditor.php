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



<div class="tab-pane fade" id="edit">
    <div class="container d-flex justify-content-center align-items-center ">
        <div class="row border-red rounded-5 p-3 shadow box-area blur-background">
            <div class="mx-auto">
                <div class="row align-items-center">
                    <h1 class="text-center">Update Your Details here</h1>
                    <?php
                    $filename = $_SERVER['PHP_SELF'];
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        // Assuming you have updated the form fields' names
                        $first_name = $_POST["first_name"];
                        $last_name = $_POST["last_name"];
                        $email = $_POST["email"];
                        $phone_num = $_POST["phone_num"];
                        $gender = $_POST["gender"];
                        $dob = $_POST["dob"];
                        $facultyId = $_POST["faculty"];
                        $departmentId = $_POST["department"];


                        // Update the user details in the database
                        // Update the user details in the database
                        $updateSql = "UPDATE students SET
                            first_name = '$first_name',
                            last_name = '$last_name',
                            email = '$email',
                            phone_number = '$phone_num',
                            gender = '$gender',
                            date_of_birth = '$dob',
                            faculty_id = '$facultyId',  
                            department_id = '$departmentId' 
                            WHERE reg_num = '" . $currentUser['reg_num'] . "'";

                        $updateResult = mysqli_query($conn, $updateSql);

                        if ($updateResult) {
                            // Success: Redirect or display a success message
                            header("Location: userhome.php");
                            // exit();
                        } else {
                            $message = "Error: " . mysqli_error($conn);
                            echo $message;
                        }

                    }

                    // // Include JavaScript to show a popup message after the page loads
                    // if (isset($updateResult) && $updateResult) {
                    //     echo '<script>alert("User details updated successfully!");</script>';
                    // }
                    
                    ?>


                    <form id="user-update-form" class="h5" method="POST" action="<?PHP echo $filename; ?>">



                        <div class="row">
                            <label class="form-label">Name:</label>
                            <div class="form-group col">
                                <input type="text" class="form-control" name="first_name" placeholder="First Name"
                                    value="<?php echo $currentUser['first_name'] ?>" required>
                            </div>
                            <div class="form-group col">
                                <input type="text" class="form-control" name="last_name" placeholder="Last Name"
                                    value="<?php echo $currentUser['last_name'] ?>" required>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">Email:</label>
                            <input type="email" class="form-control" name="email" placeholder="Email Address"
                                value="<?php echo $currentUser['email'] ?>" required disabled>
                        </div>


                        <div class="form-group mb-3">
                            <label class="form-label">Phone number:</label>
                            <input type="tel" name="phone_num" class="form-control" placeholder="Phone Number"
                                value="<?php echo $currentUser['phone_number'] ?>" required>
                        </div>

                        <div class="form-check h5">
                            <input class="form-check-input" type="radio" name="gender" value="male" id="male" <?php echo ($currentUser['gender'] === 'male') ? 'checked' : ''; ?> required>
                            <label class="form-check-label" for="male">Male</label>
                        </div>
                        <div class="form-check h5">
                            <input class="form-check-input" type="radio" name="gender" value="female" id="female" <?php echo ($currentUser['gender'] === 'female') ? 'checked' : ''; ?> required>
                            <label class="form-check-label" for="female">Female</label>
                        </div>
                        <div class="form-check h5">
                            <input class="form-check-input" type="radio" name="gender" value="others" id="others" <?php echo ($currentUser['gender'] === 'others') ? 'checked' : ''; ?> required>
                            <label class="form-check-label" for="others">Others</label>
                        </div>



                        <div class="form-group mb-3">
                            <label class="form-label">Date of Birth:</label>
                            <input type="date" name="dob" class="form-control"
                                value="<?php echo $currentUser['date_of_birth'] ?>" required>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">Registration Number:</label>
                            <input type="text" name="reg_num" class="form-control" placeholder="Reg Number"
                                value="<?php echo $currentUser['reg_num'] ?>" disabled required>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">Faculty:</label>
                            <select id="facultyDropdown" name="faculty" class="form-select">
                                <!-- Add a selected attribute if the faculty matches the current user's faculty -->
                                <option value="<?php echo $currentUser['faculty_id']; ?>" selected>
                                    <?php echo $currentUser['faculty_name']; ?>
                                </option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">Department:</label>
                            <select id="departmentDropdown" name="department" class="form-select">
                                <!-- Add a selected attribute if the department matches the current user's department -->
                                <option value="<?php echo $currentUser['department_id']; ?>" selected>
                                    <?php echo $currentUser['department_name']; ?>
                                </option>
                            </select>
                        </div>



                        <div class="form-group mb-3">
                            <input type="submit" value="update" class="btn btn-lg text-white w-100 fs-6 "
                                style="background-color: #ff4b2b;">
                        </div>


                    </form>

                </div>
            </div>
        </div>
    </div>
</div>



<!-- Fetch faculty and departments dynamically  -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        function fetchFaculties() {
            $.ajax({
                url: 'utils/fetch_faculties.php',
                method: 'GET',
                success: function (data) {
                    data.forEach(faculty => $('#facultyDropdown').append(`<option value="${faculty.id}">${faculty.name}</option>`));
                },
                error: function () {
                    console.error('Error fetching faculty names.');
                }
            });
        }

        function fetchDepartments(selectedFaculty) {
            $.ajax({
                url: 'utils/fetch_departments.php',
                method: 'GET',
                data: {
                    faculty_id: selectedFaculty
                },
                success: function (data) {
                    $('#departmentDropdown').empty(); // Clear existing options
                    data.forEach(department => $('#departmentDropdown').append(`<option value="${department.id}">${department.name}</option>`));
                },
                error: function () {
                    console.error('Error fetching departments.');
                }
            });
        }

        $('#facultyDropdown').change(function () {
            const selectedFaculty = $(this).val();
            fetchDepartments(selectedFaculty);
        });

        // Fetch initial faculties on page load
        fetchFaculties();
    });
</script>