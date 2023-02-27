<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title> CampusQueries </title>
        <link type="text/css" rel="stylesheet" href="../static/css/style.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="../static/css/material.css">
        <link type="text/css" rel="stylesheet" href="fonts/font.css">
        <link rel="icon" href="images/icon1.png" >
    </head>
    <body id="_4">
        <!-- navigation bar -->
        <a href="index.php">
            <div id="log">
                <div id="i">C</div><div id="cir">i</div><div id="ntro">ampusQueries</div>
            </div>
        </a>
        <ul id="nav-bar">
            <?php 
                if(isset($_SESSION['user'])){
            ?>
            <a href="feed.php"><li>Feed</li></a>
            <?php 
                }
            ?>
            <a href="index.php"><li>Home</li></a>
            <!-- <a href="categories.php"><li>Categories</li></a> -->
            
            <a href="ask.php"><li>Ask Question</li></a>
            <?php 
                if(! isset($_SESSION['user'])){
            ?>
            <a href="login.php"><li>Log In</li></a>
            <a href="signup.php"><li>Sign Up</li></a>
            <?php
                }
                else{
            ?>
            <a href="profile.php"><li> Profile </li></a>
            <a href="logout.php" onclick=" return confirm('Are you sure you want to LogOut?')"><li>Log Out</li></a>
            <?php
                }
            ?>
            <a href="contacts.php"><li id="home">Contact</li></a>
        </ul>
        <!-- content -->
        <div id="content" class="clearfix">
            
            <div id="box-1">
                <div class="heading">
                    <center>
                    <h1 class="logo"><div id="i">C</div><div id="cir">i</div><div id="ntro">CampusQueries</div></h1>
                    <p id="tag-line">where questions are themselves the answers</p>
                    </center>
                </div>
            </div>
            <div id="box-2">
                <div id="text">
                    <h1>CampusQueries</h1>
                    <p>
                        CampusQueries@gmail.com<br><br>
                        <!-- Social: <a href="#">Saurav Yadav</a><br> -->
                        <!-- Social: <a href="#">Abhishek Jha</a><br> -->
                        Social: <a href="https://www.linkedin.com/in/ankit-maurya-2993851b5">Amit Maurya</a>
                    </p>
                </div>
            </div>
            
        </div>
    
        <!-- Footer -->
        <div id="footer">
            &copy; 2023 &bull; CampusQueries Inc.
        </div>
        
    </body>
    
</html>