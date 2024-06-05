<?php



    //Different type of users
    class UserType {
        const SuperAdmin = "SUPER ADMIN";
        const Admin = "ADMIN";
        const Student = "STUDENT";
    }

    //Status
    class MeetingStatus {
        const Pending = "Pending Approval";
        const Approved = "Approved";
        const Rejected = "Rejected";
    }

    class ProfessionID{
        const SuperAdmin = 0;
        const Dean = 1;
        const HOD = 2;
    }

    class TimeSlot{
        const Time_0830 = "08:30 - 09:30";
        const Time_0930 = "09:30 - 10:30";
        const Time_1030 = "10:30 - 11:30";
        const Time_1130 = "11:30 - 12:30";
        const Time_1230 = "12:30 - 13:30";
        const Time_1330 = "13:30 - 14:30";
        const Time_1430 = "14:30 - 15:30";
        const Time_1530 = "15:30 - 16:30";
        
    }
?>