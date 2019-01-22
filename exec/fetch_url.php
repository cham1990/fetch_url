<?php
	header('Content-Type: text/event-stream');

        header('Connection: keep-alive');

	// recommended to prevent caching of event data.
	header('Cache-Control: no-cache'); 

	// Turn off output buffering
	ini_set('output_buffering', 'off');

	// Turn off PHP output compression
	ini_set('zlib.output_compression', false);

	// Implicitly flush the buffer(s)
	ini_set('implicit_flush', true);

	ob_implicit_flush(true);

	// Clear, and turn off output buffering
	while (ob_get_level() > 0) {
	    // Get the curent level
	    $level = ob_get_level();
	    // End the buffering
	    ob_end_clean();
	    // If the current level has not changed, abort
	    if (ob_get_level() == $level) break;
	}

	// Disable apache output buffering/compression
	if (function_exists('apache_setenv')) {
	    apache_setenv('no-gzip', '1');
	    apache_setenv('dont-vary', '1');
	}
	if(!empty($_POST['url'])){

	   $l = count($_POST['url']);
	   foreach($_POST['url'] as $key=>$value){

	      $url_title = get_url_title($value);
	      $message = '';
	      $success = 0;
	      if($url_title == 1){

		     $message = 'URL '.($key+1).' -> '.'Request URL does not exists or does not have permission to fetch data.';
		     $success = 0;
	      
		   
	      } else if($url_title == 2) {
	 
		    $message = 'URL '.($key+1).' -> '.'This URL does not have Title.';
		    $success = 0;
	      } else {
	 
		    $message = 'URL '.($key+1).' -> '.$url_title;
		    $success = 1;
	      }

	       echo '___PAYLOAD___'.$message;
	  }

	} else {
	   echo json_encode(array('success'=>false,'message'=>'Please add at least one URL to fetch Title.'));
	}

	function get_url_title($url) {

	     $options = array(
	       
		CURLOPT_SSL_VERIFYPEER => false,    // Disabled SSL Cert checks
		CURLOPT_FOLLOWLOCATION => true, 
		CURLOPT_RETURNTRANSFER => TRUE
	    );

	    $ch      = curl_init( $url );
	    curl_setopt_array( $ch, $options );
	    $content = curl_exec( $ch );
	    $err     = curl_errno( $ch );
	    curl_close( $ch );

	    if(!empty($err)){
		return 1;
	    } else {
		 preg_match("/<title>(.*)<\/title>/i", $content, $matches);
		    if(!empty($matches[1])){
		         return $matches[1];
		    } else {
		         return 2;
		    }

	    }
	}
