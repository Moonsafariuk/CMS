<?php session_start(); ?>
<?php include "includes/db.php";?>
<?php include "includes/header.php"; ?>

    <!-- Navigation -->
    <?php include "includes/navbartop.php";?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

              <?php
              if(isset($_GET['p_id'])){
                $post_id = $_GET['p_id'];

                //update post view count
                // $query = "UPDATE posts SET post_view_count = post_view_count +1 WHERE post_id = $post_id ";
                // $increaseViewCountQuery = mysqli_query($connection,$query);
                //populate posts:

                $query = "SELECT * FROM posts WHERE post_id = $post_id";
                $queryAllPosts = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($queryAllPosts)){
                  $post_title = $row['post_title'];
                  $post_author = $row['post_author'];
                  $post_date = $row['post_date'];
                  $post_image = $row['post_image'];
                  $post_content = $row['post_content'];

                  $query = "SELECT * FROM users WHERE user_id = $post_author ";
                  $selectAdmins = mysqli_query($connection,$query);
                  querySuccess($selectAdmins);
                  while($row = mysqli_fetch_assoc($selectAdmins )) {
                  $post_author_id = $row['user_id'];
                  $post_author = $row['username'];
                  }

                ?>

                <!-- <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1> -->

                <!-- First Blog Post -->
                <h2>
                    <?php echo $post_title ?>
                </h2>
                <p class="lead">
                    by <?php echo $post_author ?>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                <hr>
                <p> <?php echo $post_content ?></p>

              <!--   <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a> -->

                <hr>

              <?php
                } //end of content while loop
              }else{

                header("Location:index.php");


              } ?>


<!-- Comment section -->

<?php

  if(isset($_POST['createComment'])){

    $post_id = mysqli_real_escape_string($connection,$_GET['p_id']);
    $comment_author = mysqli_real_escape_string($connection,$_POST['comment_author']);
    $comment_email = mysqli_real_escape_string($connection,$_POST['comment_email']);
    $comment_content = mysqli_real_escape_string($connection,$_POST['new_comment']);

    if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){
      $query = "INSERT INTO comments (comment_post_id, comment_date,
      comment_author, comment_email, comment_content, comment_status) ";

      $query .= "VALUES ($post_id, now(),
      '{$comment_author}', '{$comment_email}', '{$comment_content}', 'Unapproved')";

      $createCommentQuery = mysqli_query($connection, $query);
      querySuccess($createCommentQuery);

      //update post counter.
      $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
      $query .= "WHERE post_id = $post_id";
      $increaseCommentCounter = mysqli_query($connection,$query);
      querySuccess($increaseCommentCounter);
    } else {
      echo "<script>alert('Please fill in all fields to make a comment.');</script>";
    }
  }


?>

<div class="well">
  <h4>Leave a Comment</h4>
  <form role ="form" action="" method="post">

    <div class="form-group">
      <label for="comment_author">Your Name</label>
      <input class="form-control" type="text" name="comment_author" >
    </div>

      <div class="form-group">
        <label for="comment_email">Email</label>
        <input class="form-control" type="email" name="comment_email">
      </div>


    <div class="form-group">
      <label for="new_comment">Comment</label>
      <textarea name="new_comment" class="form-control" rows="3"></textarea>
    </div>
    <button name="createComment" type="submit" class="btn btn-primary">Submit</submit>
  </form>
  </div>





                  <!-- Comment -->

<?php

$post_id = $_GET['p_id'];
$query = "SELECT * FROM comments WHERE comment_post_id = $post_id ";
$query .= "AND comment_status = 'approved' ";
$query .= "ORDER BY comment_id DESC";

//echo $query."<br>";

$select_comments_query = mysqli_query($connection,$query);

querySuccess($select_comments_query);

while($row = mysqli_fetch_array($select_comments_query)){

  $comment_date = date("d/m/y",strtotime($row['comment_date']));
  $comment_content = $row['comment_content'];
  $comment_author = $row['comment_author'];

?>
<!--  Comment Template Start -->
<div class="media">
    <a class="pull-left" href="#">
        <img height="64px" width="64px" class="media-object" src="
        images/users/<?php
        $query = "SELECT * FROM users WHERE user_id = $comment_author";
        $selectProfileImage= mysqli_query($connection,$query);
        while($row = mysqli_fetch_assoc($selectProfileImage)){
          $profile = $row['user_image'];
          echo "{$profile}";
        } // while
        ?> " alt="<?php echo "{$profile}"?>">
    </a>
    <div class="media-body">
        <h4 class="media-heading"><?php
        if(isset($comment_author) || !empty($comment_author)){
          $query = "SELECT * FROM users WHERE user_id = $comment_author";
          $selectCommentAuthorUsername= mysqli_query($connection,$query);
          while($row = mysqli_fetch_assoc($selectCommentAuthorUsername)){
            $comment_author = $row['username'];
            echo "{$comment_author}";
          } // while
        } else {
          echo "Unknown";
        };

         ?>
            <small><?php echo $comment_date; ?></small>
        </h4>
        <?php echo $comment_content ?>
    </div>
</div>
<br><br>
<!-- End Comment template -->

<?php
}
?>

            <!-- End Comment section -->




            </div>

            <!-- Blog Sidebar Widgets Column -->

            <?php include "includes/navbarside.php"; ?>


            <?php include "includes/footer.php"; ?>
