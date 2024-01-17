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
            margin: 0;
            padding: 0;
            text-align: center;
        }

        h2 {
            color: white;
        }

        p {
            color: white;
            margin-bottom: 20px;
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
            background-color: black;
            color: white;
        }

        input[type="submit"] {
            background-color: grey;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: black;
        }
    </style>
</head>

<body>
  
    <h2>Song Collection Details</h2>
    <p>Choose which record you want to update</p>

    <form action="EditUpdateStatus.php" method="POST" onsubmit="return confirm('Are you sure to edit this record?')">
        <br>

        <table border="2">
            <tr>
                <th>Choose</th>
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
            } else {
                $queryView = "SELECT * FROM Song";
                $resultView = $conn->query($queryView);

                if ($resultView->num_rows > 0) {
                    while($row = $resultView->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><input type="radio" name="SongId" value="<?php echo $row["SongId"]; ?>" required> </td>
                            <td><?php echo $row["SongId"]; ?> </td>
                            <td><?php echo $row["SongTitle"]; ?> </td>
                            <td><?php echo $row["ArtistName"]; ?> </td>
                            <td><?php echo $row["SongGenre"]; ?> </td>
                            <td><?php echo $row["SongLanguage"]; ?> </td>
                            <td><?php echo $row["ReleaseDate"]; ?> </td>
                            <td><?php echo $row["Audio_Url"]; ?> </td>
                            <td><?php echo $row["User_Song"]; ?> </td>
                            <td><?php echo $row["Registration_Status"]; ?> </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='10'>NO data selected</td></tr>";
                }
            }
            $conn->close();
            ?>
        </table>

        <br><br>
        <input type="submit" value="View record to update"><br><br>
    </form>

    
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