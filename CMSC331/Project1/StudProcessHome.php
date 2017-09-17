<?php
session_start();

//Menu selection process
//depending on user's choice
//it will link to corresponding page

if($_POST["selection"] == 'Signup'){
	header('Location: 03StudSelectType.php');
}
elseif($_POST["selection"] == 'View'){
	header('Location: 04StudViewApp.php');
}
elseif($_POST["selection"] == 'Reschedule'){
	$_SESSION["resch"] = true;
	header('Location: 03StudSelectType.php');
}
elseif($_POST["selection"] == 'Cancel'){
	header('Location: 05StudCancelApp.php');
}
elseif($_POST["selection"] == 'Search'){
	header('Location: 09StudSearchApp.php');
}
elseif($_POST["selection"] == 'Edit'){
	header('Location: 06StudEditInfo.php');
}

?>