<?php
	include 'navbar.php';


	//echo "connected suceessfully";
  	if(isset($_POST['submit'])) { 
		$username=$_POST['username'];
		$password=$_POST['password'];
		$sql="select * from admin_login where username like '".$username."' ";
        
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row= $result->fetch_assoc();
            $dbusername=$row['username'];
            $dbpassword=$row['password'];
            $uid=$row['id'];
        }
        if($username == $dbusername && $password == $dbpassword){
            if(session_id() == '') {
                session_start();
            }
            $_SESSION['username']=$username;
            $_SESSION['uid']=$uid;
            header("location:./admin/index.php");
        }
        else{
            header("location:login.php?error=".$username."");
        }
    }
?>