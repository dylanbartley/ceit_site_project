<?php

/* 
 * Will begin to connect to the database and do most of the heavy liftinh
 * 
 * >>insert
 */


//include the php file with the information for the database
include 'coreSystemSettings.php';

//generic messages to be logged or displayed to the user
include 'messages.php';



/*
 * returning all the content from the form submitted by the user
 */
$registeredName = $_POST['register-Name'];
$registeredEmail = $_POST['register-Email'];




//attempts to connect to the database server
$connectToDatabase = mysqli_connect($dataBaseServerName,$dataBaseUserName,$dataBasePassword);



if(!$connectToDatabase){
    die(databaseCantConnect());
}
 else {
databaseConnected();    
}

$currentYear = getServerTime();


echo "Current Year: ".$currentYear;






$script = shellScriptInsertRegisteredStudents(getRegisteredName(), getRegisteredEmail(),$tableRegisteredStudents);
mysqli_select_db($connectToDatabase, $dataBaseName);
mysqli_query($connectToDatabase,$script);
mysqli_close($connectToDatabase);


//displayActiveBaches($currentYear);
/**************************************************************************************************
 * 
 *      DEFINING OF THE METHOD BELOW
 **************************************************************************************************/

//gets the current time on the server
//will return the result as we process it
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
    global $colRegisteredStudents_se;
    global $colRegisteredStudents_sn;
    
    //$colRegisteredStudents_sn=$colRegisteredStudents_sn;
    $insertScript = "insert into ".$dbTable." (". $colRegisteredStudents_sn.",".$colRegisteredStudents_se.") "
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
     */
    function displayActiveBaches($yr)
    {
        //global $connectToDatabase;
        global $dataBaseName;
        global $dataBaseServerName;
        global $dataBasePassword;
        global $dataBaseUserName;
        
        $connectToDatabase = mysqli_connect($dataBaseServerName,$dataBaseUserName,$dataBasePassword);

        
        $displayScript = "select * from ".getTableCourseBatchesName()." where schoolYear >=".$yr;
        
       // echo $displayScript;
       // echo $dataBaseName;
       
     
     
       mysqli_select_db($connectToDatabase, $dataBaseName);
        
        $queryResult = mysqli_query($connectToDatabase,$displayScript);
        
        
        
               if(mysqli_num_rows($queryResult)>0)
                {
                    //displaying the result
                    while($resultRow = mysqli_fetch_assoc($queryResult))
                    {
                        
                        echo $resultRow['coursesFK']." ".$resultRow['coursesStatus']." ".$resultRow['lecturerFK']." ".$resultRow['schoolYear']." ".$resultRow['startDate']." ".$resultRow['endDate']." ".$resultRow['availableCourseSeats']." ".$resultRow['maxSeats']." "."<br>";
                    }
                    
                }//end of if statement
                else{
                echo "0 results";}
                
                mysqli_close($connectToDatabase);
             
             
    }
    
    
    
    //END OF CODE BLOCK #67