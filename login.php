<?php
session_start();
?>
<head>
<link rel="stylesheet" type="text/css" href="style.css"/>
<style>
h3{color:#002e4d}
</style>
<script>
function tabs(evt,name)
{
var i,content,links;

content=document.getElementsByClassName("content");
for(i=0;i<content.length;i++)
content[i].style.display="none";

links=document.getElementsByClassName("tlinks");
for(i=0;i<links.length;i++)
links[i].className=links[i].className.replace("active","");

document.getElementById(name).style.display="block";
document.getElementById(name).style.backgroundColor="#ccebff";
document.getElementById(name).style.borderRadius="12px";
evt.currentTarget.className+="active";

}

</script>
</head>
<body id="log">


<?php
$flag=0;
$flag1=0;
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
	extract($_POST);
	$conn=mysqli_connect('localhost','root','','proj');
	// Check connection
	if (!$conn)
		{
		die("Connection failed: " . mysqli_connect_error());
		}

	$sql = "SELECT * FROM user";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0)
		{
    // output data of each row
    while($row = mysqli_fetch_assoc($result))
		{
			if(isset($Name))//sign up
			{
				if($Email==$row['email'])
				{	
					echo '<script>alert("You have already registered!");</script>';
					$flag=1;
					echo '<script>window.location.assign(window.location.href);</script>';
					
					//break;
				}
			}
			else//login
			{
				if(($Email==$row['email'])&&($Password!=$row['pwd']))
				{
				echo '<script>alert("Incorrect password");</script>';
				$flag=1;
				echo '<script>window.location.assign(window.location.href)</script>';				
				//break;
				}
				if(($Email==$row['email'])&&($Password==$row['pwd']))// a subscribed user
				{
				$flag1=1;
				echo '<script>window.location.assign("dashboard.html");</script>';
				break;
				//break;
				}
			}
		   
		}
		if(($flag==0)&&($flag1==0))
		{
			if(isset($Name))
			{
				$sql="INSERT INTO user values('$Name','$Email','$Password')";
			mysqli_query($conn,$sql);
			echo '<script>window.location.assign("dashboard.html");</script>';
			}
			else
			{
				echo '<script>alert("Please register before continuing!");</script>';
				echo '<script>window.location.assign(window.location.href)</script>';
			}
		}
		}
		else
		{
			if(isset($Name))
			{
			$sql="INSERT INTO user values('$Name','$Email','$Password')";
			mysqli_query($conn,$sql);
			echo '<script>window.location.assign("dashboard.html");</script>';
			}
			else
			{
				echo '<script>alert("Please register before continuing!");</script>';
				echo '<script>window.location.assign(window.location.href)</script>';
				
			}
		}
}
?>
<ul class="tabs1">
	<li><a href="home.html">HOME</a></li>
	<li><a href="aboutus.html">ABOUT US</a></li>
	<li><a href="faqs.html">FAQ's</a></li>
	<li class="ti"><img src='babel.png'alt='nemo'/><img src="logo1.png" alt ="logo"></li>
	</ul>
<div class="login">
<ul class="links">
<li><a href="#" class="tlinks" id="me"onclick="tabs(event,'Login')">Login</a></li>
<li><a href="#" class="tlinks" onclick="tabs(event,'Sign')">Register</a></li>
</ul>
<div class="content" id="Login">
</br>
	<center><h3>Login</h3><center>
	</br>
	<form method="post">
	
	<input type="text" name="Email" required placeholder='Enter email id'/></br>
	
	<input type="password" name="Password" required placeholder='Enter password'/></br>
	</br>
	<input type="submit" value="LOGIN"/></br></br>
	</form>
	</div>
<div class="content" id="Sign">
<center><h3>Register</h3><center>
</br>
<form method="post">

<input type="text" name="Name" required placeholder="Enter your name"/></br>

<input type="email" name="Email" required placeholder='Enter email id'/></br>

<input type="password" name="Password" required placeholder='Enter password'/><br>
</br>
<input type="submit" value="SIGN UP"/>
</br>
</form>
</div>
</div>
</body>
