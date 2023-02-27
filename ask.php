<?php
    session_start();
    include('connect.php');
    if(!isset($_SESSION['user']))
        header("location: login.php");
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
    <body id="ask">
        <!-- navigation bar -->
        <a href="index.php">
            <div id="log">
                <div id="i">C</div><div id="cir">i</div><div id="ntro">CampusQueries</div>
            </div>
        </a>
        <ul id="nav-bar">
            <a href="feed.php"><li>Feed</li></a>
            <a href="index.php"><li>Home</li></a>
            <!-- <a href="categories.php"><li>Categories</li></a> -->
            
            <a href="ask.php"><li id="home">Ask Question</li></a>
            <a href="profile.php"><li> Profile </li></a>
            <a href="logout.php" onclick=" return confirm('Are you sure you want to LogOut?')"><li>Log Out</li></a>
            <a href="contacts.php"><li>Contact</li></a>
        </ul>
        
        <!-- content -->
        <div id="content">
            <div id="sf">
                <center>
                    <div class="heading ask">
                        <h1 class="logo"><div id="i">C</div><div id="cir">i</div><div id="ntro">ampusQueries</div></h1>
                        <p id="tag-line">where questions are themselves the answers</p>
                    </div>

                    <form action="<?php echo htmlspecialchars( $_SERVER["PHP_SELF"] ); ?>" method="post" enctype="multipart/form-data">

                        <input name="question" type="text" title="Your Question..." placeholder="Ask Your question on our Community for greate user expereince..." id="question" required>
                        <input name="submit" type="submit" class="up-in" id="ask_submit">
                    </form>
                </center>
            </div>
        </div>
        
        <div id="ask-ta">
            <h1>Thank You.<br>Stay tunned for updates.</h1>
        </div>
        
        <?php
        
            if( isset( $_POST["submit"] ) )
            {

                function valid($data){
                    $data=trim(stripslashes(htmlspecialchars($data)));
                    return $data;
                }
                $question = valid( $_POST["question"] );
                
                // $no = valid( $_POST["cat"]);
                $question = addslashes($question);
                $q = "SELECT * FROM quans WHERE question = '$question'";
                $result = mysqli_query($conn,$q);
                if(mysqli_error($conn))
                    echo "<script>window.alert('Some Error Occured. Try Again or Contact Us.');</script>";
                
                else if( mysqli_num_rows($result) == 0 ){
                    $query = "INSERT INTO quans VALUES(NULL, '$question', NULL,'".$_SESSION['user']."',NULL, now(), 0)";
                        if(mysqli_query( $conn, $query)){
                        echo "Thank You!";
                        sleep(1);
                        header("location: ask.php");
                        
                    }
                    
                }
                else{
                    echo "<script>window.alert('Question was already Asked. Search it on Home Page.');</script>";
                }
                
                mysqli_close($conn);
            }
        
        ?>
        
        <!-- Footer -->
        <div id="footer" style="padding:30px;">
            &copy; 2023 &bull; CampusQueries Inc.
        </div>
        
    </body>
    
</html>