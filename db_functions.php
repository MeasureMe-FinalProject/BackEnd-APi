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


	public function loginUser($email, $password) {
		// Prepare the SQL statement to find the user by email
		$stmt = $this->conn->prepare("SELECT id, name, email, password FROM users WHERE email = ?");
		$stmt->bind_param("s", $email); // Bind the email parameter
		$stmt->execute();

		// Fetch the result and check if a user was found
		$result = $stmt->get_result();
		$user = $result->fetch_assoc(); // Fetch user data
		$stmt->close(); // Close the statement

		// Verify the provided password with the stored one (plaintext)
		if ($user && $password === $user["password"]) { // Direct comparison
			return $user; // If the password is correct, return user data
		} else {
			return false; // If the password is incorrect or user not found, return false
		}
	}




  
    /*
	* Register new user
	* return User if user was created
	* return error if have exception
	* return false and show error message if have expection
	*/
	public function registerUser($name, $email, $password) {
		$stmt = $this->conn->prepare("INSERT INTO users(name, email, password) VALUES(?, ?, ?)"); // Insert with plaintext password (not recommended)
		$stmt->bind_param("sss", $name, $email, $password);
		$result = $stmt->execute(); // Attempt to insert into the database

		$stmt->close(); // Close the statement

		if ($result) {
			// If insertion is successful, fetch the user data
			$stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
			$stmt->bind_param("s", $email);
			$stmt->execute();
			$user = $stmt->get_result()->fetch_assoc(); // Fetch user data
			$stmt->close(); // Close the second statement
			return $user; // Return the user data
		} else {
			return false; // If insertion failed, return false
		}
	}



	/*
	* Save Measurement
	* return true/false
	*/


	public function saveResultMeasurement(
    $id_user,
    $height,
    $size_recommendation,
    $bust_circumference,
    $waist_circumference,
    $hip_circumference,
    $shoulder_width,
    $sleeve_length,
    $pants_length,
	$date,
	$type_clothes
	) {
		$stmt = $this->conn->prepare("
			INSERT INTO measure(
				id_user,
				height,
				size_recommendation,
				bust_circumference,
				waist_circumference,
				hip_circumference,
				shoulder_width,
				sleeve_length,
				pants_length,
				date,
				type_clothes
			) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
		");

		$stmt->bind_param(
			"sssssssssss",
			$id_user,
			$height,
			$size_recommendation,
			$bust_circumference,
			$waist_circumference,
			$hip_circumference,
			$shoulder_width,
			$sleeve_length,
			$pants_length,
			$date,
			$type_clothes
		);

		$result = $stmt->execute(); // Returns true if successful, false otherwise

		$stmt->close(); // Close the statement

		return $result; // Return the result of the execution
	}

	



	

	/*
	* Get All Measurement
	* return all data measurement from specific user
	*/

	public function getAllMeasurement($id_user) {
		// SQL query to fetch all measurements for a given user
		$stmt = $this->conn->prepare("SELECT * FROM measure WHERE id_user = ?");
		$stmt->bind_param("s", $id_user); // Bind the parameter to the query
		$stmt->execute();

		$result = $stmt->get_result();

		$measurements = []; // Initialize an empty array for measurements

		// Fetch the measurements and add them to the array
		while ($item = $result->fetch_assoc()) {
			$measurements[] = $item; // Append each measurement to the array
		}

		$stmt->close(); // Close the statement

		return $measurements; // Return the array of measurements
	}



	public function forgotPassword($email) {
		$stmt = $this->conn->prepare("SELECT password FROM users WHERE email = ?"); // SQL query with bound parameter
		$stmt->bind_param("s", $email); // Bind the parameter to the query
		$stmt->execute(); // Execute the query
		
		$result = $stmt->get_result(); // Get the result set
		$user = $result->fetch_assoc(); // Fetch user data
		$stmt->close(); // Close the statement

		return $user; // Return the user data if found, otherwise null
	}


	

	
	public function updateProfile($email, $fileName, $name, $birthday, $gender, $height) {
		// Prepare SQL statement
		$stmt = $this->conn->prepare("UPDATE users SET photo = ?, name = ?, birthday = ?, gender = ?, height = ? WHERE email = ?");

		// Bind parameters
		$stmt->bind_param("ssssss", $fileName, $name, $birthday, $gender, $height, $email);

		// Execute and check result
		$success = $stmt->execute();

		// Close the statement
		$stmt->close();

		return $success; // Return true if successful, false otherwise
	}

	


	public function verifyPlaintextPassword($email, $old_password) {
		$stmt = $this->conn->prepare("SELECT password FROM users WHERE email = ?");
		$stmt->bind_param("s", $email); // Bind the parameter
		$stmt->execute();
		
		$stmt->bind_result($stored_password); // Get the stored password
		$stmt->fetch(); // Fetch the result
		$stmt->close(); // Close the statement
		
		return $old_password === $stored_password; // Return true if the passwords match
	}

	public function updatePlaintextPassword($email, $new_password) {
		$stmt = $this->conn->prepare("UPDATE users SET password = ? WHERE email = ?");
		$stmt->bind_param("ss", $new_password, $email); // Bind the parameters
		$result = $stmt->execute(); // Execute the query
		
		$stmt->close(); // Close the statement
		
		return $result; // Return true if successful, false otherwise
	}

	public function checkUserExists($id_user) {
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE id = ?");
        $stmt->bind_param("s", $id_user);
        $stmt->execute();
        $stmt->store_result();

        $exists = $stmt->num_rows > 0;
        $stmt->close();

        return $exists;
    }

    public function checkMeasurementExists($id_measurement) {
        $stmt = $this->conn->prepare("SELECT id FROM measure WHERE id = ?");
        $stmt->bind_param("s", $id_measurement);
        $stmt->execute();
        $stmt->store_result();

        $exists = $stmt->num_rows > 0;
        $stmt->close();

        return $exists;
    }

    public function deleteMeasurement($id_user, $id_measurement) {
        // Check if the user exists
        if (!$this->checkUserExists($id_user)) {
            return "user_not_found";
        }

        // Check if the measurement exists for the given user
        $stmt = $this->conn->prepare("SELECT id FROM measure WHERE id = ? AND id_user = ?");
        $stmt->bind_param("ss", $id_measurement, $id_user);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 0) {
            $stmt->close();
            return "measurement_not_found";
        }

        $stmt->close();

        // If the ID exists, proceed with the deletion
        $stmt = $this->conn->prepare("DELETE FROM measure WHERE id = ? AND id_user = ?");
        $stmt->bind_param("ss", $id_measurement, $id_user);
        $result = $stmt->execute(); // Execute the delete query

        $stmt->close(); // Close the statement

        return $result ? "success" : "failed"; // Return the result of the execution
    }



}
?>