<div class="justify-content-center align-items-center rounded-4" style="border: solid 2px red; padding: 10px; margin-bottom: 10px; background-color:white;">
    <div class="row">
        <div class="departmentaddform mb-2" style="background:light;">
            <h4 class="text-center font-weight-bold text-primary">Add the new Department</h4>
            <form id="departmentForm" action="utils/add_department.php" method="post">

                <div class="form-group">
                    <label for="departmentName">Department Name:</label>
                    <input type="text" class="form-control" id="departmentName" name="departmentName" placeholder="Enter Department Name" required>
                </div>

                <div class="form-group">
                    <label for="facultySelect">Select faculty:</label>
                    <select id="facultyDropdown" name="facultyId" id="faculty" class="form-select">
                        <option value="">Select a Faculty</option>

                    </select>
                </div>
                <div class="form-group">
                    <label for="hodSelect">Select HOD:</label>
                    <select id="HODDropdown" name="HODId" class="form-select" required>
                        <option value="">Select a HOD</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-center btn-primary">Add Department</button>
            </form>
        </div>
        <hr>
        <div class="Departmentupdateform mt-2">
            <table class="table">
                <thead class="text-white" style="background:#ffffff;">
                    <tr>

                        <th>Name</th>
                        <th>Faculty</th>
                        <th>HOD</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="align-item-center" id="departmentTableBody">

                </tbody>
            </table>





            <!-- Update Modal  -->
            <div class="modal fade" id="updateModalDepartment" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="updateModalLabel">Edit Department</h5>
                            <!-- <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span> -->
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Your form goes here -->
                            <form id="updateFormDepartment" action="utils/update_department_data.php" method="post">
                                <input type="hidden" id="departmentIdUpdate" name="departmentId"> <!-- Hidden input to store item ID -->
                                <div class="form-group">
                                    <label for="departmentName">Department Name:</label>
                                    <input type="text" class="form-control" id="departmentNameUpdate" name="departmentName" placeholder="Enter Department Name">
                                </div>

                                <div class="form-group">
                                    <label for="HODDropdown">Select HOD:</label>
                                    <select id="HODDropdownUpdate" name="HODId" class="form-select">
                                        <option value="">Select a HOD</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="facultyDropdown">Select Faculty:</label>
                                    <select id="facultyDropdownUpdate" name="facultyId" class="form-select">
                                        <option value="">Select a Faculty</option>
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
            <div class="modal fade" id="deleteModalDepartment" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete "<label id="deleteDepartmentName"></label>"?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-danger" id="confirmDeleteBtnDepartment">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Delete Modal -->
        </div>
    </div>


</div>