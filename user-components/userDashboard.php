<?php
require_once("conf/conf.php");
// fetch user details
$sql = "  SELECT 
            students.reg_num 
            FROM 
            students
            WHERE students.email = '" . $_SESSION['userEmail'] . "'";
$result = mysqli_query($conn, $sql);
$currentUser = mysqli_fetch_array($result, MYSQLI_ASSOC);

?>





<div class="tab-pane fade show active" id="dashboard">
    <div class="container d-flex justify-content-center align-items-center ">
        <div class="row border-red rounded-5 p-3 shadow box-area blur-background">
            <div class="mx-auto">
                <div class="row align-items-center">
                    <h1 class="text-start text-primary">Hi,
                        <?php echo $currentUser['reg_num'] ?>👋
                    </h1>
                    <h6 class="text-lightblue">
                        <div class="container-fluid">
                            <div  class=" typewriter">
                                 <h3 id="sentence" class="text-fluid"></h3>
                            </div>
                        </div>
                    </h6>

                    <div id="userTodayMeetings">
                    <!-- All user Meeting show here  -->

                    </div>

                    
                    <!-- <div class="alert alert-light border-primary">
                            <div class="mb-1 mt-3 ">
                                <h5 class="d-flex p-1 text-primary-emphasis bg-primary-subtle border border-primary-subtle rounded-3">
                                   
                                
                                <span class="text-primary mr-2"><i class="fas fa-heading"></i></span
                                    <span class="text-primary pr-2 h3 ">Title :&nbsp; </span>
                                    <span class="text-primary h3"><b> Meetin Heading </b></span>
                                   
                                    
                                </h5>
                            </div>
                            
                            <div class="row">
                                <div class="col-12 col-sm-4 h5">
                                    <span class="text-black mr-2"><i class="fas fa-user"></i></span>
                                    <span class="text-black">&nbsp;staff Nmae</span>
                                </div>
                                <div class="col-12 col-sm-4 h5">
                                    <span class="text-black mr-2"><i class="fas fa-briefcase"></i></span>
                                    <span class="text-black">&nbsp;Dean</span>
                                </div>
                                <div class="col-12 col-sm-4 ${textColor} h5">
                                <span class="text-black mr-2"><i class="fas fa-clock"></i></span>
                                    <span>&nbsp;11:30:00</span></b>
                                </div>
                            </div>
                            


                    </div> -->


                </div>
            </div>
        </div>
    </div>
</div>