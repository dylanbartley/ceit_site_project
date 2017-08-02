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
           //END OF CODE BLOCK #911