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



<div class="tab-pane fade" id="adminedit">
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
                        $phone_num = $_POST["phone_num"];
                        $gender = $_POST["gender"];
                        $facultyId = $_POST["faculty"];
                        $departmentId = $_POST["department"];
                        $contactEmail = $_POST["contact_email"];


                        // Update the user details in the database
                        $updateSql = "UPDATE staffs SET
                            first_name = '$first_name',
                            last_name = '$last_name',
                            phone_number = '$phone_num',
                            gender = '$gender',
                            faculty_id = '$facultyId',  
                            department_id = '$departmentId',
                            contact_email = '$contactEmail' 
                            WHERE email = '" . $_SESSION['userEmail'] . "'";

                        $updateResult = mysqli_query($conn, $updateSql);

                        if ($updateResult) {
                            // Success: Redirect or display a success message
                            header("Location: adminHome.php");
                            // exit();
                        } else {
                            $message = "Error: " . mysqli_error($conn);
                            echo $message;
                        }

                    }

                    ?>


                    <form id="user-update-form" class="h5" method="POST" >

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
                            <label class="form-label">Contact Email:</label>
                            <input type="email" class="form-control" name="contact_email" placeholder="Email Address"
                                value="<?php echo $currentUser['contact_email'] ?>" required>
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
    $(document).ready(function() {
        function fetchFaculties() {
            $.ajax({
                url: 'utils/fetch_faculties.php',
                method: 'GET',
                success: function(data) {
                    $('#facultyDropdown').empty(); // Clear existing options
                    $('#facultyDropdown').append(`<option value="">Select a Faculty</option>`);
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
                    $('#departmentDropdown').append(`<option value="">Select a Department</option>`)
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
