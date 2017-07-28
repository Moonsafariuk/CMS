<?php include "includes/adminHeader.php"; ?>

    <div id="wrapper">

<?php include "includes/adminNavigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                      <h1 class="page-header">
                          Comments
                          <small></small>
                      </h1>
<?php
  if(isset($_GET['delete'])){
    $deleteCommentID = $_GET['delete'];
    $query = "DELETE FROM comments WHERE comment_id = {$deleteCommentID}";
    $delete_query = mysqli_query($connection,$query);
    querySuccess($delete_query);
    //update post counter.
    // $post_id = $row['post_id'];
    // $query = "UPDATE posts SET post_comment_count = post_comment_count - 1 ";
    // $query .= "WHERE post_id = $post_id";
    // $increaseCommentCounter = mysqli_query($connection,$query);
    // querySuccess($increaseCommentCounter);
    header('Location: post_comments.php?p_id='.mysqli_real_escape_string($connection,$_GET['p_id']).'');
  }


  if(isset($_GET['reject'])){
    $rejectCommentID = $_GET['reject'];
    $query = "UPDATE comments SET comment_status = 'rejected' WHERE comment_id = {$rejectCommentID}";
    $reject_query = mysqli_query($connection,$query);
    querySuccess($reject_query);
    header('Location: post_comments.php?p_id='.mysqli_real_escape_string($connection,$_GET['p_id']).'');
  }


  if(isset($_GET['approve'])){
    $approveCommentID = $_GET['approve'];
    $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = {$approveCommentID}";
    $approve_query = mysqli_query($connection,$query);
    querySuccess($approve_query);
    header('Location: post_comments.php?p_id='.mysqli_real_escape_string($connection,$_GET['p_id']).'');
  }


 ?>


<table class="table table-bordered table-hover">
  <thead>
    <tr>
    <th>ID</th>
    <th>Author</th>
    <th>Comment</th>
    <th>Email</th>
    <th>In Response To</th>
    <th>Date</th>
    <th>Status</th>
    <th>Approve</th>
    <th>Reject</th>
    <th>Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php

      $query = "SELECT * FROM comments WHERE comment_post_id =".mysqli_real_escape_string($connection,$_GET['p_id'])." ";
      $selectComments= mysqli_query($connection,$query);

      while($row = mysqli_fetch_assoc($selectComments)){

        $comment_id = $row['comment_id'];
        $comment_post_id = $row['comment_post_id'];
        $comment_date = $row['comment_date'];
        $comment_author = $row['comment_author'];
        $comment_email = $row['comment_email'];
        $comment_content = $row['comment_content'];
        $comment_status = $row['comment_status'];

        echo "<tr>";
          echo "<td>{$comment_id}</td>";
          echo "<td>{$comment_author}</td>";
          echo "<td>{$comment_content}</td>";
          echo "<td>{$comment_email}</td>";

          $query = "SELECT * FROM posts  WHERE post_id = $comment_post_id";
          $queryCommentPostTitle = mysqli_query($connection,$query);

          while ($row = mysqli_fetch_assoc($queryCommentPostTitle)){
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
              echo "<td><a href='../post.php?p_id=$post_id'>{$post_title}</a></td>";
          }

          echo "<td>{$comment_date}</td>";
          echo "<td>{$comment_status}</td>";

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
          echo "<td><a href='post_comments.php?approve=$comment_id&p_id=$comment_post_id'>Approve</a></td>";
          echo "<td><a href='post_comments.php?reject=$comment_id&p_id=$comment_post_id'>Reject</a></td>";
          echo "<td><a href='post_comments.php?delete=$comment_id&p_id=$comment_post_id'>Delete</a></td>";
        echo "</tr>";
      }
    ?>
  </tbody>
</table>



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
