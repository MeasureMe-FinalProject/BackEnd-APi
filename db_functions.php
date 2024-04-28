<?php  
class DB_Functions{
	private $conn;

	function __construct()
	{
		require_once 'db_connect.php';
		$db = new DB_Connect();
		$this->conn = $db->connect();

	}

	function __destruct()
	{
		// TODO Implement __destruct() method
	}
  	
  	/*
	*Check user exits
	*return true/false
	*/

	public function checkExitsUser($email)
	{
		$stmt = $this->conn->prepare("SELECT * FROM users WHERE email=?");
		$stmt->bind_param("s",$email);
		$stmt->execute();
		$stmt->store_result();

		if ($stmt->num_rows > 0) 
		{
			$stmt->close();
			return true;
		}
		else {
			$stmt->close();
			return false;
		}
	}
        
    /*
	* Login user
	* return User if user was found
	*/

	public function loginAdmin($adminEmail, $adminPassword)
	{
		$stmt = $this->conn->prepare("SELECT id, name, email, password FROM users WHERE email=? AND password=?");
		$stmt->bind_param("ss", $adminEmail, $adminPassword);
		$stmt->execute();
		$token = $stmt->get_result()->fetch_assoc();
		$stmt->close();
		return $token;
	}
  
    /*
	* Register new user
	* return User if user was created
	* return error if have exception
	* return false and show error message if have expection
	*/
	public function registerNewUser($name,$email,$password)
	{
		$stmt = $this->conn->prepare("INSERT INTO users(name,email,password) VALUES(?,?,?)");
		$stmt->bind_param("sss",$name,$email,$password);
		$result=$stmt->execute();
		$stmt->close();
		
		if ($result) 
		{
			$stmt=$this->conn->prepare("SELECT * FROM users WHERE email = ?");
			$stmt->bind_param("s",$email);
			$stmt->execute();
			$user = $stmt->get_result()->fetch_assoc();
			$stmt->close();
			return $user;
		}
		else 
			return false;
	
	}

	/*
	* Save Measurement
	* return true/false
	*/

	public function saveResultMeasurement($id_user,$height,$size_recommendation,$bust_circumference,$waist_circumference,$hip_circumference,$shoulder_width,$sleeve_length,$pants_length)
	{
		$stmt = $this->conn->prepare("INSERT INTO measure(id_user,height,size_recommendation,bust_circumference,waist_circumference,hip_circumference,shoulder_width,sleeve_length,pants_length) VALUES(?,?,?,?,?,?,?,?,?)");
		$stmt->bind_param("sssssssss",$id_user,$height,$size_recommendation,$bust_circumference,$waist_circumference,$hip_circumference,$shoulder_width,$sleeve_length,$pants_length);
		$result=$stmt->execute();
		$stmt->close();
		
		
	
	}


	/*
	* Get All Measurement
	* return all data measurement from specific user
	*/

	public function getAllMeasurement($id_user)
	{
		$query = "SELECT * FROM measure WHERE id_user='".$id_user."'";
		$result = $this->conn->query($query);

		$measurement = array();

		while ($item = $result->fetch_assoc())
			$$measurement[] = $item;
		return $$measurement;
		
	}

}
?>