<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>  
    <head>
          <meta charset="utf-8" />
		  <title>Labweb</title>
		<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'>
		<link href='<?php echo base_url('assets/style/styles.css'); ?>' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
		<script src="<?php echo base_url('assets/js/index.js'); ?>"></script>
    </head>
	
<body>

<ul class="top_nav">
<div class="logo"><a href="<?php echo site_url('/'); ?>"><strong>Labweb</strong></a></div>
<li><a href="<?php echo site_url('/'); ?>">მთავარი გვერდი</a></li>
<li><a href="<?php echo site_url('about'); ?>">ჩვენს შესახებ</a></li>
<li><a href="<?php echo site_url('events'); ?>">ივენთები</a></li>
<li><a href="<?php echo site_url('mentors'); ?>">მენტორები</a></li>
<li><a href="<?php echo site_url('blog'); ?>">ბლოგი</a></li>
<li style="float: right;"><a href="<?php echo site_url('/admin'); ?>">ADMIN</a></li>
</ul>

<div class="wrapper">