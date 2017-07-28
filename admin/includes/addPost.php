<?php

if(isset($_POST['createPost'])){
  //check all fields are entered.

if(isset($_POST['postCategory'])&& isset($_POST['title'])&& isset($_POST['author']) && isset($_POST['postContent']) && isset($_POST['postTags']) && isset($_POST['postStatus'])){
//fileupload start
include "fileUpload.php";
//image file end
if($uploadOk == 1){

    $post_image = $_FILES['fileToUpload']['name'];
    $post_category_id =  htmlentities(mysqli_real_escape_string($connection,$_POST['postCategory']));
    $post_title = htmlentities(mysqli_real_escape_string($connection,$_POST['title']));
    $post_author = htmlentities(mysqli_real_escape_string($connection,$_POST['author']));
    $post_content = mysqli_real_escape_string($connection,$_POST['postContent']);
    $post_tags = htmlentities(mysqli_real_escape_string($connection,$_POST['postTags']));
    $post_status = htmlentities(mysqli_real_escape_string($connection,$_POST['postStatus']));

    $query = "INSERT INTO posts(
      post_category_id,
      post_title,
      post_author,
      post_date,
      post_image,
      post_content,
      post_tags,
      post_status) VALUES (
     {$post_category_id},
    '{$post_title}',
    '{$post_author}',
     now(),
     '{$post_image}',
     '{$post_content}',
     '{$post_tags}',
     '{$post_status}') ";

    $createPostQuery = mysqli_query($connection, $query);
    querySuccess($createPostQuery);
    echo "<h3 class='bg-success'>Post Created. <a href='posts.php'>Return to View All Posts.</a></h3>";
} //if upload ok to go

} else {

echo "<h3 class='bg-danger'>Nothing Posted. Something went wrong.<a href='posts.php'>Return to View All Posts.</a></h3>";

}

} // if isset statment

?>


<form class="form-horizontal" role="form" method="post" action="" enctype="multipart/form-data">

  <div class ="form-group">
    <label for="title">Post Title</label>
    <input type="text" class="form-control" name="title">
  </div>

  <div class ="form-group">
    <label for="postCategroy">Post Category ID</label>
    <br>
    <select name="postCategory" id="">
      <?php
      $query = "SELECT * FROM category ";
      $selectCatOptions = mysqli_query($connection,$query);

      querySuccess($selectCatOptions);

      while($row = mysqli_fetch_assoc($selectCatOptions )) {
      $cat_id = $row['cat_id'];
      $cat_title = $row['cat_title'];
      echo "<option value='$cat_id'>{$cat_title}</option>";
      }
      ?>
    </select>
  </div>




<!-- select admin only -->

<div class ="form-group">
  <label for="author">Post Author</label>
  <br>
  <select name="author" id="">
    <?php
    $query = "SELECT * FROM users WHERE access_level = 'admin' ";
    $selectAdmins = mysqli_query($connection,$query);
    querySuccess($selectAdmins);
    while($row = mysqli_fetch_assoc($selectAdmins )) {
    $user_id = $row['user_id'];
    $username = $row['username'];
    echo "<option value='$user_id'>{$username}</option>";
    }
    ?>
  </select>
</div>

<!-- end admin only -->

<!-- empty field  -->

<!-- <div class ="form-group">
  <label for="author">Post Author</label>
  <input type="text" class="form-control" name="author">
</div> -->

<!-- end empty field -->


  <div class ="form-group">
    <label for="postStatus">Post Status</label>
    <select name="postStatus" id="" required>
      <option value="draft">Draft</option>
      <option value="published">Published</option>
      <option value="unapproved">Unapproved</option>
    </select>
  </div>

  <div class ="form-group">
    <label for="image">Post Image</label>
    <input type="file" name="fileToUpload" id="fileToUpload">
  </div>


  <div class ="form-group">
    <label for="postTags">Post Tags</label>
    <input type="text" class="form-control" name="postTags">
  </div>

  <div class ="form-group">
    <label for="postContent">Post Content</label>
    <textarea class="form-control" name="postContent" id="" cols="30" rows="10"></textarea>
  </div>


	<div class="form-group">
		<div class="col-sm-10 col-sm-offset-2">
			<input id="submit" name="createPost" type="submit" value="Submit Post" class="btn btn-primary">
		</div>
	</div>

</form>
