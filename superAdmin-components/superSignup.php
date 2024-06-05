<div class="tab-pane fade" id="supersignup">
    <div class="container d-flex justify-content-center align-items-center ">
        <div class="row border-red rounded-5 p-3 shadow box-area blur-background">
            <div class="mx-auto">
                <div class="row align-items-center">

                    <h1 class="text-center mb-5 mt-3">Create Admin</h1>
                    <form id="adminRegisterForm" method="post" action="utils/add_staff.php">
                        <div class="row">
                            <div class="form-group col">
                                <label for="firstName">First Name:</label>
                                <input type="text" class="form-control" id="firstName" name="first_name" placeholder="Enter your first name" required>
                            </div>
                            <div class="form-group col">
                                <label for="lastName">Last Name:</label>
                                <input type="text" class="form-control" id="lastName" name="last_name" placeholder="Enter your last name" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                        </div>

                        <div class="form-group">
                            <label for="contactEmail">Contact Email:</label>
                            <input type="email" class="form-control" id="contactEmail" name="contact_email" placeholder="Enter your contact email">
                        </div>

                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label for="gender">Gender:</label>
                                <select class="form-control" id="gender" name="gender">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="phoneNumber">Phone Number:</label>
                                <input type="tel" class="form-control" id="phoneNumber" name="phone_number" placeholder="Enter your phone number">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label class="form-label">Faculty:</label>
                                <select id="facultyDropdownAdmin" name="faculty" id="faculty" class="form-select">
                                    <option value="">Select a Faculty</option>

                                </select>
                            </div>
                            <div class="form-group col">
                                <label class="form-label">Department:</label>
                                <select id="departmentDropdownAdmin" name="department" id="department" class="form-select">
                                    <option value="">Select a Department</option>

                                </select>

                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <label class="form-label">Profession:</label>
                                <select id="professionDropdownAdmin" name="profession" id="profession" class="form-select">
                                    <option value="">Select a Profession</option>

                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3 mb-4">Register</button>
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
                    <!-- End Response modal -->



                </div>
            </div>
        </div>
    </div>
</div>