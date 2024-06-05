<div class="tab-pane fade show active" id="admindashboard">
    <div class="container d-flex justify-content-center align-items-center">
        <div class="row border-red rounded-5 p-3 shadow box-area blur-background">
            <div class="mx-auto">
                <div class="row align-items-center">
                    <h1 class="text-start">Hi, <b><span id="welcomeUserName"></span></b></h1>
                    <hr>
                    <div class="container-fluid mb-5 bordered border">
                        <div class="row d-flex">
                            <!-- Chart Column -->
                            <div class="col-md-6">
                                <canvas id="myChartToday" style="max-width: 600px; margin: 0 auto;"></canvas>
                            </div>
                            <!-- Labels Column -->
                            <div class="col-md-6">
                                <canvas id="myChartTotal" style="max-width: 600px; margin: 0 auto;"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="container today meetings bordered border">
                        <div id="carouselExample" class="carousel slide">
                            <div class="carousel-inner text-center">
                                <div class="carousel-item active">
                                    <h3 class="text-success">Accepted</h3>
                                    <div class="table-responsive" style="max-height:600px">

                                        <table class="table text-center border" style="border:solid 2px black; ">

                                            <thead>
                                                <tr>
                                                    <th scope="col" colspan="2">Meeting Details</th>
                                                </tr>
                                            </thead>

                                            <tbody id="approvedMeetingTableBody">
                                                <tr rowspan="2">
                                                    <td class="bordered border">
                                                        <button type="button" class="btn btn-sm ml-2 mb-2" data-bs-toggle="modal" data-bs-target="#detailsModal">
                                                            <span class="text-primary" style="font-weight: bold; font-size: larger;">Meeting heading goes here</span>
                                                        </button><br>
                                                        <div class="row mb-2">
                                                            <div class="col ">
                                                                <span class="text-start"><i class="fas fa-id-card"></i>&nbsp;&nbsp;2019/ASP/88</span>
                                                            </div>
                                                            <div class="col ">
                                                                <span class="text-end"> <i class="fas fa-calendar"></i>&nbsp;&nbsp;Date</span>
                                                            </div>
                                                            <div class="col ">
                                                                <span class="text-end"> <i class="fas fa-clock"></i>&nbsp;&nbsp;Time</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <h3 class="text-danger">Rejected</h3>
                                    <div class="table-responsive" style="max-height:600px">
                                        <table class="table text-center border" style="border:solid 2px black; ">

                                            <thead>
                                                <tr>
                                                    <th scope="col" colspan="2">Meeting Details</th>
                                                </tr>
                                            </thead>

                                            <tbody id="rejectedMeetingTableBody">
                                                <tr rowspan="2">
                                                    <td class="bordered border">
                                                        <button type="button" class="btn btn-sm ml-2 mb-2" data-bs-toggle="modal" data-bs-target="#detailsModal">
                                                            <span class="text-primary" style="font-weight: bold; font-size: larger;">Meeting heading goes here</span>
                                                        </button><br>
                                                        <div class="row mb-2">
                                                            <div class="col ">
                                                                <span class="text-start"><i class="fas fa-id-card"></i>&nbsp;&nbsp;2019/ASP/88</span>
                                                            </div>
                                                            <div class="col ">
                                                                <span class="text-end"> <i class="fas fa-calendar"></i>&nbsp;&nbsp;Date</span>
                                                            </div>
                                                            <div class="col ">
                                                                <span class="text-end"> <i class="fas fa-clock"></i>&nbsp;&nbsp;Time</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>

                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>



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