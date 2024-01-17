<?php
session_start();
if(isset ($_SESSION["UID"])) {
?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Introduction About My System</title>
    <style>
        body {
            background: #f7f7f7;
            overflow: hidden;
        }

        .container {
            align-items: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 89vh;
            z-index: 5;
            position: relative;
        }

        .menu {
            display: flex;
            flex-direction: column;
            width: 100%;
            grid-area: 1/1/2/2;
            position: relative;
        }

        .menu a {
            font-family: Raleway, serif;
            color: #333;
            cursor: pointer;
            font-size: 20px;
            font-weight: 700;
            line-height: 1;
            position: relative;
            text-align: center;
            margin: 1vh auto;
            padding: 2.5vh 0;
            width: 30%;
            background: grey;
            backdrop-filter: blur(15px);
            border-radius: 100px;
            box-shadow: 1px 1px 0 0 rgba(255, 255, 255, 0.8) inset,
                3px 5px 10px 0 rgba(0, 0, 0, 0.1);
            text-decoration: none;
            will-change: color, text-shadow, font-size;
            transition: ease all 0.3s;
        }

        .menu a:hover {
            transform: scale(1.1);
            background: white;
        }
    </style>
    <link rel="stylesheet" href="style.css">
    <title> Song Collection </title>
</head>
<body>
   
    <?php
    if ($_SESSION["UserType"] == "Management") {
    ?>
    <div class="container">
    <nav class="menu">
        <a href="Songview_Admin.php"> View playlist</a><br><br>
        </nav>
    <?php 
    } else {
    ?>
        <div class="container">
        <i><h2 style='color:white';> WELCOME, Hi <?php echo $_SESSION["UID"]; ?> </h2></i>
    <p style='color:white';> Choose your menu: </p>
            <nav class="menu">
                <a href="Song_Form.php">Register New Playlist</a>
                <a href="Song_DeleteView.php"> Delete Songs Record</a>
                <a href="Song_EditView.php">Edit Songs Details</a>
                <a href="Songview.php">View Songs List</a>
            </nav>
        </div>
    <?php
    }
    ?>
    <center>
    <a href="LogoutSong.php" style="color: white;"><i>Logout</i></a><br>
</center>
</body>
</html>
<?php
}
else {
    echo "No session exists or session has expired. Please log in again.<br>"; 
    echo "<a href='login.html'> Login </a>";
}
?>
