
<?php include "includes/adminHeader.php"; ?>

<?php

  if(isset($_SESSION['username'])){

    $username = $_SESSION['username'];

    $query ="SELECT * FROM users WHERE username = '{$username}'";

    $selectUserProfile = mysqli_query($connection,$query);

    querySuccess($selectUserProfile);

    while($row = mysqli_fetch_array($selectUserProfile)){
      $user_id=$row['user_id'];
      $user_first_name = $row['user_first_name'];
      $user_surname = $row['user_surname'];
      $user_email = $row['user_email'];
      $username = $row['username'];
      $access_level = $row['access_level'];
      $user_image = $row['user_image'];
    }

  }


  if(isset($_POST['updateUser'])){
  //Update user details from POST.
   $user_first_name = mysqli_real_escape_string($connection,$_POST['user_first_name']);
   $user_surname = mysqli_real_escape_string($connection,$_POST['user_surname']);
   $user_email = mysqli_real_escape_string($connection,$_POST['user_email']);
   $username = mysqli_real_escape_string($connection,$_POST['username']);
  $user_password = mysqli_real_escape_string($connection,$_POST['user_password']);
  $access_level = mysqli_real_escape_string($connection,$_POST['access_level']);
    $user_image = mysqli_real_escape_string($connection,$_POST['user_image']);

  //image file
    $user_image = $_FILES['new_user_image']['name'];
    $user_image_temp = $_FILES['new_user_image']['tmp_name'];
  //image file end


    move_uploaded_file($user_image_temp,"../images/users/$user_image");

    if(empty($user_image)){
      $query = "SELECT * FROM users WHERE username = '{$username}'  ";
      $imageSelectQuery = mysqli_query($connection,$query);
      while($row = mysqli_fetch_array($imageSelectQuery)){
        $user_image = $row['user_image'];
      }
    }

    if(empty($user_password)){
      $query = "SELECT * FROM users WHERE username = '{$username}'  ";
      $userPasswordSelect = mysqli_query($connection,$query);
      while($row = mysqli_fetch_array($userPasswordSelect)){
        $user_password = $row['user_password'];
      }
    } else if (!empty($user_password)){
      $user_password = password_hash($user_password, PASSWORD_DEFAULT);
    }


    $query  = "UPDATE users SET ";
    $query .= "user_first_name = '{$user_first_name}' , ";
    $query .= "user_surname = '{$user_surname}' , ";
    $query .= "user_email = '{$user_email}' , ";
    $query .= "username = '{$username}' , ";
    $query .= "user_password = '{$user_password}' , ";
    $query .= "access_level = '{$access_level}' , ";
    $query .= "user_image = '{$user_image}' ";
    $query .= "WHERE username = '{$username}' ";



     $updateUserQuery = mysqli_query($connection,$query);
     querySuccess($updateUserQuery);
      }


?>

    <div id="wrapper">

<?php include "includes/adminNavigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                      <h1 class="page-header">
                          Welcome to your profile, <?php echo $username;?>
                      </h1>

                      <form action="" method="post" enctype="multipart/form-data">

                        <div class ="form-group">
                          <label for="user_first_name">First Name</label>
                          <input value="<?php echo $user_first_name?>" type="text" class="form-control" name="user_first_name">
                        </div>

                        <div class ="form-group">
                          <label for="user_surname">Last Name</label>
                          <input value="<?php echo $user_surname?>" type="text" class="form-control" name="user_surname">
                        </div>

                        <div class ="form-group">
                          <label for="user_email">Email</label>
                          <input value="<?php echo $user_email?>" type="email" class="form-control" name="user_email">
                        </div>

                        <div class ="form-group">
                          <label for="username">Username (sign in)</label>
                          <input value="<?php echo $username?>" type="text" class="form-control" name="username">
                        </div>

                        <div class ="form-group">
                          <label for="user_password">User Password</label>
                          <input placeholder="Leave Blank To Keep It The Same" type="password" class="form-control" name="user_password">
                        </div>

                        <div class ="form-group">
                          <label for="curent_user_image">Current Image</label>
                          <img src="../images/users/<?php echo $user_image?>" name="current_user_image" class="img-responsive img-rounded" style="width:200px;height:200px;" alt="Current user image">

                        </div>

                        <div class ="form-group">
                          <label for="new_user_image">Change Image</label>
                          <input type="file" name="new_user_image">
                        </div>

                        <div class ="form-group">
                          <label for="access_level">Access Level</label>
                          <select name="access_level" id="">
                            <option value='<?php echo $access_level ?>'><?php echo $access_level ?></option>
                      <?php
                            if($access_level == 'admin'){
                              echo "<option value='subscriber'>subscriber</option>";
                            } else {
                              echo "<option value='admin'>admin</option>";
                            }
                      ?>
                          </select>
                        </div>

                        <div class ="form-group">
                          <input type="submit" class="btn btn-primary" name="updateUser" value="Update Profile">
                        </div>

                      </form>
                    </div>
                </div>
                <!-- /.row -->

              </div>
            <!-- /.container-fluid -->

          </div>
          <!-- /#page-wrapper -->

        </div>
          <!-- /#wrapper -->

<?php include "includes/adminFooter.php";?>
