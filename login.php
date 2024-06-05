<?php
require_once "utils/constants.php";
ob_start(); // Start output buffering
session_start();


// Check if the user is logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
  // Redirect the user to their respective home page based on userType
  if ($_SESSION['userType'] === UserType::Student) {
    header("Location: userHome.php");
  } elseif ($_SESSION['userType'] === UserType::Admin) {
    header("Location: adminHome.php");
  } elseif ($_SESSION['userType'] === UserType::SuperAdmin) {
    header("Location: superAdminHome.php");
  }
  exit();
}

// Check if a remember user cookie exists
if (isset($_COOKIE['remember_user_email']) && isset($_COOKIE['remember_user_type'])) {
  // Automatically log in the user using the cookie information
  $_SESSION['loggedin'] = true;
  $_SESSION['userEmail'] = $_COOKIE['remember_user_email'];
  $_SESSION['userType'] = $_COOKIE['remember_user_type'];

  // Redirect the user to their respective home page based on userType
  if ($_SESSION['userType'] === UserType::Student) {
    header("Location: userHome.php");
  } elseif ($_SESSION['userType'] === UserType::Admin) {
    header("Location: adminHome.php");
  } elseif ($_SESSION['userType'] === UserType::SuperAdmin) {
    header("Location: superAdminHome.php");
  }
  exit();
}


include "./templates/header.php";
require_once("conf/conf.php");

?>

<!--log in-->
<div class="container d-flex justify-content-center align-items-center ">
  <div class="row border-red rounded-5 p-3 shadow box-area">
    <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column  left-box" style="background:#807a79;">
      <div class="text-center">
        <h3 class="user-type-one mb-5 text-white fs-1">Student</h3>
        <div id="btn-toggle">
          <input type="checkbox" class="toggle">
          <div class="toggle-handle"></div>
        </div>
        <h5 class="user-type-two mb-5  text-white" style="font-family:'Courier Prime', Courier,monospace;">Slide to
          Admin log in</h5>
      </div>
    </div>
    <div class="col-md-6 right-box">
      <div class="row align-items-center ">

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $userEmail = $_POST['email'];
          $password = $_POST['password'];
          $userType = $_POST['user_type'];


          require_once("conf/conf.php");
          if ($userType == UserType::Admin) {
            $userDb = 'staffs';
            $redirectPage = 'adminHome.php';
          } else if ($userType == UserType::Student) {
            $userDb = 'students';
            $redirectPage = 'userHome.php';
          }


          $sql = "SELECT * FROM " . $userDb . " WHERE email='$userEmail'";
          $result = mysqli_query($conn, $sql);
          $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
          $userId = $user['id'];

          //check success loggedin
          if ($user && password_verify($password, $user['password'])) {

            //check superAdmin
            if ($userType == UserType::Admin) {
              $sql = "SELECT professions.name AS profession_name
                      FROM staffs
                      JOIN professions ON staffs.profession_id = professions.id 
                      WHERE email='$userEmail'";
              $result = mysqli_query($conn, $sql);
              $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
              if ($user['profession_name'] == UserType::SuperAdmin) {
                $userType = UserType::SuperAdmin;
                $redirectPage = 'superAdminHome.php';
              }
            }

            // Valid credentials - set up the session
            $_SESSION['userType'] = $userType;
            $_SESSION['userEmail'] = $userEmail;
            $_SESSION['userId'] = $userId;
            $_SESSION['loggedin'] = true;

            // Check if the "Remember Me" checkbox is checked
            if (isset($_POST['remember_me'])) {
              // Set a cookies that expires in 30 days
              setcookie('remember_user_email', $userEmail, time() + (0.5 * 60 * 60), '/');
              setcookie('remember_user_type', $userType, time() + (0.5 * 60 * 60), '/');
            }

            // Redirect to a logged-in page
            header("Location: " . $redirectPage);
            exit();
          } else {
            if (!$user) {
              echo "<div class='alert alert-danger'>User does not exists!</div>";
            } else {
              echo "<div class='alert alert-danger'>Wrong password!</div>";
            }
          }
        }


        ?>

        <!-- Student login form -->
        <form id="user-login-form" action="login.php" method="POST">
          <div class="header-text mb-4">
            <h1 style="color: #ff4b2b;">Hello User..!</h1>
            <p>Welcome to scheduleme app</p>
          </div>
          <!-- Hidden input for student login -->
          <input type="hidden" name="user_type" value="<?php echo UserType::Student; ?>">
          <!-- Hidden input for student login -->
          <div class="form-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email">
          </div>
          <div class="form-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password">
          </div>
          <div class="form-group mb-2 d-flex justify-content-between">
            <div class="form-check">
              <input type="checkbox" name="remember_me" class="form-check-input" id="formCheck">
              <label for="formCheck" class="foem-check-label text-secondary"><small>Remember Me</small></label>
            </div>
            <div class="forgot">
  <small><a href="#" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">Forgot Password?</a></small>
</div>
          </div>
          <div class="form-group mb-3">
            <button type="submit" name="student-login" class="btn btn-lg text-white w-100 fs-6 " style="background-color: #ff4b2b;">Login</button>
          </div>
          <div class="form-group mb-3">
            <button class="btn btn-lg btn-light w-100 fs-6"><img src="images/google_logo.png" style="width: 30px;" class="me-2"><small>Sign in with Google</small></button>
          </div>
          <div class="row d-flex">
            <small>Don't have account? <a href="registration.php">Sign up</a></small>
          </div>
        </form>
        <!-- User login form -->

        <!-- Admin login form -->
        <form id="admin-login-form" action="login.php" method="POST">
          <!-- Hidden input for student login -->
          <input type="hidden" name="user_type" value="<?php echo UserType::Admin; ?>">
          <!-- Hidden input for student login -->
          <div class="header-text mb-4">
            <h1 style="color: #ff4b2b;">Hello Admin..!</h1>
            <p>Welcome to scheduleme app</p>
          </div>
          <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="Admin Email">
          </div>
          <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Admin Password">
          </div>
          <div class="form-group mb-2 d-flex justify-content-between">
            <div class="form-check">
              <input type="checkbox" name="remember_me" class="form-check-input" id="formCheck">
              <label for="formCheck" class="foem-check-label text-secondary"><small>Remember Me</small></label>
            </div>
            <div class="forgot">
  <small><a href="#" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">Forgot Password?</a></small>
</div>
          </div>
          <div class="input-group mb-3">
            <button type="submit" name="admin-login" class="btn btn-lg text-white mt-5 w-100 fs-6" style="background-color: #ff4b2b;"> Admin
              Login</button>
          </div>
        </form>
        <!-- Admin login form -->
      </div>
    </div>
  </div>
</div>

<!-- Forgot Password Modal -->
<div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog d-flex align-items-center">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Forgot Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" placeholder="Enter your email">
          </div>
          <button type="button" class="btn btn-primary" onclick="sendResetLink()">Send Link</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!--log in-->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const toggle = document.querySelector('.toggle');
    const userLoginForm = document.getElementById('user-login-form');
    const adminLoginForm = document.getElementById('admin-login-form');
    const userTypeOne = document.querySelector('.user-type-one');
    const userTypeTwo = document.querySelector('.user-type-two');

    toggle.addEventListener('change', function() {
      if (toggle.checked) {
        userTypeOne.textContent = 'Administrator';
        userTypeTwo.textContent = 'Slide to Local user log in';
        userLoginForm.style.display = 'none';
        adminLoginForm.style.display = 'block';
      } else {
        userTypeOne.textContent = 'Student';
        userTypeTwo.textContent = 'Slide to Admin log in';
        adminLoginForm.style.display = 'none';
        userLoginForm.style.display = 'block';
      }
    });
  });
</script>


<script>
  function sendResetLink() {
    // Retrieve the email address entered by the user
    var email = document.getElementById("email").value;

    // You can perform additional validation here before showing the alert

    // Display an alert with a simulated reset link message
    alert("Reset link sent to " + email + " via G-mail. Check your email!");
    
    // Optionally, you can close the modal after showing the alert
    document.getElementById("forgotPasswordModal").modal('hide');
  }
</script>

<?php include "./templates/footer.php"; ?>

<?php
ob_end_flush(); // Flush the output buffer
?>