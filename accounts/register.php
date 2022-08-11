<?php
include_once 'db-connect.php';
include_once 'db-config.php';

$error_msg = "";

if (isset($_POST['name'], $_POST['email'], $_POST['p'])) {
	// Sanitize the data passed in
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
	
	//Validating the email entered
	$email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Not a valid email
        $error_msg .= 'The email address you entered is not valid';
    }
 
    $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
	if (strlen($password) != 128) {
		//It does not have 128 characters
        $error_msg .= 'Invalid password configuration.';
    }
	
	// check existing username
    $prep_sql = "SELECT 'User ID' FROM accounts WHERE Email = ? LIMIT 1";
    $sql = $mysqli->prepare($prep_sql);
	
	if ($sql) {
        $sql->bind_param('s', $email);
        $sql->execute();
        $sql->store_result();
 
        if ($sql->num_rows == 1) {
                        // A user with this username already exists
                        $error_msg .= 'A user with this username already exists';
                        $sql->close();
                
        }
    } else {
            $error_msg .= 'Database error, please try again.';
            $sql->close();
    }
	
	if (empty($error_msg)) {
 
    	// Create hashed password using the password_hash function.
    	// This function salts it with a random salt and can be verified with
    	// the password_verify function.
    	$password = password_hash($password, PASSWORD_BCRYPT);
 
    	// Insert the new user into the database 
    	if ($insert_sql = $mysqli->prepare("INSERT INTO accounts (Email, Password, Name) VALUES (?, ?, ?)")) {
        	$insert_sql->bind_param('sss', $email, $password, $name);
        	// Execute the prepared query.
        	if (! $insert_sql->execute()) {
            	header('Location: ../error?err=Registration failure: INSERT');
        	}
    	}
    header('Location: ../success');
	}
	
}

?>