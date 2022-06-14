<?php

// database credentials
define("DATABASE_HOST", "localhost");
define("DATABASE_USERNAME", "nhom14_admin");
define("DATABASE_PASSWORD", "Nhom14@@@");
define("DATABASE_NAME", "nhom14_storeee");

// for csrf token
define("CSRF_TOKEN_KEY", "whatiscsrftoken?");

// function codes that will run on every page the website
session_start();
error_reporting(0);
session_set_cookie_params(["samesite" => "Strict"]);
