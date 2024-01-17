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
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        h2 {
            color: white;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #e0e0e0;
            padding: 12px;
        }

        th {
            background-color: #333;
            color: white;
        }

        a, input[type="submit"] {
            display: inline-block;
            background-color: grey;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            font-weight: normal;
            border-radius: 5px;
            margin-top: 10px;
			margin-left: 50px;
			
        }

        a:hover, input[type="submit"]:hover {
            background-color: black;
        }
    </style>
</head>

<body>
   

    <h2>Song Collection Details</h2>
    <form method="GET" action="Search.php">
        <label for="search">Search:</label>
        <input type="text" name="search" id="search" placeholder="Enter keywords">
        <input type="submit" value="Search">
    </form>

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

        $conn = new mysqli($host, $user, $pass, $db);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            $queryView = "SELECT * FROM SONG ORDER BY SongTitle ASC";
            $resultView = $conn->query($queryView);

            if ($resultView->num_rows > 0) {
                while ($row = $resultView->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $row["SongId"]; ?> </td>
                        <td><?php echo $row["SongTitle"]; ?> </td>
                        <td><?php echo $row["ArtistName"]; ?> </td>
                        <td><?php echo $row["SongGenre"]; ?> </td>
                        <td><?php echo $row["SongLanguage"]; ?> </td>
                        <td><?php echo $row["ReleaseDate"]; ?> </td>
                        <td><a href="<?php echo $row["Audio_Url"]; ?>" target="_blank"><?php echo $row["Audio_Url"]; ?></a></td>
                        <td><?php echo $row["User_Song"]; ?> </td>
                        <td><?php echo $row["Registration_Status"]; ?> </td>
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='9'>NO data selected</td></tr>";
            }
        }
        $conn->close();
        ?>
    </table>

    <a href="UpdateStatus.php">Update Status</a>
    <a href="SongMenu.php">Menu Song Details</a>
	<a href="EditBlockUser.php">View Record to Block</a>

    
   
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
