<div class="tab-pane fade" id="adminappointment">

    <div class="container d-flex justify-content-center align-items-center ">
        <div class="row border-red rounded-5 p-3 shadow box-area blur-background">
            <div class="mx-auto">
                <div class="row align-items-center">
                    <h1 class="text-center">All Appointments</h1>
                    <!-- search -->
                    <nav class="navbar bg-body-tertiary mb-2">
                        <div class="container-fluid">
                            <a class="navbar-brand"></a>
                            <form class="d-flex" role="search">
                                <input class="form-control me-2" type="search" placeholder="Reg_No" aria-label="Search">
                                <button class="btn btn-outline-success" type="submit">Search</button>
                            </form>
                        </div>
                    </nav>
                    <!-- search -->


                    <div id="appointmentView">
                        <!-- Appointments of a staff will show here -->

                    </div>


                    <!-- acceptMeetingModal -->
                    <div class="modal fade" id="acceptMeetingModal" tabindex="-1" aria-labelledby="responseModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content ">
                                <!-- <div class="modal-header">
                                    <h5 class="modal-title" id="responseModalLabel">Response</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div> -->
                                <div class="modal-body h3 text-center mt-5 mb-3" id="acceptMeetingModalBody">
                                    <!-- Response message will be displayed here -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End acceptMeetingModal -->

                    <!-- rejectMeetingModal -->
                    <div class="modal fade" id="rejectMeetingModal" tabindex="-1" aria-labelledby="rejectionModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold" id="rejectionModalLabel">Rejection Reasons</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Add form elements for rejection reasons -->

                                    <form id="rejectMeetingForm" action="utils/update_meeting_status.php" method="post">
                                        <!-- Hidden input to store meeting ID -->
                                        <input type="hidden" id="meetingRejectId" name="id">
                                        <!-- Hidden input to store Rejected Status -->
                                        <input type="hidden" id="meetingRejectStatus" name="status">
                                        <div class="form-group">
                                            <label for="reject_reason" class="form-label">Enter Rejection Reasons:</label>
                                            <textarea class="form-control" id="reject_reason" name="reject_reason"  rows="3"></textarea>
                                        </div>

                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>



                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- End rejectMeetingModal -->

                </div>
            </div>
        </div>

    </div>

</div>