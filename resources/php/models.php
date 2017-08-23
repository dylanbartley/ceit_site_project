<?php

/**
* Represents Course information
*/
class Course {
    public $id;
    public $name;
    public $summary;
    public $teacher;
    public $maxseats;
}

/**
* Represents Batch information including information from the associated Course
*/
class CourseBatch {
    public $id;
    public $summary;
    public $courseid;
    public $coursename;
    public $availableseats;
    public $maxseats;
    public $startdate;
    public $endate;
    public $teacher;
}

/**
* Represents Batch-Timeslot match
*/
class BatchSlot {
    public $batchid;
    public $timeslot;
}
?>