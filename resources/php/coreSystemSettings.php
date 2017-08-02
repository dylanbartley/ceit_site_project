<?php

/* 
 * Date: July 31 2016
 * 
 * Important config information 
 * 
 */

$dataBaseServerName = "localhost";
$serverPortNumber=3360;
$dataBaseName = "ceitdominicaregister_dm_db";



/*USER CREDENTIALS CODE BACK #55*/
$dataBaseUserName="internetUser";
$dataBasePassword="331A11AC61113EDDC283C5BEC8996";
/*END OF CODE BLOCK #55*/


//names of the tables in db 
//BLOCK #57
$tableBatchSchedule="batchschedule";
$tableRegisteredStudents = "registeredstudents";
$tableStudentsCourseBatches ="studentCourseBatches";
$tableCourseBatches = "coursebatches";
$tableCeiTeachers="ceiteachers";
$tableSubjectCourse="subjectcourse";
//END OF BLOCK #57


//names of all the col of each table for ease of management 
          // and updates
           $colRegisteredStudents_sn ="studentName";
           $colRegisteredStudents_se="studentEmail";

           
           
           
           
           
           
           /*
            * List of all the columns under the table named: coursebatches
            * Code Block: #345
            */
           $courseBatchesId = "coursebatches.id";
           $courseBatchesCourseStatus = "coursebatches.coursesStatus";
           $courseBatchesLecturer="coursebatches.lecturerFK";
           $courseBatcheSchoolYear ="coursebatches.schoolYear";
           $courseBatcheStartDate = "coursebatches.startDate";
           $courseBatchesEndDate = "coursebatches.endDate";
           $courseBatchesAvailableSeats ="coursebatches.availableCourseSeats";
           $courseBatchesMaxSeats ="coursebatches.maxSeats";
           $courseBatchesCoursesFK = "coursebatches.coursesFK";
           
           //END OF CODE BLOCK #345
          
           
           
           /*
            * List of all the columns under the table named: subjectcourse
            * Code Block: #346
            */
           
           $subjectCourseName = "subjectcourse.courseName";
           $subjectCourseSummary = "subjectcourse.courseSummary";
           $subjectCourseID ="subjectcourse.id";
           //END OF CODE BLOCK #346
           
           
           
           /*
            * FUNCTIONS USED TO RETURN THE INDIRECT VALUES
            * ENCAPSULATION OF SOME SORTS
            * #657
            */
           function getRegisteredStudentsColSName()
           {
               global $colRegisteredStudents_sn;
           return $colRegisteredStudents_sn;    
           }

           function getRegisteredStudentColSEmail()
           {
               global $colRegisteredStudents_se;
               return $colRegisteredStudents_se;
           }
           
           
           
           
           /*
            * CODE BLOCK FOR RETURNING THE STRING REP
            * OF THE VARIOUS TABLES AND COLUMN NAMES
            * 
            * CODE BLOCK:#1145
            */
           
           /*
            * returns the name of the table coursebatches
            * to be used as means of access 
            */
           function getTableCourseBatchesName()
            { 
               global $tableCourseBatches;
           return $tableCourseBatches;
            }
                    
                    
                    /*
            * returns the name of the table registeredstudents
            * to be used as means of access 
            */
            function getTableRegisteredStudentsName()
            {
           global $tableRegisteredStudents;
           return $tableRegisteredStudents;
            }
                    
            
               function getTableSubjectCourse()
               {
                   global $tableSubjectCourse;
                   return $tableSubjectCourse;
               }
               
               function getTableCourseBatchesId()
               {
                   global $courseBatchesId;
                   return $courseBatchesId;
               }
               
               function getTableCourseBatchesStatus()
               {
                   global $courseBatchesCourseStatus;
                   return $courseBatchesCourseStatus;
               }
               
               function getTableCourseBatchesLect()
               {
                   global $courseBatchesLecturer;
                   return $courseBatchesLecturer;
               }
               
               function getTableCourseBatchesSchYr()
               {
                   global $courseBatcheSchoolYear;
                   return $courseBatcheSchoolYear;
               }
               
                function getTableCourseBatchesStartDate()
               {
                   global $courseBatcheStartDate;
                   return $courseBatcheStartDate;
               }
               
               function getTableCourseBatchesEndDate()
               {
                   global $courseBatchesEndDate;
                   return $courseBatchesEndDate;
               }
               
               function getTableCourseBatchesAvailSeats()
               {
                   global $courseBatchesAvailableSeats;
                   return $courseBatchesAvailableSeats;
               }
               
               //per course
               function getTableCourseBatchesMaxSeats()
               {
                   global $courseBatchesMaxSeats;
                   return $courseBatchesMaxSeats;
               }
               
               function getTableSubjectCourseName()
               {
                   global $subjectCourseName;
                   return $subjectCourseName;
               }
               
               function getTableSubjectCourseSummary()
               {
                   global $subjectCourseSummary;
                   return $subjectCourseSummary;
                   
               }
               
               function getTableCourseBatchesCoursesFK()
               {
                   global $courseBatchesCoursesFK;
                   return $courseBatchesCoursesFK;
               }
               
               function getTableSubjectCourseId()
               {
                   global $subjectCourseID;
                   return $subjectCourseID;
               }
               //END OF CODE BLOCK #1145
               
               
               
               
                    
            function getDataBaseName()
             {
              global $dataBaseName;
                return $dataBaseName;
             }
    
    
           function getDataBaseServerName()
           {
               global $dataBaseServerName;
               return $dataBaseServerName;
           }
           
           /*
            * TODO: MAKE FUNCTIONS PRIVATE
            * CB #911
            */
           function getUserName(){
               global $dataBaseUserName;
               return $dataBaseUserName;
           }
           
           function getUserPassword()
           {
               global $dataBasePassword;
               return $dataBasePassword;
           }
           
           /*
            * function used to return the string template for the tables
            * that will be joined together to return the result of active 
            * available courses
            */
           function getActiveCoursesTemplateTable()
           {
               $tableTemplate =getTableCourseBatchesId().",". getTableCourseBatchesStatus().",". getTableSubjectCourseName().",". getTableSubjectCourseSummary().",".
                       getTableCourseBatchesLect().",". getTableCourseBatchesSchYr().",". getTableCourseBatchesStartDate().",". getTableCourseBatchesEndDate().",".
                       getTableCourseBatchesAvailSeats().",". getTableCourseBatchesMaxSeats()." from ".getTableCourseBatchesName()." join ". getTableSubjectCourse().
                       " on ".getTableCourseBatchesCoursesFK()."=". getTableSubjectCourseId()." where ". getTableCourseBatchesSchYr()." >=";
               return $tableTemplate;
           }
           //END OF CODE BLOCK #911
           
           //END OF CODE BLOCK 647