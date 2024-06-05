

<div class="tab-pane fade" id="adminstatus">
    <div class="container d-flex justify-content-center align-items-center ">
        <div class="row border-red rounded-5 p-3 shadow box-area blur-background">
            <div class="col-md-9 mx-auto">
                <div class="row align-items-center ">

                    <h1 class="text-center">My Status</h1>
                    <form id="staffAvailableTimeForm" action="utils/add_update_staff_available_time.php" method="post">

                        <input type="text" name="staff_id" id="staff_id" hidden>
                        <div class="row d-flex space-between">
                            <!-- <div class="input-group mb-5 col">
                                <label class="input-group-text" for="todayPresence">Today's &nbsp; &nbsp;
                                    Presence</label>
                                <select class="form-select" id="todayPresence">
                                    <option selected>Choose...</option>
                                    <option value="present">Present</option>
                                    <option value="absent">Absent</option>
                                </select>
                            </div> -->
                            <div class="d-flex justify-content-between">
                                <div class=" my-5 ">
                                    <label class="form-label h5" for="today_tomorrow">
                                        &nbsp; <b>Select : Today / Tomorrow</b></label>

                                    <select class="form-select" id="today_tomorrow" name="today_tomorrow">
                                        <option value="">Select a Day </option>
                                        <option value="Today">Today</option>
                                        <option value="Tomorrow">Tomorrow</option>
                                    </select>
                                </div>
                                <div class=" my-5 ">
                                    <span class="form-label h5 text-primary fw-bold">
                                        &nbsp; Status : &nbsp;&nbsp;<b><span id="availableSetStatus"><span class="text-danger">Not Available !</span></span></b></label>

                                </div>
                            </div>
                        </div>


                        <!--  Available Time -->
                        <div class="table-responsive">
                            <table class="table text-center p-3" style="border:solid 2px black;">

                                <thead class="">
                                    <tr>
                                        <th scope="col" colspan="2" class="text-primary h4 fw-bold">Set Available Time</th>
                                    </tr>
                                    <tr>
                                        <th scope="col"class="h5 fw-bold">Time Period</th>
                                        <th scope="col" class="h5 fw-bold">Meetable</th>
                                    </tr>
                                </thead>

                                <tbody id="meetingStatusTableBody" class="text-lg">
                                    <tr>
                                        <td class="align-middle h5">08:30 - 09:30</td>
                                        <td class="text-lg">
                                            <select class="form-select form-select-lg fw-bold text-center text-danger" id="time_0830" name="time_0830" disabled>
                                                <option value="0"><span class="text-danger"><span class="text-danger">No</span></span></option>
                                                <option value="1"><span class="text-success">Yes</span></option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle h5">09:30 - 10:30</td>
                                        <td>
                                            <select class="form-select form-select-lg fw-bold text-center text-danger" id="time_0930" name="time_0930" disabled>
                                                <option value="0"><span class="text-danger">No</span></option>
                                                <option value="1"><span class="text-success">Yes</span></option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle h5">10:30 - 11:30</td>
                                        <td>
                                            <select class="form-select form-select-lg fw-bold text-center text-danger" id="time_1030" name="time_1030"  disabled>
                                                <option value="0"><span class="text-danger">No</span></option>
                                                <option value="1"><span class="text-success">Yes</span></option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle h5">11:30 - 12:30</td>
                                        <td>
                                            <select class="form-select form-select-lg fw-bold text-center text-danger" id="time_1130" name="time_1130"  disabled>
                                                <option value="0"><span class="text-danger">No</span></option>
                                                <option value="1"><span class="text-success">Yes</span></option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle h5">12:30 - 13:30</td>
                                        <td>
                                            <select class="form-select form-select-lg fw-bold text-center text-danger" id="time_1230" name="time_1230"  disabled>
                                                <option value="0"><span class="text-danger">No</span></option>
                                                <option value="1"><span class="text-success">Yes</span></option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle h5">13:30 - 14:30</td>
                                        <td>
                                            <select class="form-select form-select-lg fw-bold text-center text-danger" id="time_1330" name="time_1330"  disabled>
                                                <option value="0"><span class="text-danger">No</span></option>
                                                <option value="1"><span class="text-success">Yes</span></option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle h5">14:30 - 15:30</td>
                                        <td>
                                            <select class="form-select form-select-lg fw-bold text-center text-danger" id="time_1430" name="time_1430"  disabled>
                                                <option value="0"><span class="text-danger">No</span></option>
                                                <option value="1"><span class="text-success">Yes</span></option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle h5">15:30 - 16:30</td>
                                        <td>
                                            <select class="form-select form-select-lg fw-bold text-center text-danger" id="time_1530" name="time_1530" disabled>
                                                <option value="0" >No</option>
                                                <option value="1" >Yes</span></option>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                        <!--  Available Time -->


                        <button type="submit" class="btn btn-primary">Update Avilable Time
                        </button>
                    </form>



                </div>
            </div>
        </div>
    </div>

</div>