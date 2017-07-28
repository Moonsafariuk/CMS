
<?php include "includes/db.php";?>
<?php// include "includes/frontEndFunctions.php";?>


<?php

if(isset($_POST['submit'])){
  //get and clean form fields

  if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['firstName']) && !empty($_POST['surname']) && !empty($_POST['password'])){
    //if all boxes are filled.
    $username = mysqli_real_escape_string($connection,$_POST['username']);
    $user_password = mysqli_real_escape_string($connection,$_POST['password']);
    $user_first_name = mysqli_real_escape_string($connection,$_POST['firstName']);
    $user_surname = mysqli_real_escape_string($connection,$_POST['surname']);
    $user_email = mysqli_real_escape_string($connection,$_POST['email']);

    $user_image = 'default.jpg';
    $access_level = 'registered';

    $user_password = password_hash($user_password, PASSWORD_DEFAULT);

    //sent user data to DB
    $query = "INSERT INTO users(
      username,
      user_password,
      user_first_name,
      user_surname,
      user_email,
      user_image,
      access_level,
      date_joined) ";

    $query .= "VALUES (
     '{$username}',
    '{$user_password}',
    '{$user_first_name}',
     '{$user_surname}',
     '{$user_email}',
     '{$user_image}',
     '{$access_level}',
      now()) ";

    $registerUserQuery = mysqli_query($connection, $query);
    //querySuccess($registerUserQuery);

    //some boxes are empty message.
    $registrationAttemptMessage = "Your Registration Has Been Submitted. Please Wait For Approval";

  } else {
      //detault message is blank.
      $registrationAttemptMessage = "Please Fill In All Fields Before Creating An Account";

  }

} else {

  $registrationAttemptMessage = "";

} //end ifset POST check
?>






<?php include "includes/header.php"; ?>

    <!-- Navigation -->
    <?php include "includes/navbartop.php";?>


    <!-- Page Content -->
    <div class="container">

<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>

                <h4 class="text-center"><?php echo $registrationAttemptMessage ?></h4>

                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">

                        <div class="form-group">
                            <label for="firstName" class="sr-only">First Name</label>
                            <input type="text" name="firstName" id="firstName" class="form-control" placeholder="First Name">
                        </div>

                        <div class="form-group">
                            <label for="surname" class="sr-only">Surname</label>
                            <input type="text" name="surname" id="surname" class="form-control" placeholder="Surname">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="yourname@emailworld.com">
                        </div>

                        <div class="form-group">
                            <label for="username" class="sr-only">Username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Username">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>

                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>

                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
