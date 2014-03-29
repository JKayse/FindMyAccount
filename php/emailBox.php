<?php

	function registerCurl($cmd) {
        exec($cmd,$result);
        //var_dump($result);
        $data = json_decode($result[0]);
        return $data;
	}

	function findEmailBox($email) {
		$data = registerCurl("curl 'https://app.box.com/index.php?rm=signup_check_email' -H 'Cookie: z=aa3d3orj7h4si94enidqht0ea6;' --data 'email=$email&request_token=a6d69cba4de5f0062bbd7e02c0a8fd448cf489b2032170e61085cf4f1e7065ae&' --compressed");
        return ($data->email_registered);
	}
	
	$sites = array();
	if(findEmailBox($email)) {
		$sites["box"]=array(
			"name"=>"Box",
			"description"=>"",
			"imgURL"=>"http://cloudtimes.org/wp-content/uploads/2011/08/box_logo.png",
			"link"=>"https://www.box.com/",
			"email"=>$email,
			"username"=>NULL,
		);
		
	}