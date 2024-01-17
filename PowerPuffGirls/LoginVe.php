<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            max-width: 400px;
            margin: 50px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 20px;
            text-align: center;
        }

        h2 {
            color: #333;
        }

        p {
            color: red;
        }

        a {
            color: #007BFF;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <?php
    $userID = $_POST['UserID'];
    $userPwd = $_POST['UserPwd'];

    $host = "localhost";
    $user = "root";
    $pass = ""; 
    $db = "song_details";

    $link = new mysqli($host, $user, $pass, $db);
    
    if ($link->connect_error) {
        die("Connection failed: " . $link->connect_error);
    } else {
        $queryCheck = "SELECT * FROM USERS WHERE UserID = '".$userID."' and User_Status = 'Active' ";
        $resultCheck = $link->query($queryCheck);

        if ($resultCheck->num_rows == 0) {
            echo "<div class='container'>";
            echo "<h2>Login Failed</h2>";
            echo "<p>User ID does not exist or user has been blocked</p>";
            echo "<p>Click <a href='login.html'>here</a> to log in again</p>";
            echo "</div>";
        } else {
            $row = $resultCheck->fetch_assoc();

            if ($row["UserPwd"] == $userPwd) {
                session_start();
                $_SESSION["UID"] = $userID;
                $_SESSION["UserType"] = $row["UserType"];
                header("Location: SongMenu.php");
            } else {
                echo "<div class='container'>";
                echo "<h2>Login Failed</h2>";
                echo "<p style='color:red;'>Wrong password!!!</p>";
                echo "<p>Click <a href='login.html'>here</a> to log in again</p>";
                echo "</div>";
            }
        }
    }
    $link->close();
    ?>

</body>
</html>
