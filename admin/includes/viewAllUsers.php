
<?php

if(isset($_GET['delete'])){
  if(isset($_SESSION['user_access_level'])){
    if(isset($_SESSION['user_access_level']) && $_SESSION['user_access_level'] == 'admin'){
      if(isset($_GET['delete'])){
        $deleteUserID = mysqli_real_escape_string($connection,$_GET['delete']);
        $query = "DELETE FROM users WHERE user_id = {$deleteUserID}";
        $deleteUser = mysqli_query($connection,$query);
        querySuccess($deleteUser);
        header('Location: users.php');
      }
    }
  }
}


if(isset($_GET['deactivate'])){
  if(isset($_SESSION['user_access_level'])){
    if(isset($_SESSION['user_access_level']) && $_SESSION['user_access_level'] == 'admin'){
    if(isset($_GET['deactivate'])){
      $rejectUserID = mysqli_real_escape_string($connection,$_GET['deactivate']);
      $query = "UPDATE users SET user_active = 'inactive' WHERE user_id = {$rejectUserID}";
      $rejectUser = mysqli_query($connection,$query);
      querySuccess($rejectUser);
      header('Location: users.php');
      }
    }
  }
}

  if(isset($_GET['activate'])){
    if(isset($_SESSION['user_access_level'])){
      if(isset($_SESSION['user_access_level']) && $_SESSION['user_access_level'] == 'admin'){
        if(isset($_GET['activate'])){
          $approveUser = mysqli_real_escape_string($connection,$_GET['activate']);
          $query = "UPDATE users SET user_active = 'approved' WHERE user_id = {$approveUser}";
          $approveUser = mysqli_query($connection,$query);
          querySuccess($approveUser);
          header('Location: users.php');
        }
      }
    }
  }

  if(isset($_GET['access_level_change'])){
    if(isset($_SESSION['user_access_level'])){
      if(isset($_SESSION['user_access_level']) && $_SESSION['user_access_level'] == 'admin'){
        if(isset($_GET['access_level_change'])){
          $changeAccessLevelID = mysqli_real_escape_string($connection,$_GET['access_level_change']);
          $currentAccessLevel = mysqli_real_escape_string($connection,$_GET['current_access_level']);
          if($currentAccessLevel == subscriber){
          $query = "UPDATE users SET access_level = 'admin' WHERE user_id = {$changeAccessLevelID}";
          } else {
            $query = "UPDATE users SET access_level = 'subscriber' WHERE user_id = {$changeAccessLevelID}";
          }
          $changeAccessQuery = mysqli_query($connection,$query);
          querySuccess($changeAccessQuery);
          header('Location: users.php');
        }
      }
    }
  }

 ?>


<table class="table table-bordered table-hover">
  <thead>
    <tr>
    <th>ID</th>
    <th>Username</th>
    <th>First Name</th>
    <th>Surname</th>
    <th>Email</th>
    <th>Image</th>
    <th>Access Level</th>
    <th>Change Access Level</th>
    <th>Date Joined</th>
    <th>Active</th>
    <th>Activate</th>
    <th>Deactivate</th>
    <th>Edit</th>
    <th>Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php

      $query = "SELECT * FROM users";
      $selectUsers= mysqli_query($connection,$query);

      while($row = mysqli_fetch_assoc($selectUsers)){

        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_first_name = $row['user_first_name'];
        $user_surname = $row['user_surname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_access_level = $row['access_level'];
        $user_active = $row['user_active'];
        $user_date_joined = $row['date_joined'];
        $user_randSalt = $row['user_randSalt'];

        echo "<tr>";
          echo "<td>{$user_id}</td>";
          echo "<td>{$username}</td>";
          echo "<td>{$user_first_name}</td>";
          echo "<td>{$user_surname}</td>";
          echo "<td>{$user_email}</td>";
          echo "<td>{$user_image}</td>";
          echo "<td>{$user_access_level}</td>";

          if($user_access_level == 'subscriber'){
            echo "<td><a href='users.php?access_level_change=$user_id&current_access_level=$user_access_level'>Make Admin</a></td>";

          } else {
            echo "<td><a href='users.php?access_level_change=$user_id&current_access_level=$user_access_level'>Make Subscriber</a></td>";
          }


          echo "<td>{$user_date_joined}</td>";
          echo "<td>{$user_active}</td>";

          if($user_active == 'approved'){
            echo "<td>User Active</td>";
            echo "<td><a href='users.php?deactivate=$user_id'>Deactivate</a></td>";
          } else {
            echo "<td><a href='users.php?activate=$user_id'>Activate</a></td>";
            echo "<td>User Inactive</td>";
          }

          echo "<td><a href='users.php?source=edit_user&user_id=$user_id'>Edit</a></td>";
          echo "<td><a href='users.php?delete=$user_id'>Delete</a></td>";
        echo "</tr>";
      }
    ?>
  </tbody>
</table>


<?php
// $query = "SELECT * FROM posts  WHERE post_id = $comment_post_id";
// $queryCommentPostTitle = mysqli_query($connection,$query);
//
// while ($row = mysqli_fetch_assoc($queryCommentPostTitle)){
//   $post_id = $row['post_id'];
//   $post_title = $row['post_title'];
//     echo "<td><a href='../post.php?p_id=$post_id'>{$post_title}</a></td>";
// }

// $query = "SELECT * FROM category WHERE cat_id = $post_category_id";
// $queryEditCategory = mysqli_query($connection,$query);
//
// while($row = mysqli_fetch_assoc($queryEditCategory)){
//
// $cat_id =$row['cat_id'];
// $cat_title =$row['cat_title'];
//
//
// echo "<td>{$cat_title}</td>";
//
// }
?>
