<div class="tab-pane fade" id="status">
    <div class="container d-flex justify-content-center align-items-center">
        <div class="row border-red rounded-5 p-3 shadow box-area blur-background">
            <div class="mx-auto">
                <div class="row align-items-center">
                    <h1 class="text-center">All status and notices</h1>
                </div>

                <div id="userMeetings">
                    <!-- All user Meeting show here  -->

                </div>
 
                <!-- Meeting information Modal -->
                <div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailsModalLabel">Full Details</h5>
                                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button> -->
                            </div>
                            <div class="modal-body">
                                <h2 class="mb-4 text-primary" id="showMeetingHeading">Meeting Heading</h2>

                                <div class="mb-3">
                                    <strong class="text-info">Purpose of Meeting:</strong>
                                    <p class="mb-0 text-muted" id="showMeetingPurpose">Briefly describe the purpose of the meeting here.</p>
                                </div>

                                <div class="mb-3 border border-primary p-3">
                                    <strong class="text-success">Brief Outline:</strong>
                                    <p class="mb-0 text-muted" id="showMeetingOutline">Provide a brief outline or agenda for the meeting.</p>
                                </div>

                                <div class="mb-3 border border-danger p-3">
                                    <strong class="text-warning">Additional Information:</strong>
                                    <p class="mb-0 text-muted" id="showMeetingAddInfo">Include any additional details or important information for the meeting.</p>
                                </div>

                                <div class="mb-3">
                                    <label class="text-dark">Uploaded File:</label>
                                    <span id="showMeetingAttachment"></span>
                                </div>
                            </div>



                            <div class="modal-footer">

                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Meeting information Modal -->

            </div>
        </div>
    </div>
</div>