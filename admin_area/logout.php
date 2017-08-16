<?php
session_start();
session_destroy();

echo"<script> window.open('login.php?logout=You have Successfully loggedout!','_self')</script>";





?>