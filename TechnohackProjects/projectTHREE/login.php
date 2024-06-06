<?php
$conn= mysqli_connect("localhost","root","","projthree");
if(isset($_POST["login"]))
{
    $uname = $_POST['uname'];
    $pwd = $_POST['pwd'];
    session_start();
    $_SESSION['uname']=$uname;
    $sql ="select * from signup where email='$uname'";
    $result= mysqli_query($conn,$sql);
    $row= mysqli_fetch_array ($result);
    $count= mysqli_num_rows($result);
    if ($count>0)
    {
        $var = password_verify($pwd,$row['pwd']);         
        if($var==TRUE)
        {
            echo "<script type='text/javascript'>alert('LOGGED IN SUCCESSFULLY!!')</script>";
        }
        else
        {
            echo "<script type='text/javascript'>alert('INVALID PASSWORD :-(')</script>";
        } 
    }
    else
    {
        echo "<script type='text/javascript'>alert('Login failed, Invalid User')</script>";
        $conn->error;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
<title>Login Page</title>
<style>
.inside{
    margin:30px 40px 30px 40px;
    border-radius: 8px;
    height: 80px;
    
}
.outside{
    margin:0px 350px 0px 350px; 
    padding-bottom:50px;
    position: relative; 
    border-radius: 50px; 
    background-color: rgba(2, 2, 2, 0.466);
    border: none; 
}
.heading {
    text-align: center;
    font-size: 185%;
    font-family: Georgia, 'Times New Roman', Times, serif;
    color: gold;
    margin-top: -2px;
}
body{
    background-color:rgba(0, 139, 139, 0.767);
    font-family: Georgia, 'Times New Roman', Times, serif; 
}
input{
    height: 40px;
    width: 70%;
    margin-top: 8px;
    margin-left: 10px;
    border-radius: 8px;
    border: none;      
}
legend{
    font-size: larger;
    font-style: oblique;
    color:gold;
    font-weight:30px;
}
button{
    position: absolute;
    bottom: 0;
    right: 0;
    cursor: pointer;
    margin-right: 40px;
    margin-bottom: 50px;
    padding: 7px 20px 7px 20px;
    background-color: gold;
    border: none;
    border-radius: 8px;
    font-size: 20px;
    font-family: Georgia, 'Times New Roman', Times, serif;
    color: black;  
}
.signup{
    margin-right: 40px;
    margin-bottom: 40px;
    padding-left: 20px;
    padding-bottom: 3px;
    color:gold;
}
a{
    color:white;

}
</style>
</head>
<body>
    <div class="heading">
        <h2>Login Form</h2>
    </div>
    <div>
        <form method="post" action="login.php">
            <fieldset class="outside">
                <!Name>
                <fieldset class="inside">
                <legend>Username  : </legend>
                <label for="name"> 
                <input name="uname" type="text" placeholder="Enter your email..">                
                </label> 
                </fieldset>
                <!Password>
                <fieldset class="inside">
                <legend>Password  : </legend>
                <label for="name"> 
                <input name="pwd" type="text" placeholder="Enter your password..">
                </label>
                </fieldset>
                <!Submit BUTTON>
                <label>
                <div class="button">
                    <p class="signup">New User?<a href="http://localhost/PROJECTTHREE/signup.php/">  Sign up</a></p>
                <button name="login">Login</button></div>
                </label>
            </fieldset>
        </form>
</div>
</body>
</html>

