<?php

include('models.php');
include('system_settings_config.php');


$SystemSettings = new CeitSettings();
$systemMessages = new SystemMessages();
$procedureRef = new refMysqlProc();



/*
ATTEMPTING TO CONNECT TO A DESIRED DATABASE
CODE BLOCK 1
*/
$connectToDatabase = mysqli_connect($SystemSettings->getSystemName(),$SystemSettings->getPublicUserName(),$SystemSettings->getPublicUserPass());

if(!$connectToDatabase)
{
	die($systemMessages->getErrorCannotDBConnect());
}
else
$systemMessages->getMessageSuccessDBConnect();
//END OF CODE BLOCK 1


mysqli_select_db($connectToDatabase,$SystemSettings->getDateBaseName());
$dataBaseResult = mysqli_query($connectToDatabase,$procedureRef->showActBatches());

mysqli_close($connectToDatabase); //closes the database connection


// GET COURSE BATCH DATA
$coursebatches = array();
if ($dataBaseResult->num_rows > 0)
{
	// echo "<table border=1 width=50%>";
  //         echo "<tr>";

      while ($rowResult = $dataBaseResult->fetch_assoc())
      {
        $cb = new CourseBatch();
        $cb->id = $rowResult['id'];
        $cb->summary = $rowResult['courseSummary'];
        $cb->courseid = ""; // TODO: get course id
        $cb->coursename = $rowResult['courseName'];
        $cb->availableseats = $rowResult['availableSeats'];
        $cb->maxseats = $rowResult['maxSeats'];
        $cb->startdate = $rowResult['startDate'];
        $cb->endate = $rowResult['endDate'];
        $cb->teacher = $rowResult['lecturerFK'];
        // echo "<td>".$rowResult['id']."</td><td>".$rowResult['courseStatus']."</td><td>".$rowResult['courseName']."</td><td>".$rowResult['courseSummary']."</td><td>".$rowResult['lecturerFK']."</td><td>".$rowResult['schoolYr']."</td><td>".$rowResult['startDate']."</td><td>".$rowResult['endDate']."</td><td>".$rowResult['availableSeats']."</td><td>".$rowResult['maxSeats']."</td></tr>";
        $coursebatches[] = $cb;
      }//end of while loop

	// echo "</table>";
}//end of parent if statement

// TODO: GET BATCH TIMESLOT DATA
$batchtimeslots = array();


/* place both arrays in an outer array */
$result = array($coursebatches, $batchtimeslots);
/* convert to JSON and return data to website */
return json_encode($result);
/*
will execute if we have an actual result
*/

?>