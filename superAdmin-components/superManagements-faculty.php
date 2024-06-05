<div class="justify-content-center align-items-center rounded-4" style="border: solid 2px red; padding: 10px; margin-bottom: 10px; background-color:white;">
    <div class="row">

        <div class="facultyaddform mb-2" style="background:light;">
            <h4 class="text-center font-weight-bold text-primary">Add the new faculty</h4>
            <form id="facultyForm" action="utils/add_faculty.php" method="post">

                <div class="form-group">
                    <label for="facultyName">Faculty Name:</label>
                    <input type="text" class="form-control" id="facultyName" name="facultyName" placeholder="Enter Faculty Name" required>
                </div>

                <div class="form-group">
                    <label for="deanSelect">Select Dean:</label>
                    <select id="deanDropdown" name="deanId" class="form-select" required>
                        <option value="">Select a Dean</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-center btn-primary">Add Faculty</button>
            </form>
        </div>
        <hr>
        <div class="facultyupdateform mt-2 ">
            <table class="table" style="  background:black;">
                <thead class="text-white " style="background:#ffffff;">
                    <tr>

                        <th>Name</th>
                        <th>Dean</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="align-item-center" id="facultyTableBody">

                </tbody>
            </table>


            <!-- Update Modal  -->
            <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="updateModalLabel">Edit Faculty</h5>
                            <!-- <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span> 
                            </button>--> 
                        </div>
                        <div class="modal-body">
                            <!-- Your form goes here -->
                            <form id="updateForm" action="utils/update_faculty_data.php" method="post">
                                <input type="hidden" id="facultyIdUpdate" name="facultyId"> <!-- Hidden input to store item ID -->
                                <div class="form-group">
                                    <label for="facultyName">Faculty Name:</label>
                                    <input type="text" class="form-control" id="facultyNameUpdate" name="facultyName" placeholder="Enter Faculty Name">
                                </div>

                                <div class="form-group">
                                    <label for="deanDropdown">Select Dean:</label>
                                    <select id="deanDropdownUpdate" name="deanId" class="form-select">
                                        <option value="">Select a Dean</option>
                                    </select>
                                </div>
                                <!-- Other form fields as needed -->
                                <button type="submit" class="btn btn-success">Save Changes</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>

                            </form>
                        </div>
                        <!-- Other modal content if needed -->
                    </div>
                </div>
            </div>
            <!-- End Update Modal  -->

            <!-- Delete Modal -->
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete "<label id="deleteFacultyName"></label>"?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Delete Modal -->


        </div>
    </div>


</div>