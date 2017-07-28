<?php session_start()?>
<?php include "db.php";?>

<?php

if(isset($_POST['login'])){
  $username = mysqli_real_escape_string($connection,$_POST['username']);
  $password = mysqli_real_escape_string($connection,$_POST['password']);
  $query="SELECT * FROM users WHERE username = '{$username}'";
  $selectUserQuerey = mysqli_query($connection,$query);

  if(!$selectUserQuerey){
    die("Query Failed" . mysqli_error($connection));
  }
//get user data from DB.
  while($row = mysqli_fetch_array($selectUserQuerey)){
     $db_id = $row['user_id'];
     $db_username = $row['username'];
     $db_user_password = $row['user_password'];
     $db_user_first_name = $row['user_first_name'];
     $db_user_surname = $row['user_surname'];
     $db_user_access_level = $row['access_level'];
     $db_user_email = $row['user_email'];
     $db_user_image = $row['user_image'];
  }
  //decrypt password from form returns bool
 $password = password_verify($password, $db_user_password);
     
  if($password){

    $_SESSION['username']=$db_username;
    $_SESSION['user_first_name']=$db_user_first_name;
    $_SESSION['user_surname']=$db_user_surname;
    $_SESSION['user_access_level']=$db_user_access_level;
    $_SESSION['user_email']=$db_user_email;
    $_SESSION['user_image']=$db_user_image;
    header("Location: ../admin");

  }  else {

    header("Location: ../index.php");

  }

} // end if(isset post) check



?>
