<h3>Add A New User Here.</h3>

<?php

  if(isset($_POST['addUser'])){

    $user_first_name = $_POST['user_first_name'];
    $user_surname = $_POST['user_surname'];
    $user_email = $_POST['user_email'];
    $username = $_POST['username'];
    $user_password = $_POST['user_password'];
    $access_level = $_POST['access_level'];

    $date_joined = date('d-m-y');

//image file
    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];
    move_uploaded_file($user_image_temp,"../images/users/$user_image");
//image file end

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

    $createUserQuery = mysqli_query($connection, $query);
    querySuccess($createUserQuery);

    echo "<h4>User Created: " . "<a href='users.php'>View Users.</a> </h4>";

  } // if isset statment

?>

<form action="" method="post" enctype="multipart/form-data">

  <div class ="form-group">
    <label for="user_first_name">First Name</label>
    <input type="text" class="form-control" name="user_first_name">
  </div>

  <div class ="form-group">
    <label for="user_surname">Last Name</label>
    <input type="text" class="form-control" name="user_surname">
  </div>

  <div class ="form-group">
    <label for="user_email">Email</label>
    <input type="email" class="form-control" name="user_email">
  </div>

  <div class ="form-group">
    <label for="username">Username (sign in)</label>
    <input type="text" class="form-control" name="username">
  </div>

  <div class ="form-group">
    <label for="user_password">User Password</label>
    <input type="password" class="form-control" name="user_password">
  </div>

  <div class ="form-group">
    <label for="user_image">User Image</label>
    <input type="file" name="user_image">
  </div>

  <div class ="form-group">
    <label for="access_level">Role</label>
    <select name="access_level" id="">
      <option value='subscriber'>Select Option</option>"
      <option value='admin'>Admin</option>
      <option value='subscriber'>Subscriber</option>
    </select>
  </div>

  <div class ="form-group">
    <input type="submit" class="btn btn-primary" name="addUser" value="Add User">
  </div>

</form>


<!-- <div class ="form-group">

  <label for="postCategroy">Post Category ID</label>

  <br>

  <select name="postCategory" id=""> -->

    <?php
    // $query = "SELECT * FROM category ";
    // $selectCatOptions = mysqli_query($connection,$query);
    //
    // querySuccess($selectCatOptions);
    //
    // while($row = mysqli_fetch_assoc($selectCatOptions )) {
    // $cat_id = $row['cat_id'];
    // $cat_title = $row['cat_title'];
    // echo "<option value='$cat_id'>{$cat_title}</option>";
    // }
    ?>

  <!-- </select>

</div>

<div class ="form-group">
  <label for="author">Post Author</label>
  <input type="text" class="form-control" name="author">
</div>

<div class ="form-group">
  <label for="postStatus">Post Status</label>
  <input type="text" class="form-control" name="postStatus">
</div>

<div class ="form-group">
  <label for="image">Post Image</label>
  <input type="file" name="image">
</div>

<div class ="form-group">
  <label for="postTags">Post Tags</label>
  <input type="text" class="form-control" name="postTags">
</div>

<div class ="form-group">
  <label for="postContent">Post Content</label>
  <textarea class="form-control" name="postContent" id="" cols="30" rows="10">
  </textarea>
</div> -->
