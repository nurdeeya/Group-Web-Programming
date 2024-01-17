<?php
session_start();
if (isset($_SESSION["UID"])) {
    session_unset();
    session_destroy();

    echo "<div style='text-align: center; background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 5px; padding: 15px; margin: 20px 0;'>";
    echo "<strong>Warning!</strong> You have successfully logged out.";
    echo "<br>Click <a href='login.html'>here</a> to login again.";
    echo "</div>";
} else {
    echo "<div style='text-align: center; background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 5px; padding: 15px; margin: 20px 0;'>";
    echo "<strong>Warning!</strong> No session exists or the session has expired. Please log in again.";
    echo "<br>Click <a href='login.html'>here</a> to login again.";
    echo "</div>";
}
?>
