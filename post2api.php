<?php
//
// 11.06.13 jfinn Created this includable function for the purposes of posting 
//		  data to a web API.  The function takes 3 arguments.. First,
//		  an array to be encoded & sent to the api.  2nd, the url of the
//                service to which we are posing. 3rd, the post type..
//		  this type can either be json or yaml and may possibly be expanded
//		  to include things like xml in the future.  
//
//		The function will return the cURL response.
//
//		Depenedent on Spyc.php https://github.com/mustangostang/spyc/
//
//
//
include("spyc/Spyc.php");

//EXAMPLE USAGE:
//$myData=array("debug"=>1,"force"=>1,"svc_uid"=>"admin","svc_pw"=>"adminmgr","uid"=>"jondoe","op"=>"delete","role"=>"cn=nsmanageddisabledrole,dc=myco,dc=com");
//echo post2api($myData, "http://it.mycompany.com/api/role.json.php", "json");

function post2api($data, $url, $type) { 

  switch ($type) {
    case "json": $postData = json_encode($data);
                 $contentType = "application/json";
 		break;
    case "yaml": $postData = Spyc::YAMLDump($data);
		 $contentType = "text/yaml";
		break;
  }

  // Setup cURL

  $ch = curl_init($url);
  curl_setopt_array($ch, array(
      CURLOPT_POST => TRUE,
      CURLOPT_RETURNTRANSFER => TRUE,
      CURLOPT_HTTPHEADER => array(
          'Content-Type: $contentType'
      ),
      CURLOPT_POSTFIELDS => $postData
  ));
  
  // Send the request
  $response = curl_exec($ch);
  
  // Check for errors
  if($response === FALSE){
      die(curl_error($ch));
  }

  // Return the data from the response
  return ($response);
}
?>
