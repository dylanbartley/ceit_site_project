<?php

/*
Date Created: Aug 21 2017
Descrip: Script used to place all global values in a 
*/


class CeitSettings{

/*
VARIABLES********************************************/
private $publicUserAccount="internetUser";
private $publicUserPassword="331A11AC61113EDDC283C5BEC8996";
private $subAdminAccount = "ceitdbuser";
private $subAdminAccountPassword="4E5F9888F0BB1EC597E58BC341053660F";
private $systemHost="localhost";
private $systemPortNumber=0000;
private $dataBaseName="ceitdominicaregister_dm_db";
private $developer0="Macaully Tavernier";
private $developer1="Dylan Bartly";
private $portNumberSign=":";
//*********************************************************




//set and getters for developers names if needed CODE BLOCK #1
private function getDeveloper0()
{
	return $this->developer0;
}

private function getDeveloper1()
{
	return $this->developer1;
}

public function getDevelopers(){
	echo "Project Created by :".$this->getDeveloper0()." & ".$this->getDeveloper1();
}
//end of setters CODEBLOCK #1



//GETTING THE NAME OF THE DATABASE
public function getDateBaseName()
{
	return $this->dataBaseName;
}


/*
OBTAINING THE INFORMATION OF THE SERVER ITSELF CODE BLOCK 2
*/
//get the systemname and port number
public function getSystemName()
{
	return $this->systemHost;
}

protected function getSystemPortNumber()
{
	return $this->systemPortNumber;
}

protected function getPortNumberSign()
{
	return $this->portNumberSign;
}

/*
*******END OF CODE BLOCK 2 *************************************
*/


/*

GET THE USERNAME AND PASSWORD FOR THE PUBLIC USER ACCOUNT AND 
SUBADMIN ACCOUNT


CODE BLOCK #3
*/

protected function getSubAdminUserName()
{
	return $this->subAdminAccount;
}

protected function getSubAdminUserPassword()
{
	return $this->subAdminAccountPassword;
}

public function getPublicUserName()
{
	return $this->publicUserAccount;
}

public function getPublicUserPass()
{
	return $this->publicUserPassword;
}

/*END OF CODE BLOCK #3*****************************/






}

/*
END OF CLASS CEITSETTINGS
*/



/*

CLASS USED TO DISPLAY ALL THE ERRORS ETC MESSAGES 
*/
class SystemMessages{
private $errorCannotConnectToDatabase = "ERROR CANNOT CONNECT TO DATABASE"."<br>";
private $connectedToDB ="***DEVELOPMENT PURPOSES******* we are connected :)"."<br>";


public function getErrorCannotDBConnect(){ echo $this->errorCannotConnectToDatabase;}
public function getMessageSuccessDBConnect() { echo $this->connectedToDB;}

}
/*
END OF CLASS SYSTEMMESSSAGES
*/


/*

CLASS MYSQL PROCEDURES
USED AS A REFERENCE FOR CALLING THE DESIRED PROCEDURES WHEN NEEDED
*/

class refMysqlProc
{


//shows all the courses with the status of PENDING & ONGOING --no added attribute
private $pro_displayCourseBatches ="displayCourseBatches";
private $closedParent="()";
private $procedureCall= "call ";

//------------------------------------------------------------

private function getCallKey(){ return $this->procedureCall;}
private function getDisplayCourseBatches(){ return $this->pro_displayCourseBatches;}

public function showActBatches(){return $this->getCallKey().$this->getDisplayCourseBatches();}


}
//end of class refMysqlProc

?>