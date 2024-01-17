<?php
session_start();
//check if session exists
if(isset($_SESSION["UID"])) {
?>

<!DOCTYPE html>
<html>
<head>
    <title>Song Collection</title>

    <style>
        body {
            background-image: url('wallpaper.jpeg');
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: white; /* Light gray text color */
            text-align: center;
            padding: 20px;
        }

        h2 {
            color: white; /* Blue color for headings */
        }

        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden; /* Hide overflowing content */
        }

        table, th, td {
            border: 1px solid #e0e0e0; /* Light gray border */
        }

        th, td {
            padding: 12px;
            text-align: left;
            color: black; /* Light gray text color for table content */
        }

        th {
			background-color: blue;
            color: white;        }

        tr:nth-child(even) {
            background-color: #f8f8f8; /* Light gray background for even rows */
        }

        button {
            background-color: grey; /* Red color for the button */
            color: #ECF0F1;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }
    </style>
</head>

<body>
    <h2>Song Collection Details</h2>
    <br>

    <table border="2">
        <tr>
            <th>Song Id</th> 
            <th>Song Title</th> 
            <th>Song Artist/Band</th>
            <th>Song Genre</th>
            <th>Song Language</th>
            <th>Release Date</th>
            <th>Audio/Video (URL)</th>
            <th>User</th>
            <th>Status</th>
        </tr>

        <?php
        $host = "localhost"; 
        $user = "root";
        $pass = "";
        $db = "song_details";

        $conn = new mysqli ($host, $user, $pass, $db);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        else {
            $queryView = "SELECT * FROM SONG WHERE Registration_Status = 'Approved'";
            $resultView = $conn->query($queryView);

            if ($resultView->num_rows > 0) {
                while($row = $resultView->fetch_assoc()) {
        ?>

        <tr>
            <td><?php echo $row["SongId"]; ?> </td>
            <td><?php echo $row["SongTitle"]; ?> </td>
            <td><?php echo $row["ArtistName"]; ?> </td>
            <td><?php echo $row["SongGenre"]; ?> </td>
            <td><?php echo $row["SongLanguage"]; ?> </td>
            <td><?php echo $row["ReleaseDate"]; ?> </td>
            <td><a href = "<?php echo $row["Audio_Url"]; ?>" target = "_blank" >LINK</a> </td>
            <td><?php echo $row["User_Song"]; ?> </td>
            <td><?php echo $row["Registration_Status"]; ?> </td>
        </tr>

        <?php
                }
            } else {
                echo "<tr><td colspan='8'> NO data selected </td></tr>";
            }
        }
        $conn->close();
        ?>
    </table>

    <br>

    <button type="button" onclick="window.location.href='SongMenu.php'">MENU</button>

    <br><br>
</body>
</html>

<?php
}
else {
    echo "No session exists or session has expired. Please log in again.<br>";
    echo "<a href=login.html> Login </a>";
}
?>
