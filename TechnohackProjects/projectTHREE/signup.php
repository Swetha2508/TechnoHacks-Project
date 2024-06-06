<?php
//DEFINE THE VARIABLES
$nameErr = $emailErr = $phoneErr = $genderErr = $courseErr = $collegeErr = $technicalErr = $pwderr = "" ;

$name = $email = $phone = $gender = $course = $college = $technical = $pwd = "";

//COMPARE THE METHOD
if($_SERVER["REQUEST_METHOD"]=="POST")
{
//NAME
if(empty($_POST['name']))
{
    $nameErr="Name is required";
}
else
{
    $name = input_data($_POST['name']);
    if(!preg_match("/^[a-zA-Z ]*$/",$name))
    {
        $nameErr="Only alphabets & whitespaces are allowed";
    }
}

//EMAIL
if(empty($_POST['email']))
{
    $emailErr="Email is required";
}
else
{
    $email = input_data($_POST['email']);
    if(!filter_var($email,FILTER_VALIDATE_EMAIL))
    {
        $emailErr="Invalid Email Format";
    }
} 

//PHONE
if(empty($_POST['phone']))
{
    $phoneErr="Phone is required";
}
else
{
    $phone = input_data($_POST['phone']);
    if(!preg_match("/^[0-9]*$/",$phone))
    {
        $phoneErr = "Only numeric value is allowed";
    }
    elseif(strlen($phone)!=10)
    {
        $phoneErr = "Phone no. must contain 10 digits";
    }
}

//GENDER
if(empty($_POST['gender']))
{
    $genderErr="Gender is required";
}
else
{
    $gender = input_data($_POST['gender']);
   
}

//TECHNICAL
if(empty($_POST['technical']))
{
    $technicalErr="Choose the event";
}

//COLLEGE
if(empty($_POST['college']))
{
    $collegeErr="Enter your college name";
}

//COURSE
if(empty($_POST['course']))
{
    $courseErr="Enter your course name";
}

//PASSWORD
if(empty($_POST['pwd']))
{
    $courseErr="Enter your password";
}
}

function input_data($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//MYSQL DATABASE
if((!empty($_POST['name']))&&(!empty($_POST['email']))&&(!empty($_POST['phone']))&&(!empty($_POST['gender']))&&(!empty($_POST['college']))&&(!empty($_POST['course']))&&(!empty($_POST['technical'])))
{

//CONNECTION TO THE DATABASE  
$connec = mysqli_connect("localhost","root","","projthree");
  if(isset($_POST['submit']))
  {
    $name1 = $_POST['name'];
    $email1 = $_POST['email'];
    $phone1 = $_POST['phone'];
    $pwd1 = password_hash($_POST['pwd'], PASSWORD_DEFAULT);
    $gender1 = $_POST['gender'];
    $college1 = $_POST['college'];
    $course1 = $_POST['course'];
    $technical1 = implode(",",$_POST['technical']); 
    $query = "INSERT into signup(name,email,phone,pwd,gender,college,course,technical) values('$name1','$email1','$phone1','$pwd1','$gender1','$college1','$course1','$technical1')";
    if($connec->query($query)==TRUE)
    {
       echo "<script type='text/javascript'>alert('Data Added Successfully.Thank You!!')</script>";
       
    }
    else
    {
        echo 'The data entered is wrong';
        $connec->error;
    }
  }
  $connec->close();
}
?>


<!DOCTYPE html>
<html>
<head>
<title>Signup Page</title>
<style>
body 
{
    background-image: linear-gradient(200deg, rgba(180, 29, 142, 0.596), rgba(26, 170, 134, 0.712)),
                      url('background-img.webp');
    background-size: cover;
    backdrop-filter: blur(3px);
    margin: 0;
    padding: 0;
    font-family: Georgia, 'Times New Roman', Times, serif;
}
.heading 
{
    text-align: center;
    font-size: 185%;
    font-family: Georgia, 'Times New Roman', Times, serif;
    color: gold;
    margin:0px ;
}
h4
{
    margin-top : 15px;
}
p
{
    margin-top : -18px; 
}
.sub-heading
{
    font-size: 200%;
    text-align: center;
    font-family: Georgia, 'Times New Roman', Times, serif;
    color: white;
}
form
{
    border: none;
    padding: 2rem 0;
}
fieldset
{
    margin-left: 300px;
    margin-right: 300px;
    margin-top:-30px;
    border-radius: 80px;
    border: none;
    padding-bottom: 50px;
    padding-top: 30px;
    position: relative;
    background-color: rgba(255, 255, 255, 0.45);
}
.error
{
    color:red;
}
label
{
    display: block;
    justify-content: center;
    align-items: center;
    text-align: center;
    font-size: larger;
    font-family: Georgia, 'Times New Roman', Times, serif;
    color: black;
    margin-top: 10px;
}
.college, .course 
{
    padding-right: 60px;
}
input[type="text"]
{
    margin: 10px 0 20px 10px;
    height: 40px;
    border: none;
    border-radius: 5px;
    border-color: black;
    width: 250px;
}
#gender
{
    margin-right: 120px ;
}
input[type="radio"]
{
    margin: 10px 5px; /* Adjust margins for radio buttons */
}
#checkbox
{
   padding-right:60px;
}
.comments
{
    padding-right: 70px;
}
button 
{   
    display: block;
    width: 5%;
    margin: 1em auto;
    height: 2em;
    border-radius: 5px;
    min-width: 250px;
    background-color: gold;
    color: black;
    text-transform: capitalize;
    font-size: 20px;
    font-family: Georgia, 'Times New Roman', Times, serif; 
}
.but
{
    margin-top :50px;
    padding-left:30px;
}
#password{
    padding-right:30px;
}
</style>
</head>
<body>
    <div class="heading">
       <h1>Hackathon</h1>
    </div>
    <div class="sub-heading">
        <p>Signup Form</p>
    </div>
    <div>
        <form method="post" action="signup.php">
            <fieldset>

                <!Name>
                <label for="name"> Name  :
                <input name="name" type="text" id="name" placeholder="Enter your name.."><br>
                <span class="error" style="font-size: 19px;"><?php echo $nameErr;?></span>
                </label>

                <!Email>
                <label for="email">Email  :
                <input name="email" type="text" id="email" placeholder="Enter your email.." ><br>
                <span class="error" style="font-size: 19px;"><?php echo $emailErr;?></span>
                </label>

                <!Phone>
                <label for="phone">Phone  :
                <input  name="phone" type="text" id="phone" placeholder="Enter your phone no.." ><br>
                <span class="error" style="font-size: 19px;"><?php echo $phoneErr;?></span>
                </label>

                <!Password>
                <label for="name"> Password  :
                <input name="pwd" type="text" id="password" placeholder="Set your password.."><br>
                </label>

                <!Gender>
                <label for="gender" id="gender">Gender  :
                <input type="radio" id="male" name="gender" value="male">Male      
                <input type="radio" id="female" name="gender" value="female">Female<br>
                <span class="error" style="padding-left:134px; font-size:19px;"><?php echo $genderErr;?></span>
                </label>

                <!College Name>
                <label class="college" for="college">College Name  :
                <input name="college" type="text" id="college" placeholder="Enter your college name.."><br>
                <span class="error" style="padding-left:130px; font-size: 19px;"><?php echo $collegeErr;?></span>
                </label>

                <!Course Name>
                <label class="course">Course Name  :
                <input name="course" type="text" id="course" placeholder="Eg.BSc Computer Science.."><br>
                <span class="error" style="padding-left:130px; font-size: 19px;"><?php echo $courseErr;?></span>
                </label>

                <!Technical Events>
                <label id="checkbox" >Technical Events : 
                <input  type="checkbox" name="technical[]" value="Web designing">Web designing
                <input type="checkbox"  name="technical[]" value="Coding">Coding
                <input  type="checkbox" name="technical[]" value="Quiz">Quiz<br><br>
                <span class="error" style="padding-left:70px; font-size: 19px;" ><?php echo $technicalErr;?></span>
                </label>

                <!Comments>
                <label class="comments" style="padding-left:20px;">
                Comments :     <textarea rows=5 cols=32 ></textarea>
                </label>
               <label class="but" name="comments">
                <!Submit BUTTON>
                <button name="submit"><b>Submit</b></button>
                </label>
            </fieldset>
        </form>
    </div>
</body>
</html>

