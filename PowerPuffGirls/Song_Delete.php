<?php
session_start();
if(isset ($_SESSION["UID"])) {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Song Collection</title>
	<link rel="stylesheet" href="style.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
        }

        p.success {
            color: #28a745;
        }

        p.error {
            color: #dc3545;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Song Collection Details</h2>

        <?php
        $SongId = $_POST["SongId"];

        $host = "localhost";
        $user = "root";
        $pass = "";
        $db = "song_details";

        $conn = new mysqli($host, $user, $pass, $db);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            $deleteQuery = "DELETE FROM SONG WHERE SongId = '" . $SongId . "' ";

            if ($conn->query($deleteQuery) === TRUE) {
                echo "<p class='success'>Record has been deleted from the database!</p>";
                echo "Click <a href='Songview.php'>here</a> to view SONG details";
            } else {
                echo "<p class='error'>Query problems: " . $conn->error . "</p>";
            }
            $conn->close();
        }
        ?>
    </div>
</body>

</html>
<?php
}
else
{
echo "No session exists or session has expired. Please log in again.<br>"; 
echo "<a href='login.html'> Login </a>";
}
?>