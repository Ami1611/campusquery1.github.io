<?php
    session_start();
    include('connect.php');
    if(!isset($_SESSION['user']))
        header("location: login.php");
?>
<?php
    // session_start();
    // include('connect.php');

    if(isset($_POST["ansubmit"])){
        function valid($data){
            $data = trim(stripslashes(htmlspecialchars($data)));
            return $data;
        }
        $answer = valid($_POST["answer"]);
        if($answer == NULL){
            echo "<script>window.alert('Please Enter something.');</script>";
        }
        else{
            $que = "";
            if($_POST["nul"]==0){
                if(strpos($_POST["preby"],$_SESSION["user"]) === false)
                    $que = "update quans set answer=CONCAT(answer,'<hr>".$_POST["answer"]."'), answeredby=CONCAT(answeredby,', @ ".$_SESSION["user"]."') where question like '%".$_POST["question"]."%'";
                    // $que = "insert into checkpost values (NULL, '".$_POST["question"]."', '".$_POST["answer"]."', '".$_SESSION["user"]."')";
                else
                    $que = "update quans set answer=CONCAT(answer,'<hr>".$_POST["answer"]."'), answeredby = '".$_SESSION["user"]."' where question like '%".$_POST["question"]."%'";
            }
            else
                $que = "update quans set answer='".$_POST["answer"]."', answeredby = '".$_SESSION["user"]."' where question like '%".$_POST["question"]."%'";
            if(mysqli_query($conn,$que))
                echo "<style>#box0,.open{display: none;} #tb{display: block;}</style>";
            else
                header("Location: index.php");
        }
    }

?>

<!DOCTYPE html>
<html>
<head>
	<title>CampusQueries</title>
	        <link type="text/css" rel="stylesheet" href="../static/css/feedstyle.css">
	        <link type="text/css" rel="stylesheet" href="../static/css/chat.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="../static/css/material.css">
        <link type="text/css" rel="stylesheet" href="fonts/font.css">
        <link rel="icon" href="cq/images/icon1.png" >
         <!-- Sripts -->
        <script type="text/javascript" src="../static/js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="../static/js/script.js"></script>
        <style>
            textarea{
                display: none;
                width: 830px;
                height: 35px;
                background: #333;
                color: #ddd;
                padding: 10px;
                margin: 5px 0 -14px; 
            }
            .ans_sub{
                display: none;
                padding: 0 10px;
                height: 30px;
                line-height: 30px;
            }
            .pop{
                display: none;
                text-align: center;
                margin: 195.5px auto;
                font-size: 12px;
            }
            hr.new4 {
  				border: 1px solid red;
				}
        </style>
</head>
  <body id="_5">
        
        <ul id="nav-bar">
        	<a href="index.php">
            <div id="log">
                <div id="i">C</div><div id="cir">i</div><div id="ntro">CampusQueries</div>
            </div>
        	</a>
            <a href="feed.php"><li id="home">Feed</li></a>
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
            <a href="contacts.php"><li>Contact</li></a>
        </ul>

    	
        	<div id="feed"></div>
        
           <center>
                <?php
                    //$no = 1;
                    $no1 = "select count(*) from quans";
                    $res = mysqli_query($conn, $no1);
                    $row = mysqli_fetch_row($res);
                    $no = $row[0];
                    $quer = "select id from quans";
                    $result = mysqli_query($conn, $quer);
                    $rows = mysqli_fetch_all($result);
                    
                    $n = 1;
                    $nul=0; 
                    while($no > 0){
                ?>
                <div id="box<?php echo $no; ?>" class="open">
                    
                   
                    
                    <center>
                        <?php
                            $i = $no - 1;
                            $ro = $rows[$i][0];

                            $qu = "select question, answer, askedby, answeredby, post_date from quans where id='$ro' Limit 6";
                            $re = mysqli_query($conn,$qu);
                            while($da = mysqli_fetch_assoc($re)){
                        ?>
                        <div id="qa-block">
                            <div class="question">
                                <div id="Q">Q.</div>
                                <?php echo $da['question']."<small id='sml'>Asked By: @".$da['askedby']."</small>"; ?>
                                <?php echo "<div id='tm'; style='text-align:right; font-size: 10px;'> Posted On : " .$da['post_date']."</div>"; ?>
                            </div>
                            <div class="answer">
                                <?php 
                                    if($da["answer"]){
                                        $nul=0;
                                        echo $da["answer"]."<br><small>Answered By: @".$da['answeredby']."</small>";
                                    }
                                    else{
                                        $nul=1;
                                        echo "<em>*** Not Answered Yet ***</em>";
                                    }
                                ?>
                                <!-- <hr class="new4"> -->
                                <form id="f<?php echo $n; ?>" style="margin-bottom: -25px;" action="<?php echo htmlspecialchars( $_SERVER["PHP_SELF"] ); ?>" method="post" enctype="multipart/form-data">
<!--                                    <input type="button" value="Click here to answer." id="ans_b" >-->
                                    <label style="margin-bottom: -25px;"><a  id="ans_b<?php echo $n; ?>" href="#area<?php echo $no; ?>"><u class="submitclass" >Submit your answer</u></a></label>
                                    <br>
                                    <script>
                                        $(function(){
                                            $('#ans_b<?php echo $n; ?>').click(function(e){
                                                e.preventDefault();
                                                tgt=e.target;
                                                tgt.remove();
                            

                                            
                                                $('#area<?php echo $n; ?>').css("display","block");
                                                $('#ar<?php echo $n; ?>').css("display","block");
                                                $('#f<?php echo $n; ?>').css("margin-bottom","0px");
                                               
                                            });
                                        });
                                    </script>
                                    <br>
                                    
                                    <textarea id="area<?php echo $n; ?>" name="answer" placeholder="Your Answer..."></textarea>
                                    <input style="display: none;" name="question" value="<?php echo $da['question'] ?>">
                                    <input style="display: none;" name="nul" value="<?php echo $nul ?>">
                                    <input style="display: none;" name="preby" value="<?php echo $da['answeredby'] ?>">

                                    <br>
                                    <input type="submit" name="ansubmit" value="Submit" class="up-in ans_sub" id="ar<?php echo $n; ?>">
                                    
                                </form>
                                

                                
                            </div>
                          
                        </div>
                        <br>
                        <?php $n++; } ?>
                    </center>
                    
                </div><!-- box1 -->
                <?php
                    $no--;
                }
                ?>
            </center>
            
        </div><!-- content -->
  
        <!-- Footer -->
        <div id="footer" style="padding:30px; text-align:center;">
            &copy; 2023 &bull; CampusQueries Inc.
        </div>
        
        
    </body>
    
</html>