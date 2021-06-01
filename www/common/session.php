<?php
	function saveSession($uid, $pwd) {
		session_start();

		$_SESSION['uid'] = $uid;
		$_SESSION['pwd'] = $pwd;
	}

	function getSession() {
		include_once "query.php";

		session_start();

		$uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : NULL;
		$pwd = isset($_SESSION['pwd']) ? $_SESSION['pwd'] : NULL;

		$db = db();

		$query = sprintf('SELECT id, email, password, image_url FROM User WHERE email = "%s"', $uid);

		if ($result = query($db, $query)) {
			if ($row = $result->fetch_assoc()) {
				$hash = hash_hmac('SHA256', $pwd, $uid);
				if ($hash == $row['password'] && $uid == $row['email']) {
					$db->close();
					return $row;
				} else {
					deleteSession();
				}
		    }
		}

		$db->close();

		return false;
	}

	function deleteSession() {
		session_start();
		$_SESSION = array();
		session_destroy();	
	}
?>