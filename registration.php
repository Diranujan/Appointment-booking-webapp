<?php 
    include "./templates/header.php";
    require_once "utils/constants.php";


$filename = $_SERVER['PHP_SELF'];
require_once("conf/conf.php");
?>

<!-- User Registration -->
<div class="container d-flex justify-content-center align-items-center ">
    <div class="row border-red rounded-5 p-3 shadow box-area blur-background">

        <div class="col-md-9 mx-auto">
            <div class="row align-items-center ">

                <?php
                require_once("conf/conf.php");

                $filename = $_SERVER['PHP_SELF'];
                $message = "";

                // Check if the form is submitted
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $firstName = $_POST["first_name"];
                    $lastName = $_POST["last_name"];
                    $email = $_POST["email"];
                    $phoneNum = $_POST["phone_num"];
                    $gender = $_POST["gender"];
                    $dob = $_POST["dob"];
                    $regNum = $_POST["reg_num"];
                    $facultyID = $_POST["faculty"];
                    $departmentID = $_POST["department"];
                    $password = $_POST["password"];
                    $status = "ACTIVE";
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                    $errors = array();

                    // Validation checks
                    if (empty($firstName) || empty($lastName) || empty($email) || empty($phoneNum) || empty($gender) || empty($dob) || empty($facultyID) || empty($departmentID) || empty($regNum)||  empty($password) ) {
                        array_push($errors, "All fields are required");
                    }
                    require_once "conf/conf.php";  
                    $sql = "SELECT * FROM students WHERE email = '$email'";
                    $resultEmail = $conn->query($sql);
                    $sql = "SELECT * FROM students WHERE reg_num = '$regNum'";
                    $resultReg = $conn->query($sql);
                    if ($resultEmail->num_rows > 0) {
                        array_push($errors,"Email already exists!");
                    }
                    if ($resultReg->num_rows > 0) {
                        array_push($errors,"Registration number already exists!");
                    }

                    if(count($errors)>0){
                        foreach($errors as $error){
                        echo "<div class='alert alert-danger'>$error</div>";
                        }
                    }else{

                        $query = "INSERT INTO `students`(`first_name`, `last_name`, `email`,`gender` , `phone_number`,`date_of_birth`,`faculty_id`, `department_id`, `password`,`status`,`reg_num`) 
                                            VALUES ('$firstName', '$lastName', '$email', '$gender', '$phoneNum', '$dob', '$facultyID', '$departmentID', '$hashedPassword','$status','$regNum')";
    
                        $result = mysqli_query($conn, $query);
    
                        if ($result) {
                            $message = "Query executed successfully.";
                            session_start();
                            $_SESSION['loggedin'] = true;
                            $_SESSION['userEmail'] = $email;
                            $_SESSION['userType'] = UserType::Student;
                            header("Location: login.php");
                            exit();
                        } else {
                            $message = "Error: " . mysqli_error($connect);
                        }
                    } 


                }
                ?>


                <!-- User Registration form -->
                <form id="user-Registration-form" class="h5" method="POST" action="<?PHP echo $filename; ?>">

                    <div class="header-text ">
                        <h1 style="color: #ff4b2b;">Hello User..!</h1>
                        <p>Welcome to scheduleme app</p>
                    </div>

                    <div class="row">
                        <label class="form-label">Name:</label>
                        <div class="form-group col">
                            <input type="text" class="form-control" name="first_name" placeholder="First Name" required>
                        </div>
                        <div class="form-group col">
                            <input type="text" class="form-control" name="last_name" placeholder="Last Name" required>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">Email:</label>
                        <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                    </div>


                    <div class="form-group mb-3">
                        <label class="form-label">Phone number:</label>
                        <input type="tel" name="phone_num" class="form-control" placeholder="Phone Number" required>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">Gender:</label>
                        <div class="form-check h5 ">
                            <input class="form-check-input" type="radio" name="gender" value="male" id="male" required>
                            <label class="form-check-label" for="male">Male</label>
                        </div>
                        <div class="form-check h5 ">
                            <input class="form-check-input" type="radio" name="gender" value="female" id="female" required>
                            <label class="form-check-label" for="female">Female</label>
                        </div>
                        <div class="form-check h5 ">
                            <input class="form-check-input" type="radio" name="gender" value="other" id="other" required>
                            <label class="form-check-label" for="other">Other</label>
                        </div>

                    </div>


                    <div class="form-group mb-3">
                        <label class="form-label">Date of Birth:</label>
                        <input type="date" name="dob" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">Registration Number:</label>
                        <input type="text" name="reg_num" class="form-control" placeholder="Reg Number" required>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">Faculty:</label>
                        <select id="facultyDropdown" name="faculty" id="faculty" class="form-select">
                            <option value="">Select a Faculty</option>

                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">Department:</label>
                        <select id="departmentDropdown" name="department" id="department" class="form-select">
                            <option value="">Select a Department</option>

                        </select>
                    </div>


                    <div class="form-group mb-3">
                        <label class="form-label">New Password:</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Create Password">
                        <small>
                            <div id="password-error" class="text-danger small"></div>
                        </small>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">Re-enter Password:</label>
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password">
                        <small>
                            <div id="confirm-password-error" class="text-danger small"></div>
                        </small>
                    </div>

                    <div class="form-group mb-3">
                        <input type="submit" value="Sign Up" class="btn btn-lg text-white w-100 fs-6 " style="background-color: #ff4b2b;">
                    </div>
                    <div class="form-group mb-3">
                        <button class="btn btn-lg btn-light w-100 fs-6"><img src="images/google_logo.png" style="width: 30px;" class="me-2"><small>Sign Up with Google</small></button>
                    </div>

                </form>
                <!-- User Registration form -->


            </div>
        </div>
    </div>
</div>
<!-- User Registration -->



<script>
    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('confirm_password');
        const signUpForm = document.getElementById('user-Registration-form');

        signUpForm.addEventListener('submit', function(event) {
            if (!validatePassword()) {
                event.preventDefault(); // Prevent form submission if validation fails
            }
        });

        function validatePassword() {
            const password = passwordInput.value.trim();
            const confirmPassword = confirmPasswordInput.value.trim();

            const passwordError = document.getElementById('password-error');
            const confirmPasswordError = document.getElementById('confirm-password-error');

            // Reset previous error messages
            passwordError.textContent = '';
            confirmPasswordError.textContent = '';

            // Check if the password meets the criteria
            const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/;
            if (!passwordRegex.test(password)) {
                passwordError.textContent = 'Password must be at least 8 characters long and include at least one lowercase letter, one uppercase letter, one digit, and one special character.';
                return false;
            }

            // Check if the passwords match
            if (password !== confirmPassword) {
                confirmPasswordError.textContent = 'Passwords do not match.';
                return false;
            }

            return true;
        }
    });
</script>



<!-- Fetch faculty and departments dynamically  -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        function fetchFaculties() {
            $.ajax({
                url: 'utils/fetch_faculties.php',
                method: 'GET',
                success: function(data) {
                    data.forEach(faculty => $('#facultyDropdown').append(`<option value="${faculty.id}">${faculty.name}</option>`));
                },
                error: function() {
                    console.error('Error fetching faculty names.');
                }
            });
        }

        function fetchDepartments(selectedFaculty) {
            $.ajax({
                url: 'utils/fetch_departments.php',
                method: 'GET',
                data: {
                    orderBy:'name',
                    orderMethod:'ASC',
                    whereBy:'faculty_id',
                    whereValue: selectedFaculty
                },
                success: function(data) {
                    $('#departmentDropdown').empty(); // Clear existing options
                    data.forEach(department => $('#departmentDropdown').append(`<option value="${department.id}">${department.name}</option>`));
                },
                error: function() {
                    console.error('Error fetching departments.');
                }
            });
        }

        $('#facultyDropdown').change(function() {
            const selectedFaculty = $(this).val();
            fetchDepartments(selectedFaculty);
        });

        // Fetch initial faculties on page load
        fetchFaculties();
    });
</script>


<?php include "./templates/footer.php"; ?>