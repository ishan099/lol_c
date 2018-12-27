<?php

/**
 * @author achintha
 * @copyright 2014
 */

require_once("PHPVoiceLibrary/class.PlayFileAndGetDigits.php");
require_once("PHPVoiceLibrary/class.DialNumber.php");
require_once("PHPVoiceLibrary/class.Ards.php");
require_once("config.php");
include_once("WriteLog.php");


$objPlayFile = new PlayFileAndGetDigits();
$wrtLg = new WriteLog();
$wrtLg->WriteFile("menu");

//$objPlayFile->
$calldata = json_decode($HTTP_RAW_POST_DATA,true);

//$calldata = json_decode('{"session":"e617051a-dd83-4da7-afd2-a9b298d05387","direction":"inbound","ani":"767447902","dnis":"0112024949","name":"767447902","result":"none","dev_params":{"profile":"59e405980f940d00016f4e09","FirstMenu":"A","tags":[],"Params_Test":"test"}}',true);
$wrtLg->WriteFile("menu \t - ".$HTTP_RAW_POST_DATA." - ".date("Y-m-d H:i:s"));

$result= $calldata["result"];
$session = $calldata["session"];
$ani=$calldata["ani"];
$dnis=$calldata["dnis"];
$callerdirection=$calldata["direction"];
$calleridname=$calldata["name"];


$wrtLg->WriteFile("menu \t  result  \t - ".$result." - ".date("Y-m-d H:i:s"));
$wrtLg->WriteFile("menu \t  session \t - ".$session." - ".date("Y-m-d H:i:s"));
$wrtLg->WriteFile("menu \t  ani \t - ".$ani." - ".date("Y-m-d H:i:s"));
$wrtLg->WriteFile("menu \t  dnis \t - ".$dnis." - ".date("Y-m-d H:i:s"));
$wrtLg->WriteFile("menu \t  callerdirection  \t - ".$callerdirection." - ".date("Y-m-d H:i:s"));
$wrtLg->WriteFile("menu \t  calleridname \t - ".$calleridname." - ".date("Y-m-d H:i:s"));
//{"action": "playandgetdigits","file": "Duo_IVR_Menu.wav","nexturl": "http://192.168.1.195/IVR/Process.php","result": "result","errorfile": "","digittimeout": "20","inputtimeout": "100","loops": "2","terminator": "#","strip": "#","maxdigits"3""digits": "1"}
//{"action": "playandgetdigits","file": "Duo_IVR_Menu.wav","nexturl": "http://192.168.1.195/IVR/ivrProcess.php","result": "result","errorfile": "","digittimeout" : 20,"inputtimeout" : 100,"loops" : 2,"terminator" : "#","strip" : "#","maxdigits" : "2","digits" : 1}';

$lines_array = file("PhoneNumber.conf");
//print_r($lines_array);
//print(trim($lines_array[0]));
$dialNumber=trim($lines_array[0]);

$folder=substr($_SERVER['REQUEST_URI'],0,strrpos($_SERVER['REQUEST_URI'],"/")+1);
//$nextURL="http://".$GLOBALS['host'].":".$GLOBALS['port'].$folder.$nextFile;
//print ("MMMMMM--".$nextURL);

$dateget=getdate();
$day =  $dateget['weekday'];
//echo $day;
$time= date("H.i");
$wrtLg->WriteFile("menu--------------------------- \t  time - ".$day." ----- ".$time);
$nextFile = "end.php";
if ($day == "Sunday")
{
//dial Exten
if( (09.00<$time) && ($time<14.00))
{
  //  print(date("H:i:s"));
//Menue
//        $result = PlayFileAndGetDigits();
        $result = SetArds($nextFile,"http://localhost/IVR/end.json","FirstDigit","4","Bmaskill","Bmaskill","hold","","6","1",true);
	$wrtLg->WriteFile("menu----------------------------------------- \t  time - ".$day." -- ".$time);
        print $result;
}
  else
  {
//dial exten
	$result= DirectDial($nextFile,"",$result,"public",$dev_params,"Dial_ext","XML",$ani,$ani,$dialNumber,"true");
        $wrtLg->WriteFile("menu----------------------------------------- \t  time else - ".$day." -- ".$time);
	print $result;
  }

}
elseif ($day == "Saturday")
{
  //     $time= date("H.i");
  if( (08.30<$time) && ($time<13.30))
  {
  //  print(date("H:i:s"));
//Menue
//        $result = PlayFileAndGetDigits();
        $result = SetArds($nextFile,"http://localhost/IVR/end.json","FirstDigit","4","Bmaskill","Bmaskill","hold","","6","1",true);
        $wrtLg->WriteFile("menu----------------------------------------- \t  time - ".$day." -- ".$time);
        print $result;
  }
  else
  {
//dial exten
        $result= DirectDial($nextFile,"",$result,"public",$dev_params,"Dial_ext","XML",$ani,$ani,$dialNumber,"true");
        $wrtLg->WriteFile("menu----------------------------------------- \t  time else - ".$day." -- ".$time);
        print $result;

  }

}
else
{
	if( (08.30<$time) && ($time<18.00))
        {
//       print(date("H:i:s"));
//      $result = PlayFileAndGetDigits();
        $result = SetArds($nextFile,"http://localhost/IVR/end.json","FirstDigit","4","Bmaskill","Bmaskill","hold","","6","1",true);
        $wrtLg->WriteFile("menu----------------------------------------- \t  time  - ".$day." -- ".$time);
	print $result;
        }
	else
	{
        $result= DirectDial($nextFile,"",$result,"public",$dev_params,"Dial_ext","XML",$ani,$ani,$dialNumber,"true");
        $wrtLg->WriteFile("menu----------------------------------------- \t  time else - ".$day." -- ".$time);
        print $result;
	}
}

function PlayFileAndGetDigits()
        {
        try
          {
               $objPlayFile = new PlayFileAndGetDigits();
		$nextURL="ProcessMenu.php";

		//$objPlayFile->SetFile("ivr-menu.wav");
		$objPlayFile->SetFile("MenuBM.wav");
		$objPlayFile->SetNextUrl($nextURL);
		$objPlayFile->SetResult("result");
		$objPlayFile->SetErrorFile("");
		$objPlayFile->SetDigitTimeout("1");
		$objPlayFile->SetInputTimeout("8000");
		$objPlayFile->SetLoops("1");
		$objPlayFile->SetTerminator("#");
		$objPlayFile->SetStrip("#");
		$objPlayFile->SetMaxDigits(3);
		$objPlayFile->SetDigits(3);
		$objPlayFile->SetEventLog(true);
		$objPlayFile->SetSkillDisplay("MainMenu");
		$objPlayFile->SetDisplay("MainMenu");
		//$objPlayFile->etResult();
		//print($objPlayFile->GetResult());
                $result = $objPlayFile->GetResult();
                return $result;
                }
                catch (exception $ex)
                {
                        return $ex;
                }
        }


        function DirectDial($nexturl,$app,$result,$context,$params,$display,$dialplan,$callername,$callernumber,$number,$eventLog)
        {
            try
             {
                $dialNum = new DialNumber();

                $dialNum->SetNextUrl($nexturl);
                $dialNum->SetApp("");
                $dialNum->SetResult($result);
                $dialNum->SetContext($context);
                $dialNum->SetParams($params);
                $dialNum->SetDisplay($display);
                $dialNum->SetDialplan($dialplan);
                $dialNum->SetCallerName($callername);
                $dialNum->SetCallerNumber($callernumber);
                $dialNum->SetNumber($number);
                $dialNum->SetEventlog($eventLog);

                $result = $dialNum->GetResult();
                return $result;

             }
            catch(exception $ex)
             {
                return $ex;
             }
        }

function SetArds($nexturl,$posturl,$result,$skill,$skillDisplay,$displayNode,$profile,$priority,$company,$tenant,$eventlog)
        {
//$wrtLg->WriteFile("ProcessIVR>>>>SetArds>>>>>".$nexturl."--".$posturl."--".$skill.">>case 0 >>>>>>>>> -".$profile."  - ".date("Y-m-d H:i:s"));
            try
             {
                $ards = new Ards();

                $ards->SetNextUrl($nexturl);
                $ards->SetPostUrl($posturl);
                $ards->SetResult($result);
                $ards->SetSkill($skill);
                $ards->SetSkillDisplay($skillDisplay);
                $ards->SetDisplay($displayNode);
                $ards->SetProfile($profile);
                $ards->SetPriority($priority);
                $ards->SetCompany($company);
                $ards->SetTenant($tenant);
                $ards->SetEventLog($eventlog);

                $result = $ards->GetResult();

        //        $wrtLg->WriteFile("ProcessIVR>>>>SetArds>>>>>".$result."-- - ".date("Y-m-d H:i:s"));
                $result = $ards->GetResult();
                return $result;

             }
            catch(exception $ex)
             {
                return $ex;
             }
        }



?>
 
