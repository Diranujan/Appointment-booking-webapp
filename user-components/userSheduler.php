<div class="tab-pane fade" id="scheduler">
    <div class="container d-flex justify-content-center align-items-center ">
        <div class="row border-red rounded-5 p-3 shadow box-area blur-background">
            <div class="col-md-9 mx-auto">
                <div class="row align-items-center ">

                    <h3>Scheduler Content</h3>
                    <form id="studentMeetingForm" action="utils/add_meeting.php" method="post" enctype="multipart/form-data">

                        <input type="text" name="student_id" id="student_id" hidden>

                        <label for="full_name" class="form-label">Full Name:</label><br>
                        <div class="input-group mb-2">
                            <input type="text" name="full_name" class="form-control" id="full_name" disabled>
                        </div>

                        <label for="registration_number" class="form-label">Registration Number:</label><br>
                        <div class="input-group mb-2">
                            <input type="text" name="registration_number" class="form-control" id="registration_number" disabled>
                        </div>

                        <label for="email" class="form-label">Email:<small class="text-info">You will receive
                                notifications using this email address.</small></label><br>
                        <div class="input-group mb-2">
                            <input type="text" name="contact_email" class="form-control" id="contact_email">
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label">Current Year of Study:</label>
                                <select class="form-control" name="year_of_study" id="year_of_study">
                                    <option value="">Select your year</option>
                                    <option value="1">1st year</option>
                                    <option value="2">2nd year</option>
                                    <option value="3">3rd year</option>
                                    <option value="4">4th year</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">

                            </div>
                        </div>
                        <hr>

                        <div class="form-group mb-3">
                            <label for="people" class="form-label">Schedule a meeting with : </label><br>
                            <select id="staffsDropdown" name="staff" class="form-select js-example-basic-single" style="width:100%;" required>
                                <option value="">Select a Staff</option>
                            </select>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label">Preferred Date:</label>
                                <select id="dateDropdown" name="preferred_date" class="form-select" style="width:100%;" required>
                                    <option value="">Select a Date</option>
                                    <!-- <option value="Today">Today</option>
                                    <option value="Tomorrow">Tomorrow</option> -->
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="form-label">Preferred Time:</label>
                                <select id="timeDropdown" name="preferred_time" class="form-select" style="width:100%;" required>
                                    <option value="">Select a Time</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group mb-3">
                            <label for="meeting_heading" class="form-label">Meeting Heading:</label><br>
                            <div class="input-group mb-3">
                                <input type="text" name="meeting_heading" class="form-control" id="meeting_heading" required>
                            </div>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please choose a username.
                            </div>
                        </div>



                        <div class="form-group mb-3">
                            <label for="purpose_of_meeting" class="form-label">Purpose of Meeting:</label><br>
                            <div class="input-group mb-3">
                                <input type="text" name="purpose_of_meeting" class="form-control" id="purpose_of_meeting" required>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="brief_outline" class="form-label">Brief Outline:</label><br>
                            <div class="input-group mb-3">
                                <textarea name="brief_outline" class="form-control" id="brief_outline" style="height: 110px;" required></textarea>
                            </div>
                        </div>

                        <label for="additional_information" class="form-label">Any Additional
                            Information:</label><br>
                        <div class="input-group mb-2">
                            <input type="text" name="additional_information" class="form-control" id="additional_information">
                        </div>

                        <label for="attachment" class="form-label">Attach File:</label><br>
                        <div class="input-group mb-4">
                            <input type="file" name="attachment" class="form-control" id="attachment">
                        </div>

                        <div class="input-group mb-4">
                            <input type="submit" value="Submit" class="btn btn-primary">
                        </div>
                    </form>

                    <!-- Response modal -->
                    <div class="modal fade" id="responseModal" tabindex="-1" aria-labelledby="responseModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content bg-">
                                <!-- <div class="modal-header">
                                    <h5 class="modal-title" id="responseModalLabel">Response</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div> -->
                                <div class="modal-body h3 text-center mt-5 mb-3" id="modalBody">
                                    <!-- Response message will be displayed here -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Response modal -->



                </div>
            </div>
        </div>
    </div>

</div>