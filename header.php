<?php require 'php/constants.php'; ?>
<?php require 'php/utils.php'; ?>
<?php session_start(); ?>
<html>
<head>
  <title>A2 Pokemon Go</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=0">
  <link rel="icon" href="dist/img/a2icon.png">
  <link href="dist/css/font-awesome.min.css" rel="stylesheet" />
  <link href="dist/css/foundation.min.css" rel="stylesheet" />
  <link href="dist/css/app.css" rel="stylesheet" media="screen" />
  <script src="dist/js/jquery-3.2.1.min.js"></script>
  <script src="dist/js/foundation.min.js"></script>
  <script src="dist/js/app.js"></script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCg_CzyJssH4PQZ_Wf0uA36N0Jy6Oh30Es&callback=initMap&libraries=drawing"></script>

</head>

<body>
<div id="wrapper">
