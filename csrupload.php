<?php
foreach ($_FILES["csr"]["error"] as $key => $error) {
	if ($error == UPLOAD_ERR_OK) {
		$tmp_name = $_FILES["csr"]["tmp_name"][$key];
		$name = $_FILES["csr"]["name"][$key];
		move_uploaded_file($tmp_name, "data/$name");
	}
}
?>