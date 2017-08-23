<?php

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


if ($dataBaseResult->num_rows > 0)
{
	echo "<table border=1 width=50%>";
          echo "<tr>";

      while ($rowResult = $dataBaseResult->fetch_assoc())
      {

        echo "<td>".$rowResult['id']."</td><td>".$rowResult['courseStatus']."</td><td>".$rowResult['courseName']."</td><td>".$rowResult['courseSummary']."</td><td>".$rowResult['lecturerFK']."</td><td>".$rowResult['schoolYr']."</td><td>".$rowResult['startDate']."</td><td>".$rowResult['endDate']."</td><td>".$rowResult['availableSeats']."</td><td>".$rowResult['maxSeats']."</td></tr>";
      
      }//end of while loop

	echo "</table>";
}//end of parent if statement
/*
will execute if we have an actual result
*/

?>