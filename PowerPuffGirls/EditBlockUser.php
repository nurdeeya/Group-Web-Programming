<?php
session_start();
if(isset ($_SESSION["UID"])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Status Update</title>
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
            font-size: 18px;
            color: white;
        }

        table {
            width: 60%;
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
            height: 35px;
			width:90px;
            background-color: grey;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin: 5px;
        }

        input[type="submit"]:hover {
            background-color: black;
        }

        a {
            color: grey;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    

    <h2>User Status Update</h2>

    <p>Here's your update:</p>

    <form action="BlockUserStatus.php" method="POST" onsubmit="return confirm('Yeke, yakinnn?')">
        <br>

        <table border="2">
            <tr>
                <th>Choose</th>
                <th>User ID</th>
                <th>User Status</th>
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
                $queryView = "SELECT * FROM Users WHERE UserType = 'User' ";
                $resultView = $conn->query($queryView);

                if ($resultView->num_rows > 0) {
                    while ($row = $resultView->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><input type="radio" name="UserID" value="<?php echo $row["UserID"]; ?>" required> </td>
                            <td><?php echo $row["UserID"]; ?> </td>
                            <td><?php echo $row["User_Status"]; ?> </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='3'>NO data selected</td></tr>";
                }
            }
            $conn->close();
            ?>
        </table>

        <br><br>
        <input type="submit" name="updateStatus" value="Block">
        <input type="submit" name="updateStatus" value="Active">
		<br><br>
		<a style= 'color:white;' href='Songview_Admin.php'>Song View Details</a>
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
