<?php

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

//END OF CB #111

echo "data".getDatabaseRef();
$connectToDatabase = mysqli_connect(getServerAddress(),'root','');



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
mysqli_query($connectToDatabase, insertNewCourse("999", "Mathematics", "null"));
mysqli_close($connectToDatabase);
//function used to insert records into the database
//of registered individuals
