<?php
echo 'open_basedir: ' . ini_get('open_basedir') . "<br>";
session_save_path(__DIR__ . "/application/cache/sessions");
session_start();
$_SESSION['test'] = 'ok';
echo 'Session path: ' . session_save_path();
