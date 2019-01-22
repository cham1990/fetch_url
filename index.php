<?php
   require_once 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>URL Scrapper</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo CSS_PATH;?>custom.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="<?php echo JS_PATH;?>custom.js"></script>
</head>
<body>


<section id="urlForm" class="outer-wrapper">

<div class="inner-wrapper">
<div class="container">
  <div class="row inner-div">
    <div class="col-sm-4 col-sm-offset-4">
      <h2 class="text-center">Form</h2>
      <form class="form-horizontal" id='fetch_url' action="<?php echo EXEC;?>fetch_url.php">

	  <div id="append_div" class="sortable">

		    <div class="form-group inner_div ui-state-default">
		      <label class="control-label col-sm-2"><span class="glyphicon glyphicon-menu-hamburger sort_handler"></span></label>
		      <div class="col-sm-8">
			<input type="url" class="form-control" required="true" placeholder="Enter URL 1" name="url[]">
		      </div>

		      <div class="col-sm-2">          
			<input type="button" class="btn btn-default update-btn div_remove" value="Remove">
		      </div>
		      <div class="col-sm-12">
			   <span class="help-block"></span>
		      </div>
		    </div>

		    <div class="form-group inner_div ui-state-default">
		      <label class="control-label col-sm-2" ><span class="glyphicon glyphicon-menu-hamburger sort_handler"></span></label>
		      <div class="col-sm-8">          
			<input type="url" class="form-control" required="true" placeholder="Enter URL 2" name="url[]">
		      </div>

		      <div class="col-sm-2">          
			<input type="button" class="btn btn-default div_remove update-btn" value="Remove">
		      </div>
		    </div>
	  </div>

		    <div class="form-group">        
		      <div class="col-sm-offset-2 col-sm-10">
			 <input type="button" class="btn btn-default update-btn" id="add_more" value="Add" >
		      </div>
		    </div>
		    <div class="form-group">        
		      <div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default submit-btn">Fetch</button>
		      </div>
		    </div>

		   <div class="form-group">        
		     <div id="progress_div" class="col-sm-offset-2 col-sm-10"> </div>
		     <div id="output_div" class="col-sm-offset-2 col-sm-10">
		    </div>


      </form>
  

      </div>
    </div>
  </div>
</div>
</div>

</section>

</body>
</html>
