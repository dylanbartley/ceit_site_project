<?php
/*
 * FILE NAME:
 * 
 * DESCRIPTION: FILE USED TO INSERT THE REGISTERED STUDENTS 
 * INTO THE DATABASE
 * 
 * DATE MODIFIED:
 */
include 'coreSystemSettings.php';
include 'messages.php';



//echo insertNewCourse('111', 'Science', 'null');

/*
 *TESTING DATABASE VIA HTML FORMS 
 * #111 
 */


 // returning all the content from the form submitted by the user
 //via the submission form
$registeredName = $_POST['register-Name'];
$registeredEmail = $_POST['register-Email'];

//evaluateSubmittedInformation($registeredName,$registeredEmail);
//END OF CB #111


//PROPER EMAIL $connectToDatabase = mysqli_connect(getServerAddress(),getDailyDriverUN(),getDailyDriverUP() );
$connectToDatabase =  mysqli_connect(getServerAddress(),"root","" );
//echo getDailyDriverUN();

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


echo findServerYearDate();



mysqli_select_db($connectToDatabase, getDatabaseRef());
mysqli_query($connectToDatabase, insertNewRegisteredStudent(getSubmittedName(), getSubmittedEmail()) );
mysqli_close($connectToDatabase);
//function used to insert records into the database
//of registered individuals


/*
 * function used to compare if the submitted result is empty
 * and calls the functions to submit the accepted values
 * 
 * code block #1
 */
function evaluateSubmittedInformation($name,$email)
{
    if(strlen($name)<=0){
        
        die("Invalid Input Name from User");
    }
    
    
    if(strlen($email)<=0){
      
        die("Invalid Input Email from User");
    }
    
}


function getSubmittedName()
{
    global $registeredName;
    return $registeredName;
}

function getSubmittedEmail()
{
    global $registeredEmail;
    return $registeredEmail;
}
//end of code block #1