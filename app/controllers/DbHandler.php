<?php

/**
 * Class to handle all db operations
 * This class will have CRUD methods for database tables
 *
 * @author Ravi Tamada
 * @link URL Tutorial link
 */
class DbHandler extends BaseController{

    private $conn;
//echo "in handler";
    function __construct() {
        require_once dirname(__FILE__) . '/DbConnect.php';
        // opening db connection
        $db = new DbConnect();
        $this->conn = $db->connect();
    }

    /* ------------- `users` table method ------------------ */


    

    /* ------------- `tasks` table method ------------------ */

    /**
     * Creating new task
     * @param String $user_id user id to whom task belongs to
     * @param String $task task text
     */
    

    /**
     * Fetching single task
     * @param String $task_id id of the task
     */
    public function getJobDetails($jobId) {
     //  echo "dbhandler details";
        $stmt = $this->conn->prepare("SELECT * from jobs WHERE jobId = ?");
        $stmt->bind_param("i", $jobId);
        if ($stmt->execute()) {
            $res = array();
            $stmt->bind_result($jobId, $title, $companyname, $companylogo,$companywebsite,$location, $jobcategory, $major, $datePosted, $deadline, $jobDescription, $applicationURL);
            // TODO
            // $task = $stmt->get_result()->fetch_assoc();
            $stmt->fetch();
            $res["jobId"] = $jobId;
            $res["title"] = $title;
            $res["companyname"] = $companyname;
            $res["companylogo"] = $companylogo;
            $res["companywebsite"] = $companywebsite;
            $res["location"] = $location;
            $res["jobcategory"] = $jobcategory;
            $res["major"] = $major;
            $res["datePosted"] = $datePosted;
            $res["deadline"] = $deadline;
            $res["jobDescription"] = $jobDescription;
            $res["applicationURL"] = $applicationURL;
            $stmt->close();

            

            return $res;
        } else {
            return NULL;
        }
    }

    /**
     * Fetching all user tasks
     * @param String $user_id id of the user
     */
    public function getAllJobs() {
        $stmt = $this->conn->prepare("SELECT jobid,title,companyname,companylogo,location,jobcategory,major,dateposted,deadline,jobDescription,applicationurl FROM jobs");
        //$stmt->bind_param("i", $user_id);
        $stmt->execute();
        $tasks = $stmt->get_result();
        $stmt->close();
        return $tasks;
    }

	public function search($searchTerm,$location)
 	{
	$nsearchTerm=   "%$searchTerm%" ;
	$nlocation="%$location%";
	if($location==null)
	    {
	 $stmt = $this->conn->prepare("SELECT jobid,title,companyname,companylogo,location,jobcategory,major,dateposted,deadline,jobDescription,applicationurl FROM jobs j where j.companyname like ? or j.title like ? or jobDescription like ? ");
        $stmt->bind_param("sss",$nsearchTerm,$nsearchTerm,$nsearchTerm);
        $stmt->execute();
        $tasks = $stmt->get_result();
        $stmt->close();
		return $tasks;
		}
	else
	    {
        $stmt = $this->conn->prepare("SELECT jobid,title,companyname,companylogo,location,jobcategory,major,dateposted,deadline,jobDescription,applicationurl FROM jobs j where j.companyname like ? or j.title like ? or jobDescription like ? and location like ?");
        $stmt->bind_param("ssss",$nsearchTerm,$nsearchTerm,$nsearchTerm,$nlocation);
        $stmt->execute();
        $tasks = $stmt->get_result();
        $stmt->close();
		return $tasks;
		}
        
    }
	
	 public function getUserJobs($email) {
	// echo "email is ".$email;
        $stmt = $this->conn->prepare("select j.jobid,j.title,j.companyname,j.companylogo,j.location from jobs j, preferences p where  j.location=p.location or j.jobcategory =p.jobcategory or j.major=p.major and p.email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $tasks = $stmt->get_result();
        $stmt->close();
        return $tasks;
    }

     public function insertUser($personName,$personPhotoUrl,$personGooglePlusProfile,$email) {
        $stmt = $this->conn->prepare("insert into users(personName,personPhotoUrl,personGooglePlusProfile,email) values(?,?,?,?)");
        $stmt->bind_param("ssss", $personName,$personPhotoUrl,$personGooglePlusProfile,$email);
        $stmt->execute();
        $tasks = $stmt->get_result();
        $stmt->close();
        return $tasks;
		//echo $personName."".$personPhotoUrl."".$personGooglePlusProfile."".$email ;
    }
	
	public function insertPreferences($location,$email,$major,$jobcategory) {
        $stmt = $this->conn->prepare("insert into preferences(location,email,major,jobcategory) values(?,?,?,?)");
        $stmt->bind_param("ssss", $location,$email,$major,$jobcategory);
        $stmt->execute();
        //$tasks = $stmt->get_result();
        //$stmt->close();
        //return $tasks;
		//echo $personName."".$personPhotoUrl."".$personGooglePlusProfile."".$email ;
    }
    

}

?>
