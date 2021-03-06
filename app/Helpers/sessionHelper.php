<?php
session_start();
function isLogedIn()
{
    if (isset($_SESSION['USER_CIN'])) {
        return true;
    } else {
        return false;
    }
}
