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
        header("Location: adminHome.php");
        exit();
    } else {
        // Redirect the user to the login page if not logged in and no remember user cookie
        header("Location: login.php");
        exit();
    }
}

include "./templates/header.php";
include "./admin-components/adminNavbar.php";

?>

<div class="container userhome-body  mt-5 justify-content-center">
    <div class="tab-content mt-3">
        <?php include "admin-components/adminDashboard.php"; ?>
        <?php include "admin-components/adminStatus.php"; ?>
        <?php include "admin-components/adminAppointment.php"; ?>
        <?php include "admin-components/adminAnnouncement.php"; ?>
        <?php include "admin-components/adminProfile.php"; ?>
        <?php include "admin-components/adminEditor.php"; ?>
    </div>
</div>

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


<script>
    // Initialize Select2 with search and multiple selection
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2({
            placeholder: 'Search and select target audience',
            allowClear: true,
            closeOnSelect: false
        });
    });
</script>

<script>
    function updateBackgroundColor(selectId) {
        var selectElement = document.getElementById(selectId);
        var backgroundColor = '';

        switch (selectElement.value) {
            case 'Yes':
                backgroundColor = 'lightgreen';
                break;
            case 'No':
                backgroundColor = 'red';
                break;

        }

        selectElement.style.backgroundColor = backgroundColor;
    }

    // Add event listeners for all select elements
    var selectIds = [
        'status_08_30_09_30',
        'status_09_30_10_30',
        'status_10_30_11_30',
        'status_11_30_12_30',
        'status_12_30_13_30',
        'status_13_30_14_30',
        'status_14_30_15_30',
        'status_15_30_16_30',
        'tstatus_08_30_09_30',
        'tstatus_09_30_10_30',
        'tstatus_10_30_11_30',
        'tstatus_11_30_12_30',
        'tstatus_12_30_13_30',
        'tstatus_13_30_14_30',
        'tstatus_14_30_15_30',
        'tstatus_15_30_16_30'
    ];

    selectIds.forEach(function(selectId) {
        var selectElement = document.getElementById(selectId);
        if (selectElement) {
            selectElement.addEventListener('change', function() {
                updateBackgroundColor(selectId);
            });
        }
    });
</script>


<!-- Tab end -->


<!-- Admin Status Fetch & Update Control -->
<script>
    $(document).ready(function() {

        function updateSelectColor(selectId, value) {
            const selectElement = $(selectId);
            if (value === '1') {
                selectElement.removeClass('text-danger').addClass('text-success');
            } else {
                selectElement.removeClass('text-success').addClass('text-danger');
            }
        }

        function fetchStaffAvailableTime(selectedStaffId, selectedDate) {
            $.ajax({
                url: 'utils/fetch_staff_available_time_data.php',
                method: 'GET',
                data: {
                    staff_id: selectedStaffId,
                    available_date: selectedDate
                },
                dataType: 'json',
                success: function(result) {


                    // Reset all values to '0'
                    var timeIDs = ['#time_0830', '#time_0930', '#time_1030', '#time_1130', '#time_1230', '#time_1330', '#time_1430', '#time_1530'];

                    timeIDs.forEach(function(id) {
                        //Enable
                        $(id).prop('disabled', false);
                        if ($(id).val() === '1') {
                            $(id).val('0').removeClass('text-success').addClass('text-danger');
                        }
                    });


                    // Check if there is a result and update values accordingly
                    if (!(Object.keys(result).length === 0)) {

                        //set value from response 
                        timeIDs.forEach(function(id) {

                            //Enable
                            $(id).prop('disabled', false);

                            if (parseInt(result[id.substring(1)]) === 1) {
                                $(id).val('1').removeClass('text-danger').addClass('text-success');
                            } else {
                                $(id).val('0').removeClass('text-success').addClass('text-danger');
                            }
                        });
                        $('#availableSetStatus').html(`<span class="text-success">Updated</span>`)


                    } else {

                        $('#availableSetStatus').html(`<span class="text-danger">Not Updated !</span>`)

                    }


                },
                error: function() {
                    console.error('Error fetching staff available time.');
                }
            });
        }

        // Event listener for changing select elements
        var timeIDs = ['#time_0830', '#time_0930', '#time_1030', '#time_1130', '#time_1230', '#time_1330', '#time_1430', '#time_1530'];

        timeIDs.forEach(function(id) {
            $(id).change(function() {
                const value = $(this).val();
                updateSelectColor('#' + this.id, value);
            });
        });

        $('#today_tomorrow').change(function() {
            const today_tomorrow = $(this).val();
            if (!(today_tomorrow === '')) {
                const selectedStaffId = <?php echo $_SESSION['userId'] ?>;
                var selectedDate;



                if (today_tomorrow == "Today") {
                    selectedDate = new Date(new Date().getTime() + 5.5 * 60 * 60 * 1000).toISOString().slice(0, 10);
                } else if (today_tomorrow == "Tomorrow") {
                    selectedDate = new Date(new Date().getTime() + (24 + 5.5) * 60 * 60 * 1000).toISOString().slice(0, 10);
                }
                fetchStaffAvailableTime(selectedStaffId, selectedDate);
            } else {

                // Reset all values to '0'
                var timeIDs = ['#time_0830', '#time_0930', '#time_1030', '#time_1130', '#time_1230', '#time_1330', '#time_1430', '#time_1530'];

                timeIDs.forEach(function(id) {
                    if ($(id).val() === '1') {
                        $(id).val('0').removeClass('text-success').addClass('text-danger');
                    }
                    //disable
                    $(id).prop('disabled', true);
                });
                $('#availableSetStatus').html(`<span class="text-danger">Not Available !</span>`)
            }
        });
    });
</script>
<!-- End Admin Status Fetch &  Update Control -->


<!-- Set staff_available_time -->
<script>
    $(document).ready(function() {

        $('#staffAvailableTimeForm').submit(function(event) {
            event.preventDefault(); // Prevent default form submission

            var staffId = "<?php echo $_SESSION['userId']; ?>";
            $('#staff_id').val(staffId); // Set staff_id value

            // Store form element reference
            const form = $('#staffAvailableTimeForm');

            const today_tomorrow = $('#today_tomorrow').val();
            console.log("today_tomorrow date : ", today_tomorrow);

            if (today_tomorrow == "Today") {
                selectedDate = new Date(new Date().getTime() + 5.5 * 60 * 60 * 1000).toISOString().slice(0, 10);
            } else if (today_tomorrow == "Tomorrow") {
                selectedDate = new Date(new Date().getTime() + (24 + 5.5) * 60 * 60 * 1000).toISOString().slice(0, 10);
            }

            console.log("selected date : ", selectedDate);

            var extraData = {
                date: selectedDate
            };

            $.ajax({
                url: form.attr('action'),
                method: form.attr('method'),
                data: form.serialize() + '&' + $.param(extraData), // Append extra data to form data
                success: function(response) {
                    console.log(response.message);
                    // reset form
                    // Reset all values to '0'
                    var timeIDs = ['#time_0830', '#time_0930', '#time_1030', '#time_1130', '#time_1230', '#time_1330', '#time_1430', '#time_1530'];

                    timeIDs.forEach(function(id) {
                        if ($(id).val() === '1') {
                            $(id).val('0').removeClass('text-success').addClass('text-danger');
                        }
                        //disable
                        $(id).prop('disabled', true);
                    });
                    // reset form
                    form[0].reset();
                },
                error: function() {
                    console.error('Error inserting staff_available_time.');
                }
            });

        });
    });
</script>





<!-- View Appointments -->
<script id="moreLessButtonCode">

</script>

<script>
    $(document).ready(function() {

        var staffId; //varibale for holding staff id

        // Function to fetch and show data
        function fetchDataAndUpdateAppointmentView() {

            var staffEmail = "<?php echo $_SESSION['userEmail']; ?>";
            var Pending = "<?php echo MeetingStatus::Pending ?>"
            $.ajax({
                url: 'utils/fetch_staff_data.php',
                method: 'GET',
                data: {
                    whereBy: 'email',
                    whereValue: staffEmail
                },
                success: function(data) {
                    staffId = data.id; // Set staff_id value
                    $.ajax({
                        url: 'utils/fetch_user_meetings.php',
                        method: 'GET',
                        data: {
                            orderBy: 'created_at',
                            orderMethod: 'DESC',
                            whereBy: 'staff_id',
                            whereValue: staffId,
                            status: Pending
                        },
                        success: function(data) {
                            updateAppointmentView(data); // Function to update Appointment view with the fetched data
                        },
                        error: function() {
                            console.error('Error fetching data.');
                        }
                    });

                },
                error: function() {
                    console.error('Error fetching staff details');
                }
            });




        }


        // Function to handle the "More" and "Less" buttons
        function toggleMoreLessButtons(meetingId) {
            $('#moreBtn-' + meetingId).on('click', function() {
                $('#moreBtn-' + meetingId).addClass('collapse');
                $('#lessBtn-' + meetingId).removeClass('collapse');
            });

            $('#lessBtn-' + meetingId).on('click', function() {
                $('#moreBtn-' + meetingId).removeClass('collapse');
                $('#lessBtn-' + meetingId).addClass('collapse');
            });
        }

        // Function to update the table with new data
        function updateAppointmentView(data) {
            var appoinmentViewDiv = $('#appointmentView');
            var moreLessButtonCode = $('#moreLessButtonCode');
            appoinmentViewDiv.empty();



            // Loop through the fetched data and append rows to the table
            data.forEach(meeting => {

                // Action Buttons
                const collapseId = `meetingDetails-${meeting.meeting_id}`; // Unique ID for each collapse element


                var row = `<div class="d-flex justify-content-center align-items-center rounded-4 mb-5 mt-5" style="border: 2px solid black; padding: 10px; margin-bottom: 10px; background-color: white;">
                            <div class="row" id="meeting">
                                <div class="d-flex justify-content-between">
                             
                                    <div class="mt-3 fw-bold">
                                        <div class="ms-2 ">Name : <span class="fw-bold text-primary">${meeting.student_name}</span ></div>
                                        <div class="ms-2 ">Reg_num : <span class="fw-bold text-primary">${meeting.student_reg_num}</span ></div>
                                        <div class="ms-2 ">Year of Study : <span class="fw-bold text-primary">${meeting.student_year_of_study}</span ></div>
                                       
                                    </div>
                                    <div class="mt-3 fw-bold">
                                        <div >Date: <span class="text-primary">${meeting.meeting_pref_date}</span></div>
                                        <div >Time: <span class="text-primary">${meeting.meeting_pref_time}</span></div>
                                            
                                        </p>
                                    </div>
                                    </div>
                                    
                                <!-- </div> -->




                                <div class="col-12 border-bottom border-primary p-2 mb-3">
                                    <h2 class="text-center fw-bold">${meeting.meeting_heading}</h2>
                                </div>
                                <div class="col-12">
                                    <h5 class="fw-bold">Meeting purpose:-</h5>
                                    <p class="px-4">${meeting.meeting_heading}</p>
                                </div>

                                <!-- Collapsible Meeting Details -->
                                <div class="collapse" id="meetingDetails-${meeting.meeting_id}">
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="fw-bold">Meeting Outline:-</h5>
                                            <p class="px-4">${meeting.meeting_outline}</p>
                                        </div>
                                        <div class="col-12">
                                            <h5 class="fw-bold">Additional Information:-</h5>
                                            <p class="px-4">${meeting.meeting_add_info}</p>
                                        </div>
                                        <div class="col-12 mb-4">
                                            <Span class="h5 fw-bold">Attachment : </Span>
                                            <!-- Add your PGF file content or link here -->`;

                if (meeting.meeting_file_data_exist) {
                    row += `<a href="utils/fetch_meeting_attachment.php?id=${meeting.meeting_id}" download="${meeting.meeting_filename}">${meeting.meeting_filename}</a>`;

                } else {
                    row += `<span class="text-danger">No attachment</span>`;
                }

                row += `</div>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="row">
                                    <div class="col-4">
                                        <button class="btn btn-success w-100"data-bs-toggle="modal" data-id="${meeting.meeting_id}" data-bs-target="#acceptMeetingModal">Accept</button>
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-danger w-100" data-bs-toggle="modal" data-id="${meeting.meeting_id}" data-bs-target="#rejectMeetingModal">Reject</button>
                                        
                                    </div>


                                    <div class="col-4">
                                        <!-- "More" button is now used for collapsing, so you may choose a different label if needed -->
                                        <div class="d-grid gap-2">
                                            <!-- "More" button -->
                                            <button id="moreBtn-${meeting.meeting_id}" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#${collapseId}" aria-expanded="false" aria-controls="${collapseId}">More</button>
                                            
                                            <!-- "Less" button -->
                                            <button id="lessBtn-${meeting.meeting_id}" class="btn btn-primary collapse" data-bs-toggle="collapse" data-bs-target="#${collapseId}" aria-expanded="false" aria-controls="${collapseId}">Less</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>`;

                appoinmentViewDiv.append(row);
                toggleMoreLessButtons(meeting.meeting_id); // Call the toggle function
            });

        }

        // Fetch and update data initially on page load
        fetchDataAndUpdateAppointmentView();

        // Set interval to periodically fetch and update data (every 5 seconds in this example)
        setInterval(fetchDataAndUpdateAppointmentView, 5000);
    });
</script>

<script>
    $(document).ready(function() {
        //Handle approve
        $('#acceptMeetingModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');

            const Approved = "<?php echo MeetingStatus::Approved; ?>";

            $.ajax({
                url: 'utils/update_meeting_status.php',
                method: 'POST',
                data: {
                    id: id,
                    status: Approved
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        $('#acceptMeetingModalBody').html(`<p class="text-success">Meeting is <b>"${Approved}"</b> successfully</p>`);
                    } else {
                        $('#acceptMeetingModalBody').html(`<p class="text-success">${response.message}</p>`);
                    }
                    //refresh the fetch data
                    fetchDataAndUpdateAppointmentView();
                },
                error: function() {
                    console.error('Error updating meeting status.');
                }
            });
        });



        //Handle Reject Meeting
        $('#rejectMeetingModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            const Rejected = "<?php echo MeetingStatus::Rejected; ?>";

            // Set value for hidden Input for ID
            $('#meetingRejectId').val(id);
            $('#meetingRejectStatus').val(Rejected);

            $('#rejectMeetingForm').submit(function(event) {
                event.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#rejectMeetingModal').modal('hide'); // Hide modal on success
                        //refresh the fetch data
                        fetchDataAndUpdateAppointmentView();
                    },
                    error: function() {
                        console.error('Error updating meeting status.');
                    }
                });
            });
        });






    });
</script>



<!-- Admin Dashboard meeting_status_count -->

<!-- Dashoboard - Today Appointment View -->
<script>
    $(document).ready(function() {
        const myChartToday = new Chart("myChartToday", {
            type: "doughnut",
            data: {
                labels: ['No data'],
                datasets: [{
                    backgroundColor: ['#000000'],
                    borderColor: ['#000000'],
                    data: [0]
                }]
            },
            options: {
                title: {
                    display: true,
                    text: "Today Appointments"
                },
                legend: {
                    position: 'right',
                }
            }
        });

        function fetchAndUpdateMeetingStatusToday() {
            var staffEmail = "<?php echo $_SESSION['userEmail']; ?>";

            $.ajax({
                url: 'utils/fetch_staff_data.php',
                method: 'GET',
                data: {
                    whereBy: 'email',
                    whereValue: staffEmail
                },
                success: function(staff) {
                    const todayDate = new Date();
                    const formattedTodayDate = `${todayDate.getFullYear()}-${String(todayDate.getMonth() + 1).padStart(2, '0')}-${String(todayDate.getDate()).padStart(2, '0')}`;

                    $.ajax({
                        url: 'utils/fetch_user_meeting_status_count.php',
                        method: 'GET',
                        data: {
                            whereBy: 'staff_id',
                            whereValue: staff.id,
                            date: formattedTodayDate
                        },
                        success: function(statusData) {
                            if (Array.isArray(statusData) && statusData.length > 0) {
                                const xValues = statusData.map(meeting => `${meeting.status}: ${meeting.status_count}`);
                                const yValues = statusData.map(meeting => parseInt(meeting.status_count));


                                function getColor(status) {
                                    switch (status) {
                                        // Assuming these are constants or defined values
                                        case '<?php echo MeetingStatus::Approved ?>':
                                            return {
                                                backgroundColor: '#32CD32', borderColor: '#32CD32'
                                            };
                                        case '<?php echo MeetingStatus::Pending ?>':
                                            return {
                                                backgroundColor: '#FFD700', borderColor: '#FFD700'
                                            };
                                        case '<?php echo MeetingStatus::Rejected ?>':
                                            return {
                                                backgroundColor: '#FF0000', borderColor: '#FF0000'
                                            };
                                        default:
                                            return {
                                                backgroundColor: '#000000', borderColor: '#000000'
                                            };
                                    }
                                }

                                const colors = xValues.map(status => getColor(status.split(':')[0]));
                                const backgroundColors = colors.map(color => color.backgroundColor);
                                const borderColors = colors.map(color => color.borderColor);

                                myChartToday.data.labels = xValues;
                                myChartToday.data.datasets[0].data = yValues;
                                myChartToday.data.datasets[0].backgroundColor = backgroundColors;
                                myChartToday.data.datasets[0].borderColor = borderColors;

                                myChartToday.update(); // Update the chart with new data
                            } else {
                                // Handle empty or no data scenario
                                myChartToday.data.labels = ['No data'];
                                myChartToday.data.datasets[0].data = [0];
                                myChartToday.data.datasets[0].backgroundColor = ['#000000'];
                                myChartToday.data.datasets[0].borderColor = ['#000000'];
                                myChartToday.update(); // Update the chart
                            }
                        },
                        error: function() {
                            console.error('Error fetching meeting status details');
                        }
                    });
                },
                error: function() {
                    console.error('Error fetching staff details');
                }
            });
        }

        // Fetch and update data initially on page load
        fetchAndUpdateMeetingStatusToday();

        // Set interval to periodically fetch and update data (every 5 seconds in this example)
        setInterval(fetchAndUpdateMeetingStatusToday, 5000);
    });
</script>
<!-- End Dashoboard - Today Appointment View -->

<!-- Dashoboard - Total Appointment View -->
<script>
    $(document).ready(function() {
        const myChartTotal = new Chart("myChartTotal", {
            type: "doughnut",
            data: {
                labels: ['No data'],
                datasets: [{
                    backgroundColor: ['#000000'],
                    borderColor: ['#000000'],
                    data: [0]
                }]
            },
            options: {
                title: {
                    display: true,
                    text: "Total Appointments"
                },
                legend: {
                    position: 'right',
                }
            }
        });

        function fetchAndUpdateMeetingStatusTotal() {
            var staffEmail = "<?php echo $_SESSION['userEmail']; ?>";

            $.ajax({
                url: 'utils/fetch_staff_data.php',
                method: 'GET',
                data: {
                    whereBy: 'email',
                    whereValue: staffEmail
                },
                success: function(staff) {
                    const todayDate = new Date();
                    const formattedTodayDate = `${todayDate.getFullYear()}-${String(todayDate.getMonth() + 1).padStart(2, '0')}-${String(todayDate.getDate()).padStart(2, '0')}`;

                    $.ajax({
                        url: 'utils/fetch_user_meeting_status_count.php',
                        method: 'GET',
                        data: {
                            whereBy: 'staff_id',
                            whereValue: staff.id
                        },
                        success: function(statusData) {
                            if (Array.isArray(statusData) && statusData.length > 0) {
                                const xValues = statusData.map(meeting => `${meeting.status}: ${meeting.status_count}`);
                                const yValues = statusData.map(meeting => parseInt(meeting.status_count));


                                function getColor(status) {
                                    switch (status) {
                                        // Assuming these are constants or defined values
                                        case '<?php echo MeetingStatus::Approved ?>':
                                            return {
                                                backgroundColor: '#32CD32', borderColor: '#32CD32'
                                            };
                                        case '<?php echo MeetingStatus::Pending ?>':
                                            return {
                                                backgroundColor: '#FFD700', borderColor: '#FFD700'
                                            };
                                        case '<?php echo MeetingStatus::Rejected ?>':
                                            return {
                                                backgroundColor: '#FF0000', borderColor: '#FF0000'
                                            };
                                        default:
                                            return {
                                                backgroundColor: '#000000', borderColor: '#000000'
                                            };
                                    }
                                }

                                const colors = xValues.map(status => getColor(status.split(':')[0]));
                                const backgroundColors = colors.map(color => color.backgroundColor);
                                const borderColors = colors.map(color => color.borderColor);

                                myChartTotal.data.labels = xValues;
                                myChartTotal.data.datasets[0].data = yValues;
                                myChartTotal.data.datasets[0].backgroundColor = backgroundColors;
                                myChartTotal.data.datasets[0].borderColor = borderColors;

                                myChartTotal.update(); // Update the chart with new data
                            } else {
                                // Handle empty or no data scenario
                                console.log('Status data is empty.');
                                myChartTotal.data.labels = ['No data'];
                                myChartTotal.data.datasets[0].data = [0];
                                myChartTotal.data.datasets[0].backgroundColor = ['#000000'];
                                myChartTotal.data.datasets[0].borderColor = ['#000000'];
                                myChartTotal.update(); // Update the chart
                            }
                        },
                        error: function() {
                            console.error('Error fetching meeting status details');
                        }
                    });
                },
                error: function() {
                    console.error('Error fetching staff details');
                }
            });
        }

        // Fetch and update data initially on page load
        fetchAndUpdateMeetingStatusTotal();

        // Set interval to periodically fetch and update data (every 5 seconds in this example)
        setInterval(fetchAndUpdateMeetingStatusTotal, 5000);
    });
</script>
<!-- End Dashoboard - Total Appointment View -->

<!-- Dashboard Accepet/Reject Meeting -->
<script>
    $(document).ready(function() {

        var staffId; //varibale for holding staff id

        // Function to fetch and show data
        function fetchDataAndUpdateUserMeetings() {

            var staffEmail = "<?php echo $_SESSION['userEmail']; ?>";
            $.ajax({
                url: 'utils/fetch_staff_data.php',
                method: 'GET',
                data: {
                    whereBy: 'email',
                    whereValue: staffEmail
                },
                success: function(data) {
                    staffId = data.id; // Set student_id value
                    $('#welcomeUserName').text(data.first_name + " " + data.last_name);
                    $('#profileUserName').text(data.first_name + " " + data.last_name);
                    $.ajax({
                        url: 'utils/fetch_user_meetings.php',
                        method: 'GET',
                        data: {
                            orderBy: 'updated_at',
                            orderMethod: 'DESC',
                            whereBy: 'staff_id',
                            whereValue: staffId
                        },
                        success: function(data) {
                            updateUserMeetings(data); // Function to update Appointment view with the fetched data
                        },
                        error: function() {
                            console.error('Error fetching data.');
                        }
                    });

                },
                error: function() {
                    console.error('Error fetching staff details');
                }
            });

        }



        // Function to update the table with new data
        function updateUserMeetings(data) {
            var approvedMeetingTableBody = $('#approvedMeetingTableBody');
            var rejectedMeetingTableBody = $('#rejectedMeetingTableBody');
            approvedMeetingTableBody.empty();
            rejectedMeetingTableBody.empty();



            // Loop through the fetched data and append rows to the table
            data.forEach(meeting => {

                var row = `<tr rowspan="2">
                                <td class="bordered border">
                                    <button type="button" class="btn btn-sm ml-2 mb-2" data-bs-toggle="modal" data-id="${meeting.meeting_id}" data-bs-target="#detailsModal">
                                        <span class="text-primary" style="font-weight: bold; font-size: larger;">${meeting.meeting_heading}</span>
                                    </button><br>
                                    <div class="row mb-2">
                                        <div class="col ">
                                            <span class="text-start"><i class="fas fa-id-card"></i>&nbsp;&nbsp;${meeting.student_reg_num}</span>
                                        </div>
                                        <div class="col ">
                                            <span class="text-end"> <i class="fas fa-calendar"></i>&nbsp;&nbsp;${meeting.meeting_pref_date}</span>
                                        </div>
                                        <div class="col ">
                                            <span class="text-end"> <i class="fas fa-clock"></i>&nbsp;&nbsp;${meeting.meeting_pref_time}</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>`;

                if (meeting.meeting_status === <?php echo json_encode(MeetingStatus::Approved); ?>) {
                    approvedMeetingTableBody.append(row);
                } else if (meeting.meeting_status === <?php echo json_encode(MeetingStatus::Rejected); ?>) {
                    rejectedMeetingTableBody.append(row);

                }



            });

        }

        // Fetch and update data initially on page load
        fetchDataAndUpdateUserMeetings();

        // Set interval to periodically fetch and update data (every 5 seconds in this example)
        setInterval(fetchDataAndUpdateUserMeetings, 5000);
    });
</script>
<!-- End Status & Notifications -->

<!-- Meeting information Modal -->
<script>
    $(document).ready(function() {
        $('#detailsModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');

            $.ajax({
                url: 'utils/fetch_user_meeting_data.php',
                method: 'GET',
                data: {
                    whereBy: 'id',
                    whereValue: id
                },
                dataType: 'json',
                success: function(meeting) {
                    $('#showMeetingHeading').text(meeting.meeting_heading);
                    $('#showMeetingPurpose').text(meeting.meeting_purpose);
                    $('#showMeetingOutline').text(meeting.meeting_outline);
                    $('#showMeetingAddInfo').text(meeting.meeting_add_info);

                    if (meeting.meeting_file_data_exist) {
                        $('#showMeetingAttachment').html(`<a href="utils/fetch_meeting_attachment.php?id=${meeting.meeting_id}" download="${meeting.meeting_filename}">${meeting.meeting_filename}</a>`);

                    } else {
                        $('#showMeetingAttachment').html(`<span class="text-danger">No attachment</span>`);
                    }

                },
                error: function() {
                    console.error('Error fetching data.');
                }
            });
        });
    });
</script>
<!-- End Meeting information Modal -->

<?php include "./templates/footer.php"; ?>

<?php
ob_end_flush(); // Flush the output buffer
?>