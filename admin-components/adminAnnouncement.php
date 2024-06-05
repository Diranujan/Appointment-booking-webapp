
<div class="tab-pane fade" id="adminannouncement">
    <div class="container d-flex justify-content-center align-items-center">
        <div class="row border-red rounded-5 p-3 shadow box-area blur-background">
            <div class="mx-auto">
                <div class="row align-items-center">
                    <h1 class="text-center">Admin Announcement</h1>
                    <form>
                        <!-- Announcement Heading -->
                        <div class="form-group">
                            <label for="announcementHeading">Announcement Heading</label>
                            <input type="text" class="form-control" id="announcementHeading" placeholder="Enter heading">
                        </div>
                        
                        <!-- Announcement Body -->
                        <div class="form-group">
                            <label for="announcementBody">Announcement Body</label>
                            <textarea class="form-control" id="announcementBody" rows="5" placeholder="Enter body"></textarea>
                        </div>
                        
                        <!-- Select Target Audience -->
                        <div class="form-group">
                            <label for="targetAudience" class="form-label">Select Target Audience:</label><br>
                            <select class="form-select js-example-basic-multiple" id="targetAudience" multiple="multiple" style="width:100%;">
                                <optgroup label="Faculties">
                                    <option value="faculty1">Faculty 1</option>
                                    <option value="faculty2">Faculty 2</option>
                                 
                                </optgroup>
                                <optgroup label="Departments">
                                    <option value="department1">Department 1</option>
                                    <option value="department2">Department 2</option>
                                   
                                </optgroup>
                                <optgroup label="Students">
                                    <option value="student1">Student 1</option>
                                    <option value="student2">Student 2</option>
                                    
                                </optgroup>
                            </select>
                        </div>

                       
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

