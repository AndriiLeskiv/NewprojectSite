<?php
session_start();
include_once "app/include/path.php";

unset($_SESSION["id"]);
unset($_SESSION["login"]);
unset($_SESSION["admin"]);

header('Location: ' .BASE_URL);