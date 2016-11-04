<?php
	//	/extensions/welcomeExtension.php

	function welcome() {

    global $GLOBALS_DOMAIN;

    $error = false;
    $success = false;
    $custom = '';

    if(isset($_POST['url'])) {
      if(isset($_POST['custom'])) {
        $custom = '&custom='.$_POST['custom'];
      }
      $service = consume_json($GLOBALS_DOMAIN . "newUrl/?url=".$_POST['url'].$custom);

      if($service['error'] != null) {
        $error = $service['message'];
      } else {
        $success = $service[0];
      }
      
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Welcome to Shortly</title>

    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>



    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">

          </ul>
        </nav>
        <h3 class="text-muted">Shortly</h3>
      </div>

      <div class="jumbotron">
        <?php if($error) { ?>
          <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Warning!</strong> Service response: <?= $error ?>
          </div>
        <?php } ?>
        <h3>Welcome to Shortly</h3>
        <p>Check the "documentation" below this block, or try the api just in here.</p>
        <form method="post" action="index.php">
          <p>
            Url: <input name="url" placeholder="http://example.com"/>
            <input name="custom" placeholder="optionalCustom"/>
            <input type="submit" name="" value="Short it!!"/>
            <inpyt type="hidden" name=""/>
            <?php if($success) { ?>
            <hr/>
              <p> Your short url for <i><?= $success['original'] ?></i> is ready to go!
                <input readonly="" value="<?= $GLOBALS_DOMAIN ?><?= $success['custom']!=null?$success['custom']:$success['short'] ?>" />
                <input type="hidden" name="current_url" value="<?= $id ?>">
              </p>
            <?php } ?>
          </p>
        </form>
      </div>

      <div class="row marketing">
      <h3>Using the api</h3>
        <div class="col-lg-6">
          <h4><?= $GLOBALS_DOMAIN ?>allUrls</h4>
          <p>Simply list all current registered urls.</p>

          <h4><?= $GLOBALS_DOMAIN ?>idInfo/<i>uniqeid</i></h4>
          <p>Show the info of given uniqueId.</p>

          <h4><?= $GLOBALS_DOMAIN ?>customInfo/<i>customUrl</i></h4>
          <p>Same as idInfo but with custom urls..</p>

          <h4><?= $GLOBALS_DOMAIN ?>newUrl?url=http://example.com&custom=optional</h4>
          <p>Creates a new custom url.</p>
        </div>

        <div class="col-lg-6">
          <h4>error 210</h4>
          <p>Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum.</p>

          <h4>error 211</h4>
          <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum.</p>

          <h4>error 212</h4>
          <p>Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
        </div>
      </div>

      <footer class="footer">
        <p>&copy; Company 2016</p>
      </footer>

    </div> <!-- /container -->



  </body>
</html>
<?php
	}
?>