<?php

$db_host = "localhost";
$db_username = "root";
$db_pass = "";
$db_name = "contact";

$mysqli = mysqli_connect("$db_host", "$db_username", "$db_pass", "$db_name") or die("Could not connect to MySQL");

 if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  } else {
  echo "Connected to MySQL";
}
$errors = [];

if($_POST['name'] == ""){
    array_push($errors, "Please enter a name");
} elseif(!preg_match("/^[a-zA-Z ]*$/", $_POST['name'])){
    array_push($errors, "Only letters and white space allowed in name");
} else{
       $name = $_POST['name'];
}
if($_POST['email'] == ""){
     array_push($errors, "Please enter an email");
} elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    array_push($errors, "Please enter a valid email");
} else{
     $email = $_POST['email'];
}
if($_POST['message'] != ""){
    $message = $_POST['message'];
}
else{
    array_push($errors, "Please enter a message");
}
date_default_timezone_set('America/Boise');
$date = date('Y/m/d');
if(count($errors) == 0){

$sql = "INSERT INTO contactv2 (name, email, message, date) VALUES ('$name',
'$email', '$message', '$date')";

if(!mysqli_query($mysqli, $sql)){
	echo "Not inserted";
}
else{
	echo "Inserted successfully";
}
}

?>

<html>
  <head>
    <meta charset="utf-8">
    <title>Kevin Liang | Contact</title>
    <link rel="stylesheet" href="./css/contact.css">
	<link rel="stylesheet" href="./css/nav.css">
    <link href="https://fonts.googleapis.com/css?family=Pavanam" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  </head>
  <body>

    <header>
      <div class ="wrapper">
        <a href="index.html"><img src="./img/logo.png" id="logo"></a>
                <nav id="nav1">
          <ul>
            <li ><a href="index.html"> HOME</a></li>
            <li><a href="blog.html"> BLOG</a></li>
            <li class="current"><a href="contact.html"> CONTACT</a></li>
            <li ><a href="about.html"> ABOUT </a></li>
          </ul>
          </nav>
        </header>

	<div id="contact">
	<div id="input">
	<?php if(count($errors) == 0) : ?>
	    <h1> Message Submitted!</h1>
	<?php else : ?>
      <h1> Error sending message </h1>
	<?php foreach($errors as $error) : ?>
	<div  id="errors">
	    <ul>
	    <li> <?php echo $error; ?> </li>
	    </ul>
	   </div>
	<?php endforeach; ?>
	<?php endif; ?>
	<form action="contact.php" method="post">
	NAME:<br>
	<input type="text" name="name"
	value = "<?php echo (count($errors) != 0) ? $_POST['name'] : '' ?>"/><br>
	EMAIL:<br>
	<input type="text" name="email"
	value = "<?php echo (count($errors) != 0) ? $_POST['email'] : '' ?>"/><br>
	MESSAGE:<br>
	<textarea type="text" name="message" style="text-align: left;">
	    <?php echo (count($errors) != 0) ? $_POST['message'] : '' ?>
	</textarea><br>
	<input type="submit" value="Submit" />
	</form>

	</div>
	<div id="info">
	<h1> Contact Info </h1>
	<p> 1135 NE Campus Parkway </p>
	<p> Seattle WA, 98105 </p>
	<p> 425-949-2866 </p>
	<p> kevinliang.ee@gmail.com </p>
	</div>
	</div>




  </body>
</html>
