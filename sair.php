<?php
session_start();

unset($_SESSION['estoque']);
header("Location: index.php");

