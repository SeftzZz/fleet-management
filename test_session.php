<?php
// test_session.php

// Mulai session
session_start();

// Tulis sesuatu ke session
$_SESSION['test'] = 'halo msi';

echo 'Session ID: ' . session_id() . "<br>";
echo 'Session path: ' . session_save_path() . "<br>";
echo 'Session data: ' . $_SESSION['test'];
