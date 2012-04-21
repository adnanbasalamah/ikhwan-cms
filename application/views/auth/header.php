<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8"><title>TVRSA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="/assets/css/bootstrap.css" rel="stylesheet">
    <link href="/assets/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="/assets/css/docs.css" rel="stylesheet">
    <link href="/assets/js/google-code-prettify/prettify.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
	
	</head>
	<body>
	<div class="navbar navbar-fixed-top">
	  <div class="navbar-inner">
		<div class="container">
		   <?php 
		    /* $this->load->view($this->config->item('auth_views_root') . 'nav'); */
			$this->load->view($this->config->item('auth_views_root') . 'nav_video');
			/* $this->load->view($this->config->item('auth_views_root') . 'nav_news'); */
			?>	
		</div>
	  </div>
	</div>
	
		