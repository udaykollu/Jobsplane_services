<?php

class HomeController extends BaseController 
{

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
	public function showWelcome($id)
	{// echo "id is".$id;
	
		//return View::make('hello');
	}
	
public function adduser($personName,$email,$personPhotoUrl,$personGooglePlusProfile)
	{ 
	//echo "in add user name is".$personName."email is".$email."photourl is".$personPhotoUrl."googleplus link is".$personGooglePlusProfile."<br>";
		//return View::make('hello');
		require_once __DIR__.'/../controllers/DbHandler.php';
//echo "in jobs php";
//$personName="uday";
//$personPhotoUrl="purl";
//$personGooglePlusProfile="gurl";
//$email="myeamil";
         
            
     
            $response = array();
            $db = new DbHandler();	
            
            // fetch task
			$result=$db->insertUser($personName,$personPhotoUrl,$personGooglePlusProfile,$email);
			//echo "true";
			$result='true';
			//return Response::json($result);
			return $result;

	}
	
	
	
	
	public function addpreferences($location,$email,$major,$jobcategory)
	{ 
	//echo "in add user name is".$personName."email is".$email."photourl is".$personPhotoUrl."googleplus link is".$personGooglePlusProfile."<br>";
		//return View::make('hello');
		require_once __DIR__.'/../controllers/DbHandler.php';

//echo "in addprefhome"."location is".$location."email is".$email."major is".$major."cat is".$jobcategory;
         
            
     
            $response = array();
            $db = new DbHandler();	
            
            // fetch task
			$result=$db->insertPreferences($location,$email,$major,$jobcategory);

	}

	
	public function search($searchTerm,$location)
	{
	require_once __DIR__.'/../controllers/DbHandler.php';

//echo "in search home key word is".$searchTerm;
$jobId;
            $response = array();
            $db = new DbHandler();

            // fetching all user tasks
            $result = $db->search($searchTerm,$location);

          //  $response["error"] = false;
            $response["jobs"] = array();

            // looping through result and preparing tasks array
            while ($task = $result->fetch_assoc()) {
                $tmp = array();
				$tmp["jobId"] = $task["jobid"];
				$tmp["title"] = $task["title"];
                $tmp["companyname"] = $task["companyname"];
                $tmp["companylogo"] = $task["companylogo"];
                $tmp["location"] = $task["location"];
                 $tmp["jobDescription"] = $task["jobDescription"];
				// $tmp["companywebsite"] = $task["companywebsite"];
                
                $tmp["jobcategory"] = $task["jobcategory"];
                $tmp["major"] = $task["major"];

                $tmp["dateposted"] = $task["dateposted"];
                $tmp["deadline"] = $task["deadline"];
                $tmp["jobDescription"] = $task["jobDescription"];
             //   $tmp["applicationURL"] = $task["applicationURL"]; 

                array_push($response["jobs"], $tmp);
            }

           // echoRespnse(200, $response);
         return Response::json($response);
		// return $response; 
	
	
	}
	
public function getAllJobs()
{
require_once __DIR__.'/../controllers/DbHandler.php';

//echo "in jobs php";
$jobId;
            $response = array();
            $db = new DbHandler();

            // fetching all user tasks
            $result = $db->getAllJobs();

          //  $response["error"] = false;
            $response["jobs"] = array();

            // looping through result and preparing tasks array
            while ($task = $result->fetch_assoc()) {
                $tmp = array();
				$tmp["jobId"] = $task["jobid"];
				$tmp["title"] = $task["title"];
                $tmp["companyname"] = $task["companyname"];
                $tmp["companylogo"] = $task["companylogo"];
                $tmp["location"] = $task["location"];
                 $tmp["jobDescription"] = $task["jobDescription"];
				// $tmp["companywebsite"] = $task["companywebsite"];
                
                $tmp["jobcategory"] = $task["jobcategory"];
                $tmp["major"] = $task["major"];

                $tmp["dateposted"] = $task["dateposted"];
                $tmp["deadline"] = $task["deadline"];
                $tmp["jobDescription"] = $task["jobDescription"];
             //   $tmp["applicationURL"] = $task["applicationURL"]; 

                array_push($response["jobs"], $tmp);
            }

           // echoRespnse(200, $response);
         return Response::json($response);
		// return $response;  
		   }	
	
///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////get user jobs//////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
               public function getUserJobs($email)
                  {
               require_once __DIR__.'/../controllers/DbHandler.php';

                 $jobId;
            $response = array();
            $db = new DbHandler();

            // fetching all user tasks
            $result = $db->getUserJobs($email);
          //  $response["error"] = false;
            $response["jobs"] = array();

            // looping through result and preparing tasks array
            while ($task = $result->fetch_assoc()) {
                $tmp = array();
                //$tmp["jobId"] = $task["jobId"];
                $tmp["title"] = $task["title"];
                $tmp["companyname"] = $task["companyname"];
                $tmp["companylogo"] = $task["companylogo"];
                $tmp["location"] = $task["location"];
                /* $tmp["companywebsite"] = $task["companywebsite"];
                
                $tmp["jobcategory"] = $task["jobcategory"];
                $tmp["major"] = $task["major"];

                $tmp["dateposted"] = $task["dateposted"];
                $tmp["deadline"] = $task["deadline"];
                $tmp["jobDescription"] = $task["jobDescription"];
                $tmp["applicationURL"] = $task["applicationURL"]; */

                array_push($response["jobs"], $tmp);
            }

           // echoRespnse(200, $response);
         return Response::json($response);
		// return $response;  
		   }	











	
public function JobDetails($id) 
{
     //  echo "home details id is ".$id;
	    require_once __DIR__.'/../controllers/DbHandler.php';
//require_once '../controllers/DbHandler.php';
//echo "in jobs php";
$jobId=1;
         
            
     
            $response = array();
            $db = new DbHandler();	
            
            // fetch task
            $result = $db->getJobDetails($id);

            if ($result != NULL) {
                //echo "Result is not null";
                $response["error"] = false;
                $response["jobId"] = $result["jobId"];
                $response["title"] = $result["title"];
                $response["companyname"] = $result["companyname"];
                $response["companylogo"] = $result["companylogo"];
                $response["companywebsite"] = $result["companywebsite"];
                $response["location"] = $result["location"];
                $response["jobcategory"] = $result["jobcategory"];
                $response["major"] = $result["major"];
                $response["datePosted"] = $result["datePosted"];
                $response["deadline"] = $result["deadline"];
                $response["jobDescription"] = $result["jobDescription"];
                $response["applicationURL"] = $result["applicationURL"];
               // echoRespnse(200, $response);
               //echo "before return";
			   return Response::json($response);
              //  return $response;
			 // return json_encode($response);
			// return json_encode(array('error'=>'false','jobid'=> $result["jobId"]),200);
            } else {
                $response["error"] = true;
                $response["message"] = "The requested resource doesn't exists";
              //  echoRespnse(404, $response);
			  return $response;
            }
       

}
/**
 * Echoing json response to client
 * @param String $status_code Http response code
 * @param Int $response Json response
 */

      
		}



