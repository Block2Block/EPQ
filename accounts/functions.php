<?php
include_once 'db-connect.php';

function sec_session_start() {
    $session_name = 'epq_session_id';   // Set a custom session name 
    $secure = false;
	
    // This stops JavaScript being able to access the session id.
    $httponly = true;
	
    // Forces sessions to only use cookies.
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        header("Location: ../error?err=Could not initiate a safe session (ini_set)");
        exit();
    }
	
    // Gets current cookies parameters.
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);
	
    // Sets the session name to the one set above.
    session_name($session_name);
    session_start();            // Start the PHP session 
    session_regenerate_id();    // regenerated the session, delete the old one. 
}

function login($email, $password, $mysqli) {
    // Using prepared statements means that SQL injection is not possible. 
    if ($sql = $mysqli->prepare("SELECT 'User ID', Name, Password 
        FROM accounts
       WHERE Email = ?
        LIMIT 1")) {
        $sql->bind_param('s', $email);  // Binds the email to the parameter.
        $sql->execute();    // Execute the prepared query.
        $sql->store_result();
 
        // get variables from result.
        $sql->bind_result($user_id, $name, $db_password);
        $sql->fetch();	
 
        if ($sql->num_rows == 1) {
            // If the user exists we check if the account is locked
            // from too many login attempts 
 
            if (checkbrute($user_id, $mysqli) == true) {
                // Account is locked 
                return false;
            } else {
                // Check if the password in the database matches
                // the password the user submitted.
                if (password_verify($password, $db_password)) {
                    // Password is correct!
                    // Get the user-agent string of the user.
                    $user_browser = $_SERVER['HTTP_USER_AGENT'];
					
                    // Cross-site scripting protection as we might print this value
                    $user_id = preg_replace("/[^0-9]+/", "", $user_id);
                    $_SESSION['user_id'] = $user_id;
					
                    // Cross-site scripting protection as we might print this value
                    $email = preg_replace("/[^a-zA-Z0-9_\-]+/", 
                                                                "", 
                                                                $email);
                    $_SESSION['email'] = $email;
					
                    $_SESSION['login_string'] = hash('sha512', 
                              $db_password . $user_browser);
                    // Login successful.
                    return true;
                } else {
                    // Password is not correct
                    // We record this attempt in the database
                    $now = time();
                    $mysqli->query("INSERT INTO login_attempts('User ID', Time)
                                    VALUES ('$user_id', '$now')");
                    return false;
                }
            }
        } else {
            // No user exists.
            return false;
        }
    }
}

function checkbrute($user_id, $mysqli) {
    // Get timestamp of current time (in seconds)
    $now = time();
 
    // All login attempts are counted from the past 2 hours (60 seconds * 60 minutes * 2 hours). 
    $valid_attempts = $now - (2 * 60 * 60);
 
    if ($sql = $mysqli->prepare("SELECT time 
                             FROM brute-force-check 
                             WHERE user_id = ? 
                            AND time > '$valid_attempts'")) {
        $sql->bind_param('i', $user_id);
 
        // Execute the prepared query. 
        $sql->execute();
        $sql->store_result();
 
        // If there have been more than 5 failed logins 
        if ($sql->num_rows > 5) {
            return true;
        } else {
            return false;
        }
    }
}

function login_check($mysqli) {
    // Check if all session variables are set 
    if (isset($_SESSION['user_id'], 
                        $_SESSION['email'], 
                        $_SESSION['login_string'])) {
 
        $user_id = $_SESSION['user_id'];
        $login_string = $_SESSION['login_string'];
        $email = $_SESSION['email'];
 
        // Get the user-agent string of the user.
        $user_browser = $_SERVER['HTTP_USER_AGENT'];
 
        if ($sql = $mysqli->prepare("SELECT Password 
                                      FROM `accounts` 
                                      WHERE 'User ID' = ? LIMIT 1")) {
            // Bind "$user_id" to parameter. 
            $sql->bind_param('i', $user_id);
            $sql->execute();   // Execute the prepared query.
            $sql->store_result();
 
            if ($sql->num_rows == 1) {
                // If the user exists get variables from result.
                $sql->bind_result($password);
                $sql->fetch();
                $login_check = hash('sha512', $password . $user_browser);
				
 
                if (hash_equals($login_check, $login_string) ){
                    // Logged In!!!! 
                    return true;
                } else {
                    // Not logged in 
                    return false;
                }
            } else {
                // User doesn't exists, so is not logged in.
                return false;
            }
        } else {
            // Failed to prepare the SQL statement 
            return false;
        }
    } else {
        // Not logged in 
        return false;
    }
}

function get_name($user_id,$mysqli) {
	if ($sql = $mysqli->prepare("SELECT `Name` FROM `accounts` WHERE 'User ID' = ?")) {
		$sql->bind_param("i",$user_id);
		if ($sql->execute()) {
			$sql->store_result();
			$sql->bind_result($result);
			$sql->fetch();
			return $result;
		}
	}
	
}

function esc_url($url) {
 
    if ('' == $url) {
        return $url;
    }
 
    $url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);
 
    $strip = array('%0d', '%0a', '%0D', '%0A');
    $url = (string) $url;
 
    $count = 1;
    while ($count) {
        $url = str_replace($strip, '', $url, $count);
    }
 
    $url = str_replace(';//', '://', $url);
 
    $url = htmlentities($url);
 
    $url = str_replace('&amp;', '&#038;', $url);
    $url = str_replace("'", '&#039;', $url);
 
    if ($url[0] !== '/') {
        // We're only interested in relative links from $_SERVER['PHP_SELF']
        return '';
    } else {
        return $url;
    }
}

function change_name ($name, $new, $mysqli) {
	// check existing username
    $prep_sql = "SELECT 'User ID' FROM accounts WHERE name = ? LIMIT 1";
    $sql = $mysqli->prepare($prep_sql);
 
    if ($sql) {
        $sql->bind_param('s', $new);
        $sql->execute();
        $sql->store_result();
 
        if ($sql->num_rows == 1) {
			// A user with this username already exists
			header('Location: ../error.php?err=A user with this name already exists!');
			$sql->close();
        } else {
			if ($sql2 = $mysqli->prepare("UPDATE `accounts` SET `Name` = ? WHERE Name = ?")) {
				$sql2->bind_param("ss",$new,$name);
				if ($sql2->execute()) {
					header('Location: ../success.php');
					return;
				}
			}
			header('Location: ../error.php?err=Unable to change username!');
		}
    } else {
        header('Location: ../error.php?err=Database error!');
        $sql->close();
	}
}

function change_pass($name, $new, $mysqli) {
		if ($sql = $mysqli->prepare("UPDATE `accounts` 
        SET `Password`= ?
       WHERE Name = ?
        LIMIT 1")) {
			$password = password_hash($new, PASSWORD_BCRYPT);
			$sql->bind_param('si', $password, $name);
			if ($sql->execute()) {
                // Password is in the database!
                // Get the user-agent string of the user.
                $user_browser = $_SERVER['HTTP_USER_AGENT'];
				
				//Updating cookie with new password for validation of being logged in (so they don't get logged out).
				$_SESSION['login_string'] = hash('sha512', 
                              $password . $user_browser);
				header('Location: ../success.php');
				return;
			}
		}
		header('Location: ../error.php?err=Unable to change password!');
}