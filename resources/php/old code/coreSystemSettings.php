<?php

/*
 * DATE MODIFIED: AUGUST 4 2017
 * TIME: 11:46 PM
 * 
 * FILE USED TO STORE THE PRIMARY AND CRITICAL INFORMATION TO BE USED BY THE SERVER
 */



$databaseName="ceitdominicaregister_dm_db";
$Server ="localhost";
$ServerPortNumber =0000;

/*
 * methods used to return the database name and server information
 * CODE BLOCK #10
 */
function getDatabaseRef(){
    global $databaseName;
    return $databaseName;
}

function getServerAddress()
{
    global $Server;
    return $Server;
}

function getServerGate()
{
    global $ServerPortNumber;
    return $ServerPortNumber;
}
//END OF CODE BLOCK #10

/*
 * user name and passwords for the users
 * 
 * CODE BLOCK #17
 */

//******account for teachers and sub users***********************
$databaseSubAdminUserName = "ceitdbUser";
$databaseSubAdminPassword = "4E5F9888F0BB1EC597E58BC341053660F";
//****************************************************************
//********account for users on the front end**********************
$databaseDailyUserName = "internetUser";
$databaseDailyUserPassword = "331A11AC61113EDDC283C5BEC8996";
//****************************************************************

/*
 * set and get methods for accessing the userames and their passwords
 * CODE BLOCK # 18
 * 
 */
function getSubAdminUserName()
{
    global $databaseSubAdminUserName;
    return $databaseSubAdminUserName;
}

function getSubAdminPass()
{
    global $databaseSubAdminPassword;
    return $databaseSubAdminPassword;
}

function getDailyDriverUN()
{
    global $databaseDailyUserName;
    return $databaseDailyUserName;
    
}

function getDailyDriverUP()
{
    global $databaseDailyUserPassword;
    return $databaseDailyUserPassword;
}

//END OF CODE BLOCK 18

//END OF CODE BLOCK #17


/*
 * methods used to return the procedure calls to communicate 
 * with the database
 * CODE BLOCK 100
 */

//function used to call the server to add a new record
//into the subjects table
//table name: subjectcourses
function insertNewCourse($CCode,$subjectName,$summary)
{
    $scriptTemplate = "CALL insertNewCourse('".$CCode."','".$subjectName."','".$summary."')";
    return $scriptTemplate;
}


//functin used to call the server to add a new registered student's information
//table name: registeredstudents
function insertNewRegisteredStudent($studentName,$studentEmail)
{
    $insertScriptTemplate ="CALL insertNewRegisteredStudent('".$studentName."','".$studentEmail."')";
            return $insertScriptTemplate;
}


//function used to call the server to add a new teacher and their information
function insertNewTeacher($teacherName,$gender,$teacherEmail)
{
    $insertTeacherScriptTemplate = "CALL insertNewTeacher('".$teacherName."','".$gender."','".$teacherEmail."')";
    return $insertTeacherScriptTemplate;
}
//END OF CODE BLOCK 100


//gets the current year of the server
//this will be used as a pointer as to what information it 
//will display at any time
function  findServerYearDate()
{
    $dateStructure = '%Y ';
$currentYear = strftime($dateStructure);
    return $currentYear;
}