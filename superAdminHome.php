<?php
ob_start(); // Start output buffering
session_start();
require_once "utils/constants.php";

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Check if a remember user cookie exists
    if (isset($_COOKIE['remember_user_email'])) {
        // Automatically log in the user using the cookie information
        $_SESSION['loggedin'] = true;
        $_SESSION['userEmail'] = $_COOKIE['remember_user_email'];
        $_SESSION['userType'] = $_COOKIE['remember_user_type'];

        // Redirect to the dashboard
        header("Location: superAdminHome.php");
        exit();
    } else {
        // Redirect the user to the login page if not logged in and no remember user cookie
        header("Location: login.php");
        exit();
    }
}

include "./templates/header.php";
include "./superAdmin-components/superAdminNavbar.php";

?>

<div class="container userhome-body  mt-5 justify-content-center">
    <div class="tab-content mt-3">
        <?php include "superAdmin-components/superDashboard.php"; ?>
        <?php include "superAdmin-components/superManagements.php"; ?>
        <?php include "superAdmin-components/superSignup.php"; ?>
        <?php include "superAdmin-components/superNotification.php"; ?>
        <?php include "superAdmin-components/superProfile.php"; ?>
        <?php include "superAdmin-components/superEditor.php"; ?>
    </div>
</div>

<!-- Tab end -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<!-- close button code -->
<script>
    function closeDropdownButton() {
        $('.dropdown-menu a.dropdown-item.active').removeClass('active');
    }

    $(document).ready(function() {
        // Function to close the other tabs and open the specified tab
        function openTab(tabId) {
            // Remove 'show active' class from all tab panes
            $('.tab-pane').removeClass('show active');
            // Add 'show active' class to the specified tab
            $(tabId).addClass('show active');


        }

        // Handle click events for the tabs
        $('.nav-tabs .nav-link').click(function() {
            // Get the target tab ID from the href attribute
            var targetTabId = $(this).attr('href');
            // Open the clicked tab
            openTab(targetTabId);
        });

        $('#admindashboard-close-btn').click(function() {
            openTab('#admindashboard');
        });

        $('#adminstatus-close-btn').click(function() {
            openTab('#adminstatus');
        });

        $('#adminappointment-close-btn').click(function() {
            openTab('#adminappointment');
        });

        $('#adminannouncement-close-btn').click(function() {
            openTab('#adminannouncement');
        });

        $('#adminprofile-close-btn').click(function() {
            openTab('#adminprofile');
        });

        $('#adminedit-close-btn').click(function() {
            openTab('#adminedit');
        });
    });
</script>
<!-- End close button code -->


<!-- Fetch Deans , HOD and faculties dynamically  -->
<script>
    $(document).ready(function() {
        function fetchDeans() {
            $.ajax({
                url: 'utils/fetch_deans.php',
                method: 'GET',
                data: {
                    orderBy: 'first_name',
                    orderMethod: 'ASC'
                },
                success: function(data) {
                    $('#deanDropdown').empty();
                    $('#deanDropdown').append(`<option value="">Select a Dean</option>`);
                    data.forEach(dean => $('#deanDropdown').append(`<option value="${dean.id}">${dean.first_name} ${dean.last_name}</option>`));
                },
                error: function() {
                    console.error('Error fetching dean names.');
                }
            });
        }

        function fetchHODs() {
            $.ajax({
                url: 'utils/fetch_HODs.php',
                method: 'GET',
                data: {
                    orderBy: 'first_name',
                    orderMethod: 'ASC'
                },
                success: function(data) {
                    $('#HODDropdown').empty();
                    $('#HODDropdown').append(`<option value="">Select a HOD</option>`);
                    data.forEach(HOD => $('#HODDropdown').append(`<option value="${HOD.id}">${HOD.first_name} ${HOD.last_name}</option>`));
                },
                error: function() {
                    console.error('Error fetching HOD names.');
                }
            });
        }

        function fetchFaculties() {
            $.ajax({
                url: 'utils/fetch_faculties.php',
                method: 'GET',
                data: {
                    orderBy: 'name',
                    orderMethod: 'ASC'
                },
                success: function(data) {
                    $('#facultyDropdown').empty();
                    $('#facultyDropdown').append(`<option value="">Select a Faculty</option>`);
                    data.forEach(faculty => $('#facultyDropdown').append(`<option value="${faculty.id}">${faculty.name}</option>`));
                },
                error: function() {
                    console.error('Error fetching faculty names.');
                }
            });
        }

        // Handle Faculty form submission
        $('#facultyForm').submit(function(event) {
            event.preventDefault(); // Prevent default form submission

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(), // Serialize form data
                success: function(response) {
                    // Handle success response (if needed)
                    console.log('Faculty created successfully');
                    //reset form
                    fetchDeans();
                    $('#facultyName').val('');
                    // $('#deanDropdown').val('Select a Dean');


                },
                error: function() {
                    console.error('Error creating faculty.');
                    // Handle error cases
                }
            });
        });


        // Handle department form submission
        $('#departmentForm').submit(function(event) {
            event.preventDefault(); // Prevent default form submission

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(), // Serialize form data
                success: function(response) {
                    console.log('Department created successfully');
                    //reset form
                    fetchHODs();
                    fetchFaculties();
                    $('#departmentName').val('');
                    // $('#facultyDropdown').val('');
                    // $('#HODDropdown').val('');
                },
                error: function() {
                    console.error('Error creating department.');
                }
            });
        });





        // Fetch initial deans,HODs and faculties on page load
        fetchDeans();
        fetchHODs();
        fetchFaculties();

    });
</script>



<script>
    $(document).ready(function() {
        // Function to fetch and update data
        function fetchDataAndUpdateFacultyTable() {
            $.ajax({
                url: 'utils/fetch_faculties.php',
                method: 'GET',
                data: {
                    orderBy: 'updated_at',
                    orderMethod: 'DESC'
                },
                success: function(data) {
                    updateFacultyTable(data); // Function to update the table with the fetched data
                },
                error: function() {
                    console.error('Error fetching data.');
                }
            });
        }

        // Function to update the table with new data
        function updateFacultyTable(data) {
            var tableBody = $('#facultyTableBody');
            tableBody.empty();

            // Loop through the fetched data and append rows to the table
            data.forEach(item => {
                var row = '<tr>';
                // Assuming item properties correspond to table cells (adjust this according to your data structure)
                row += `<td>${item.name}</td>`;
                row += `<td>${item.dean}</td>`;
                row += `<td class="text-center">
                            <button class="btn btn-warning m-2" data-bs-toggle="modal" data-id="${item.id}" data-bs-target="#updateModal">Update</button>
                            <button class="btn btn-danger m-2 ml-4" data-bs-toggle="modal" data-id="${item.id}" data-bs-target="#deleteModal">Delete</button>
                        </td>`;
                row += '</tr>';
                tableBody.append(row);
            });
        }

        // Fetch and update data initially on page load
        fetchDataAndUpdateFacultyTable();

        // Set interval to periodically fetch and update data (every 5 seconds in this example)
        setInterval(fetchDataAndUpdateFacultyTable, 5000);
    });
</script>


<script>
    $(document).ready(function() {
        // Function to fetch and update data
        function fetchDataAndUpdateDepartmentTable() {
            $.ajax({
                url: 'utils/fetch_departments.php',
                method: 'GET',
                data: {
                    orderBy: 'updated_at',
                    orderMethod: 'DESC'
                },
                success: function(data) {
                    updateDepartmentTable(data); // Function to update the table with the fetched data
                },
                error: function() {
                    console.error('Error fetching data.');
                }
            });
        }

        // Function to update the table with new data
        function updateDepartmentTable(data) {
            var tableBody = $('#departmentTableBody');
            tableBody.empty();


            // Loop through the fetched data and append rows to the table
            data.forEach(department => {
                var row = '<tr>';
                // Assuming item properties correspond to table cells (adjust this according to your data structure)
                row += `<td>${department.name}</td>`;
                row += `<td>${department.faculty_name}</td>`;
                row += `<td>${department.HOD_name}</td>`;
                row += `<td class="text-center">
                            <button class="btn btn-warning m-2" data-bs-toggle="modal" data-id="${department.id}" data-bs-target="#updateModalDepartment">Update</button>
                            <button class="btn btn-danger m-2 ml-4" data-bs-toggle="modal" data-id="${department.id}" data-bs-target="#deleteModalDepartment">Delete</button>
                        </td>`;
                row += '</tr>';
                tableBody.append(row);
            });

        }

        // Fetch and update data initially on page load
        fetchDataAndUpdateDepartmentTable();

        // Set interval to periodically fetch and update data (every 5 seconds in this example)
        setInterval(fetchDataAndUpdateDepartmentTable, 5000);
    });
</script>


<!-- Update & Delete Faculty -->
<script>
    $(document).ready(function() {

        function fetchFaculties() {
            $.ajax({
                url: 'utils/fetch_faculties.php',
                method: 'GET',
                data: {
                    orderBy: 'name',
                    orderMethod: 'ASC'
                },
                success: function(data) {
                    $('#facultyDropdown').empty();
                    $('#facultyDropdown').append(`<option value="">Select a Faculty</option>`);
                    data.forEach(faculty => $('#facultyDropdown').append(`<option value="${faculty.id}">${faculty.name}</option>`));
                },
                error: function() {
                    console.error('Error fetching faculty names.');
                }
            });
        }

        function fetchDeans() {
            $.ajax({
                url: 'utils/fetch_deans.php',
                method: 'GET',
                data: {
                    orderBy: 'first_name',
                    orderMethod: 'ASC'
                },
                success: function(data) {
                    $('#deanDropdownUpdate').empty();
                    $('#deanDropdownUpdate').append(`<option value="">Select a Dean</option>`);
                    data.forEach(dean => $('#deanDropdownUpdate').append(`<option value="${dean.id}">${dean.first_name} ${dean.last_name}</option>`));
                },
                error: function() {
                    console.error('Error fetching dean names.');
                }
            });
        }



        $('#updateModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');

            fetchDeans();

            $.ajax({
                url: 'utils/fetch_faculty_data.php',
                method: 'GET',
                data: {
                    id: id
                },
                success: function(data) {
                    $('#facultyIdUpdate').val(data.id);
                    $('#facultyNameUpdate').val(data.name);
                    $('#deanDropdownUpdate').val(data.dean_ID);
                },
                error: function() {
                    console.error('Error fetching data.');
                }
            });
        });

        $('#updateForm').submit(function(event) {
            event.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    $('#updateModal').modal('hide');
                    fetchFaculties(); //refresh data

                },
                error: function() {
                    console.error('Error updating data.');
                }
            });
        });

        // handle deletion confirmation and action
        $('#deleteModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');

            $.ajax({
                url: 'utils/fetch_faculty_data.php',
                method: 'GET',
                data: {
                    id: id
                },
                success: function(data) {
                    $('#deleteFacultyName').text(data.name);
                },
                error: function() {
                    console.error('Error fetching data.');
                }
            });

            $('#confirmDeleteBtn').on('click', function() {

                $.ajax({
                    url: 'utils/delete_faculty.php?id=' + id,
                    method: 'DELETE',
                    success: function(data) {
                        $('#deleteModal').modal('hide'); // Close the modal
                        fetchFaculties(); //refresh data
                    },
                    error: function(xhr, status, error) {
                        console.error('Error deleting faculty:', error);
                    }
                });
            });


        });

    });
</script>
<!-- End Update & Delete Faculty -->






<!-- Update & Delete Department -->
<script>
    $(document).ready(function() {

        function fetchHODs() {
            $.ajax({
                url: 'utils/fetch_HODs.php',
                method: 'GET',
                data: {
                    orderBy: 'first_name',
                    orderMethod: 'ASC'
                },
                success: function(data) {
                    $('#HODDropdownUpdate').empty();
                    $('#HODDropdownUpdate').append(`<option value="">Select a HOD</option>`);
                    data.forEach(HOD => $('#HODDropdownUpdate').append(`<option value="${HOD.id}">${HOD.first_name} ${HOD.last_name}</option>`));
                },
                error: function() {
                    console.error('Error fetching HOD names.');
                }
            });
        }

        function fetchfacultiess() {
            $.ajax({
                url: 'utils/fetch_faculties.php',
                method: 'GET',
                data: {
                    orderBy: 'name',
                    orderMethod: 'ASC'
                },
                success: function(data) {
                    $('#facultyDropdownUpdate').empty();
                    $('#facultyDropdownUpdate').append(`<option value="">Select a Faculty</option>`);
                    data.forEach(faculty => $('#facultyDropdownUpdate').append(`<option value="${faculty.id}">${faculty.name}</option>`));
                },
                error: function() {
                    console.error('Error fetching faculties.');
                }
            });
        }



        $('#updateModalDepartment').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');


            fetchHODs();
            fetchfacultiess();

            $.ajax({
                url: 'utils/fetch_department_data.php',
                method: 'GET',
                data: {
                    id: id
                },
                success: function(data) {
                    $('#departmentIdUpdate').val(data.id);
                    $('#departmentNameUpdate').val(data.name);
                    $('#HODDropdownUpdate').val(data.HOD_ID);
                    $('#FacultyDropdownUpdate').val(data.faculty_ID);
                },
                error: function() {
                    console.error('Error fetching data.');
                }
            });
        });

        $('#updateFormDepartment').submit(function(event) {
            event.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    $('#updateModalDepartment').modal('hide');
                },
                error: function() {
                    console.error('Error updating data.');
                }
            });
        });

        // handle deletion confirmation and action
        $('#deleteModalDepartment').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');

            $.ajax({
                url: 'utils/fetch_department_data.php',
                method: 'GET',
                data: {
                    id: id
                },
                success: function(data) {
                    $('#deleteDepartmentName').text(data.name);
                },
                error: function() {
                    console.error('Error fetching data.');
                }
            });

            $('#confirmDeleteBtnDepartment').on('click', function() {

                $.ajax({
                    url: 'utils/delete_department.php?id=' + id,
                    method: 'DELETE',
                    success: function(data) {
                        console.log(data);
                        $('#deleteModalDepartment').modal('hide'); // Close the modal
                    },
                    error: function(xhr, status, error) {
                        console.error('Error deleting department:', error);
                    }
                });
            });


        });

    });
</script>
<!-- End Update & Delete Department -->


<!-- Create Admin -->
<script>
    $(document).ready(function() {

        function fetchFacultiesAdmin() {
            $.ajax({
                url: 'utils/fetch_faculties.php',
                method: 'GET',
                data: {
                    orderBy: 'name',
                    orderMethod: 'ASC'
                },
                success: function(data) {

                    if (data.length === 0) {
                        $('#facultyDropdownAdmin').empty();
                        $('#facultyDropdownAdmin').append(`<option value="">No Faculty Available</option>`);
                    } else {
                        $('#facultyDropdownAdmin').empty();
                        $('#facultyDropdownAdmin').append(`<option value="">Select a Faculty</option>`);
                        data.forEach(faculty => $('#facultyDropdownAdmin').append(`<option value="${faculty.id}">${faculty.name}</option>`));
                    }
                },
                error: function() {
                    console.error('Error fetching faculty names.');
                }
            });
        }

        function fetchDepartmentsAdmin(selectedFaculty) {
            $.ajax({
                url: 'utils/fetch_departments.php',
                method: 'GET',
                data: {
                    orderBy: 'name',
                    orderMethod: 'ASC',
                    whereBy: 'faculty_id',
                    whereValue: selectedFaculty

                },
                success: function(data) {
                    if (data.length === 0) {
                        $('#departmentDropdownAdmin').empty();
                        $('#departmentDropdownAdmin').append(`<option value="">No Department Available</option>`);
                        $('#departmentDropdownAdmin').prop('disabled', true);
                    } else {
                        $('#departmentDropdownAdmin').prop('disabled', false);
                        $('#departmentDropdownAdmin').empty();
                        $('#departmentDropdownAdmin').append(`<option value="">Select the appropriate Department</option>`);
                        data.forEach(department => $('#departmentDropdownAdmin').append(`<option value="${department.id}">${department.name}</option>`));
                    }

                },
                error: function() {
                    console.error('Error fetching faculty names.');
                }
            });
        }



        $('#facultyDropdownAdmin').change(function() {
            const selectedFacultyAdmin = $(this).val();
            fetchDepartmentsAdmin(selectedFacultyAdmin);
        });

        function fetchProfessionsAdmin() {
            $.ajax({
                url: 'utils/fetch_professions.php',
                method: 'GET',
                success: function(data) {
                    if (data.length === 0) {
                        $('#professionDropdownAdmin').append(`<option value="">No Profession Available</option>`);
                    } else {
                        data.forEach(profession => $('#professionDropdownAdmin').append(`<option value="${profession.id}">${profession.name}</option>`));
                    }
                },
                error: function() {
                    console.error('Error fetching faculty names.');
                }
            });
        }

        // Fetch initial faculties on page load
        fetchFacultiesAdmin();
        fetchProfessionsAdmin();



        $('#adminRegisterForm').submit(function(event) {
            event.preventDefault(); // Prevent default form submission


            // Store form element reference
            const form = $(this);

            const firstName = form.find('input[name="first_name"]').val();
            const lastName = form.find('input[name="last_name"]').val();
            const professionId = form.find('select[name="profession"]').val();
            var professionName = "";

            $.ajax({
                url: 'utils/fetch_profession_data.php',
                method: 'GET',
                data: {
                    id: professionId
                },
                success: function(data) {
                    professionName = data.name;
                },
                error: function() {
                    console.error('Error fetching data.');
                }
            });
 
            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: form.serialize(), // Serialize form data
                dataType: 'json',
                success: function(response) {
                    const modalBody = document.getElementById('modalBody');

                    if (response.status === 'success') {
                        modalBody.innerHTML = `<p class="text-success">"<b>${firstName} ${lastName}</b>" added as "${professionName}"</p>`;
                        // Reset the form
                        form[0].reset();
                    } else {
                        modalBody.innerHTML = `<p class="text-danger">${response.message}</p>`;
                    }

                    const responseModal = new bootstrap.Modal(document.getElementById('responseModal'));
                    responseModal.show();


                },
                error: function(err) {
                    console.error('Error creating admin.');
                }
            });

        });
    });
</script>


 <!-- Dashboard -->
<script>
    const xValues = ["Active", "Inactive", "Pending"];
    const yValues = [2, 5, 7];
    const backgroundColors = ["#32CD32", "#FF0000", "#FFD700"];
    const borderColors = ["#32CD32", "#FF0000", "#FFD700"];

    new Chart("myChartToday", {
        type: "doughnut",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: backgroundColors,
                borderColor: borderColors,
                data: yValues
            }]
        },
        options: {
            title: {
                display: true,
                text: "Today Students"
            },
            legend: {
                position: 'right', // Set the legend position to 'right'
            }
        }
    });
</script>

<script>
    const xValue = ["Active", "Inactive", "Pending"];
    const yValue = [23, 13, 10];
    const backgroundColor = ["#32CD32", "#FF0000", "#FFD700"];
    const borderColor = ["#32CD32", "#FF0000", "#FFD700"];

    new Chart("myChartMonthly", {
        type: "doughnut",
        data: {
            labels: xValue,
            datasets: [{
                backgroundColor: backgroundColor,
                borderColor: borderColor,
                data: yValue
            }]
        },
        options: {
            title: {
                display: true,
                text: "Total Admins"
            },
            legend: {
                position: 'right', // Set the legend position to 'right'
            }
        }
    });
</script>










<?php include "./templates/footer.php"; ?>

<?php
ob_end_flush(); // Flush the output buffer
?>