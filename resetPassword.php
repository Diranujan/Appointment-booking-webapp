<?php
include "./templates/header.php";
require_once "utils/constants.php";
ob_start(); // Start output buffering
session_start();


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

                    $email = $_POST["email"];
                    $currentPassword = $_POST["current_password"];
                    $newPassword = $_POST["password"];
                    $confirmPassword = $_POST["confirm_password"];

                    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                    $errors = array();

                    // Validation checks
                    if (empty($email) || empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
                        array_push($errors, "All fields are required");
                    }
                    require_once "conf/conf.php";
                    if ($_SESSION['userType'] === UserType::Student) {
                        $sql = "SELECT `password` FROM students WHERE email = '$email'";
                        $db = "students";
                    } elseif ($_SESSION['userType'] === UserType::Admin) {
                        $sql = "SELECT `password` FROM staffs WHERE email = '$email' AND id > 0";
                        $db = "staffs";
                    } elseif ($_SESSION['userType'] === UserType::SuperAdmin) {
                        $sql = "SELECT `password` FROM staffs WHERE email = '$email' AND id = 0";
                        $db = "staffs";
                    }

                    $result = $conn->query($sql);

                    $result = mysqli_query($conn, $sql);
                    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    //check current password
                    if (!(password_verify($currentPassword, $user['password']))) {
                        array_push($errors, "Current Password is not matched");
                    }


                    if (count($errors) > 0) {
                        foreach ($errors as $error) {
                            echo "<div class='alert alert-danger'>$error</div>";
                        }
                    } else {

                        $query = "UPDATE 
                                    $db
                                SET
                                    `password` = '$hashedPassword'
                                WHERE
                                    `email` = '" . $_SESSION['userEmail'] . "'";


                        $result = mysqli_query($conn, $query);

                        if ($result) {
                            $message = "Query executed successfully.";
                            header("Location: logout.php");
                            exit();
                        } else {
                            $message = "Error: " . mysqli_error($connect);
                        }
                    }
                }
                ?>


                <!-- User Registration form -->
                <form id="password-reset-form" class="h5" method="POST" action="<?PHP echo $filename; ?>">

                    <div class="header-text mb-5">
                        <h1 style="color: #ff4b2b;">Hello User..!</h1>
                        <p><b>Reset your current password </b></p>
                    </div>


                    <div class="form-group mb-3">
                        <label class="form-label">Email:</label>
                        <input type="email" class="form-control" name="email" value="<?php echo $_SESSION['userEmail'] ?>" required readonly>
                    </div>


                    <div class="form-group mb-3">
                        <label class="form-label">Curent Password:</label>
                        <input type="password" name="current_password" id="current_password" class="form-control" placeholder="Enter Current Password">
                    </div>


                    <div class="form-group mb-3">
                        <label class="form-label">New Password:</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Create New Password">
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
                        <input type="submit" value="Reset Password" class="btn btn-lg text-white w-100 fs-6 " style="background-color: #ff4b2b;">
                    </div>


                </form>


            </div>
        </div>
    </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('confirm_password');
        const resetPasswordForm = document.getElementById('password-reset-form');

        resetPasswordForm.addEventListener('submit', function(event) {
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



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



<?php include "./templates/footer.php"; ?>

<?php
ob_end_flush(); // Flush the output buffer
?>