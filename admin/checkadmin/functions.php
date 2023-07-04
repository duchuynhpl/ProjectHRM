<?php

function is_administrator($user = 'duchuynh') {
	return (isset($_SESSION['username']) && ($_SESSION['username'] === $user));
}
?>