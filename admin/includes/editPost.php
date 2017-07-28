<?php

if (isset($_GET['p_id'])){

$postToEdit = $_GET['p_id'];

}

$query = "SELECT * FROM posts WHERE post_id = $postToEdit";
$selectPostsWithID= mysqli_query($connection,$query);

while($row = mysqli_fetch_assoc($selectPostsWithID)){

  $post_id = $row['post_id'];
  $post_author = $row['post_author'];
  $post_title = $row['post_title'];
  $post_category_id = $row['post_category_id'];
  $post_status = $row['post_status'];
  $post_image = $row['post_image'];
  $post_tags = $row['post_tags'];
  $post_comment_count = $row['post_comment_count'];
  $post_date = $row['post_date'];
  $post_content = $row['post_content'];
}

if(isset($_POST['updatePost'])){
  $post_category_id = $_POST['postCategory'];
  $post_title = $_POST['title'];
  $post_author = $_POST['author'];

//image file
  $post_image = $_FILES['image']['name'];
  $post_image_temp = $_FILES['image']['tmp_name'];
//image file end

  $post_content = mysqli_real_escape_string($connection,$_POST['postContent']);
  $post_tags = $_POST['postTags'];
  $post_status = $_POST['postStatus'];

  move_uploaded_file($post_image_temp,"../images/$post_image");

  if(empty($post_image)){

    $query = "SELECT * FROM posts WHERE post_id = $postToEdit ";
    $imageSelectQuery = mysqli_query($connection,$query);

    while($row = mysqli_fetch_array($imageSelectQuery)){

      $post_image = $row['post_image'];

    }

  }

  $query  = "UPDATE posts SET ";
  $query .= "post_category_id = {$post_category_id} , ";
  $query .= "post_title = '{$post_title}' , ";
  $query .= "post_author = '{$post_author}' , ";
  $query .= "post_content = '{$post_content}' , ";
  $query .= "post_tags = '{$post_tags}' , ";
  $query .= "post_status = '{$post_status}' , ";
  $query .= "post_date  = now() , ";
  $query .= "post_image = '{$post_image}' ";
  $query .= "WHERE post_id = {$postToEdit} ";

  $updatePostDB = mysqli_query($connection,$query);
  querySuccess($updatePostDB);

  echo "<h3 class='bg-success'>Post Updated. <a href='../post.php?p_id={$post_id}'>View Post</a> or <a href='posts.php'>Edit More Posts.</a></h3>";
  }
?>

<form action="" method="post" enctype="multipart/form-data">

  <div class ="form-group">
    <label for="title">Post Title</label>
    <input value = "<?php echo $post_title ?>" type="text" class="form-control" name="title">
  </div>

  <div class ="form-group">

    <label for="postCategroy">Post Category ID</label>

    <br>

    <select name="postCategory" id="">

      <?php
      $query = "SELECT * FROM category WHERE cat_id = {$post_category_id} ";
      $currentCategoryID = mysqli_query($connection,$query);

      $queryOptions = "SELECT * FROM category WHERE cat_id <> {$post_category_id}";
      $selectCatOptions = mysqli_query($connection,$queryOptions);


      querySuccess($selectCatOptions);
      querySuccess($currentCategoryID);
      while($row = mysqli_fetch_assoc($currentCategoryID )) {
      $cat_id = $row['cat_id'];
      $cat_title = $row['cat_title'];

      echo "<option value='$cat_id'>{$cat_title}</option>";

      }

      while($row = mysqli_fetch_assoc($selectCatOptions )) {
      $cat_id = $row['cat_id'];
      $cat_title = $row['cat_title'];
      echo "<option value='$cat_id'>{$cat_title}</option>";
      }


      ?>

    </select>

  </div>

  <!-- <div class ="form-group">
    <label for="author">Post Author</label>
    <input value = "<?php //echo $post_author ?>" type="text" class="form-control" name="author">
  </div> -->


  <div class ="form-group">
    <label for="author">Post Author</label>
    <br>
    <select name="author" id="">
      <?php
      $query = "SELECT * FROM users";
      $selectAllUsers = mysqli_query($connection,$query);
      querySuccess($selectAllUsers);
      $query = "SELECT * FROM users WHERE user_id = $post_author";
      $selectOrigAuthor = mysqli_query($connection,$query);

      while($row = mysqli_fetch_assoc($selectOrigAuthor )){
        //select orginal author
        $user_id = $row['user_id'];
        $username = $row['username'];
        echo "<option value='$user_id'>{$username}</option>";
      }

      while($row = mysqli_fetch_assoc($selectAllUsers )) {
        //select all admins
      $user_id = $row['user_id'];
      $username = $row['username'];
      echo "<option value='$user_id'>{$username}</option>";
      }
      ?>
    </select>
  </div>





  <div class ="form-group">
    <label for="postStatus">Post Status</label>
    <select name="postStatus" id="">
<?php
      echo "<option value='{$post_status}'>{$post_status}</option>";

      if($post_status == 'published'){
        echo "<option value='draft'>draft</option>";
        echo "<option value='unapproved'>unapproved</option>";
      } else if ($post_status == 'draft'){
        echo "<option value='published'>published</option>";
        echo "<option value='unapproved'>unapproved</option>";
      } else {
        echo "<option value='published'>published</option>";
        echo "<option value='draft'>draft</option>";
      }
?>
    </select>

  </div>

  <div class ="form-group">
    <label for="image">Post Image</label>
    <br>
    <img width= "200" src="../images/<?php echo $post_image?>" alt="">
    <br>
    <input type="file" name="image">
  </div>

  <div class ="form-group">
    <label for="postTags">Post Tags</label>
    <input value = "<?php echo $post_tags ?>" type="text" class="form-control" name="postTags">
  </div>

  <div class ="form-group">
    <label for="postContent">Post Content</label>
    <textarea class="form-control" name="postContent" id="" cols="30" rows="10"><?php echo $post_content ?>
    </textarea>
  </div>

  <div class ="form-group">
    <input type="submit" class="btn btn-primary" name="updatePost" value="Update Post">
  </div>

</form>
