<?php

/* 
 * Responsible for the:
 * >>connecting
 * >>insert
 * >>management of data in the database
 */


/*
 * INCLUDES FROM OTHER PHP FILES
 * CODE BLOCK #100
 */
include 'coreSystemSettings.php'; //db information
include 'messages.php'; //messages and notices

//END OF CODE BLOCK #100


/*
 *TESTING DATABASE VIA HTML FORMS 
 * #111 
 */


 // returning all the content from the form submitted by the user
 //via the submission form
$registeredName = $_POST['register-Name'];
$registeredEmail = $_POST['register-Email'];

//END OF CB #111



//attempts to connect to the database server
$connectToDatabase = mysqli_connect(getDataBaseServerName(),getUserName(),getUserPassword());


//checks to see if connection is possible
/*
 * TODO: REMOVE TEXT BASED MESSAGE LATR
 * #1112
 */
if(!$connectToDatabase){
    die(databaseCantConnect());
}
 else {
databaseConnectedNotify();    
}
//END OF CB #1112



$currentYear = getServerTime();
echo "Current Year: ".$currentYear;



$scriptInsert = shellScriptInsertRegisteredStudents(getRegisteredName(), getRegisteredEmail(),getTableRegisteredStudentsName());
mysqli_select_db($connectToDatabase, getDataBaseName());
mysqli_query($connectToDatabase,$scriptInsert);
mysqli_close($connectToDatabase);


displayActiveBaches($currentYear);


/**************************************************************************************************
 *                                                                                                *
 *      FUNCTIONS ARE DEFINED BELOW                                                                *
 **************************************************************************************************/

/*gets the current time on the server
will return the result to be processed
to find the batches to display at the FE */

function getServerTime()
{
$dateStructure = '%Y ';
$systemCurrentTime = strftime($dateStructure);
    return $systemCurrentTime;
}//end of function getServerTime




//shell script to insert data into the students database
//table: registeredstudents
/*
 * it takes the students and email and inserts it into the body of the insert script
 * scalable and management capable
 */

function shellScriptInsertRegisteredStudents($sNames,$sEmailAddress,$dbTable){
    //includes it in the scope so that I can gain access to it
    //in the functioin
   
    $insertScript = "insert into ".$dbTable." (". getRegisteredStudentsColSName().",".getRegisteredStudentColSEmail().") "
            . "values ('".$sNames."','".$sEmailAddress."')";
    return $insertScript;
}//end of function that returns the base scrpt of an sql statement


/*
 * functions used to return the values from the form
 * CODE BLOCK #:66
 */
function getRegisteredName(){
    global $registeredName;
    return $registeredName;}
    
function getRegisteredEmail(){
    global $registeredEmail;
    return $registeredEmail;}
    
   //END OF CODE BLOCK #:66 
     
    
    
    /*
     * 
     * CODE BLOCK #:67
     * TODO:WIP
     */
    function displayActiveBaches($yr)
    {   
        $connectToDatabase = mysqli_connect(getDataBaseServerName(),getUserName(),getUserPassword());

        
       // $displayScript = "select * from ".getTableCourseBatchesName()." where schoolYear >=".$yr;
       $displayScript = "select ".getActiveCoursesTemplateTable().$yr; 
    
        mysqli_select_db($connectToDatabase, getDataBaseName());
        
        $queryResult = mysqli_query($connectToDatabase,$displayScript);
           
        echo "<table border=4>";
        
               if(mysqli_num_rows($queryResult)>0)
                {
                    //displaying the result
                    while($resultRow = mysqli_fetch_assoc($queryResult))
                    {
                        
                    echo "<tr><td>".$resultRow['id']."|".
                            $resultRow['coursesStatus']."|".
                            $resultRow['courseName']."|".
                            $resultRow['courseSummary']."|".
                            $resultRow['lecturerFK']."|".
                            $resultRow['schoolYear']."|".
                            $resultRow['startDate']."|".
                            $resultRow['endDate']."|".
                            $resultRow['availableCourseSeats']."|".
                            $resultRow['maxSeats']."<br>"."</tr></td>";
                        
                    }
                    
                }//end of if statement
                else{
                echo "0 results";}
                
                echo "</table>";
                mysqli_close($connectToDatabase);
             
             
    }
    //END OF CODE BLOCK #67