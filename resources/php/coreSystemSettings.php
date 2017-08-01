<?php

/* 
 * Date: July 31 2016
 * 
 * Important information for connecting to the database server
 * 
 */

$dataBaseServerName = "localhost";
$serverPortNumber=3360;
$dataBaseUserName="root";
$dataBasePassword="";
$dataBaseName = "ceitdominicaregister_dm_db";


//namees of the tables
$tableBatchSchedule="batchschedule";
  $tableRegisteredStudents = "registeredstudents";
      $tableStudentsCourseBatches ="studentCourseBatches";
        $tableCourseBatches = "coursebatches";
          $tableCeiTeachers="ceiteachers";
           $tableSubjectCourse="subjectcourse";



//names of all the col of each table for ease of management 
          // and updates
           $colRegisteredStudents_sn ="studentName";
           $colRegisteredStudents_se="studentEmail";

