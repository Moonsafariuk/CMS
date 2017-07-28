<?php
  if(isset($_GET['delete'])){
    $deletePostID = mysqli_real_escape_string($connection,$_GET['delete']);
    $query = "DELETE FROM posts WHERE post_id = {$deletePostID}";
    $delete_query = mysqli_query($connection,$query);
    header('Location: posts.php');
  }

  if(isset($_GET['reset'])){
    $resetPostID = mysqli_real_escape_string($connection,$_GET['reset']);
    $query = "UPDATE posts SET post_view_count = 0 WHERE post_id = {$resetPostID}";
    $reset_query = mysqli_query($connection,$query);
    header('Location: posts.php');
  }
 ?>


<?php

  if(isset($_POST['checkBoxArray'])){

    foreach($_POST['checkBoxArray'] as $checkBoxPostID){

      $bulkOptions = mysqli_real_escape_string($connection,$_POST['bulkOptions']);

      switch ($bulkOptions) {
        case 'published':
          $query="UPDATE posts SET post_status = '{$bulkOptions}' WHERE post_id = {$checkBoxPostID}";
          $bulkUpdatePublish = mysqli_query($connection,$query);
          querySuccess($bulkUpdatePublish);
          break;
        case 'draft':
          $query="UPDATE posts SET post_status = '{$bulkOptions}' WHERE post_id = {$checkBoxPostID}";
          $bulkUpdateDraft = mysqli_query($connection,$query);
          querySuccess($bulkUpdateDraft);
          break;
          case 'clone':
            $query="SELECT * FROM posts WHERE post_id = {$checkBoxPostID}";
            $bulkClonePost = mysqli_query($connection,$query);
            querySuccess($bulkClonePost);

            while($row = mysqli_fetch_array($bulkClonePost)){
              $post_category_id = mysqli_real_escape_string($connection,$row['post_category_id']);
              $post_title = mysqli_real_escape_string($connection,$row['post_title']);
              $post_author = mysqli_real_escape_string($connection,$row['post_author']);
              //date done with now()
              $post_image = mysqli_real_escape_string($connection,$row['post_image']);
              $post_content = mysqli_real_escape_string($connection,$row['post_content']);
              $post_tags = mysqli_real_escape_string($connection,$row['post_tags']);
              $post_status = mysqli_real_escape_string($connection,$row['post_status']);
            }

            //insert clone into DB
            $query = "INSERT INTO posts(
              post_category_id,
              post_title,
              post_author,
              post_date,
              post_image,
              post_content,
              post_tags,
              post_status) ";

            $query .= "VALUES (
             {$post_category_id},
            '{$post_title}',
            '{$post_author}',
             now(),
             '{$post_image}',
             '{$post_content}',
             '{$post_tags}',
             '{$post_status}') ";

            $clonePostsQuery = mysqli_query($connection, $query);
            querySuccess($clonePostsQuery);

            break;
        case 'delete':
          $query="DELETE FROM posts WHERE post_id = {$checkBoxPostID}";
          $bulkUpdateDelete = mysqli_query($connection,$query);
          querySuccess($bulkUpdateDelete);
          break;
        default:
          break;
      }
    }
  }


?>


<?php include "deleteModal.php" ?>

<form action="" method ="post">
<div id="bulkOptionContainer" class="col-xs-4">

  <select class ="form-control" name="bulkOptions" id="">
    <option value="">Select Option</option>
    <option value="published">Publish</option>
    <option value="draft">Draft</option>
    <option value="clone">Clone</option>
    <option value="delete">Delete</option>
  </select>
</div>

<div class="">
<input onClick="javascript: return confirm('Are you sure you wish to apply this to all selected posts?');" type="submit" name="submit" class="btn btn-success" value="Apply">
<a class="btn btn-primary" href="posts.php?source=add_post"> Add New </a>
</div>


<table class="table table-bordered table-hover">
  <thead>
    <tr>
    <th><input name="selectAllBoxes" id="selectAllBoxes" type="checkbox"></th>
    <th>ID</th>
    <th>Author</th>
    <th>Title</th>
    <th>Category</th>
    <th>Status</th>
    <th>Image</th>
    <th>Tag</th>
    <th>Comments</th>
    <th>Views</th>
    <th>Date</th>
    <th>View Post</th>
    <th>Edit</th>
    <th>Delete</th>

    </tr>
  </thead>
  <tbody>
    <?php

      $query = "SELECT * FROM posts ORDER BY post_id DESC";
      $selectPosts= mysqli_query($connection,$query);

      while($row = mysqli_fetch_assoc($selectPosts)){

        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_category_id = $row['post_category_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        //$post_comment_count = $row['post_comment_count'];
        $post_date = $row['post_date'];
        $post_view_count = $row['post_view_count'];
        echo "<tr>";

          echo "<td><input type='checkbox' class='checkBox' name='checkBoxArray[]' value= '{$post_id}'></td>";
          echo "<td>{$post_id}</td>";


        //  echo "<td>{$post_author}</td>";




          if(isset($post_author) || !empty($post_author)){
            $query = "SELECT * FROM users WHERE user_id = $post_author";
            $selectPostAuthorUsername= mysqli_query($connection,$query);
            while($row = mysqli_fetch_assoc($selectPostAuthorUsername)){
              $post_author = $row['username'];
              echo "<td>{$post_author}</td>";
            } // while
          } else {
            echo "<td>Unknown</td>";
        }





          echo "<td>{$post_title}</td>";


          $query = "SELECT * FROM category WHERE cat_id = $post_category_id";
          $queryEditCategory = mysqli_query($connection,$query);
          while($row = mysqli_fetch_assoc($queryEditCategory)){
            $cat_id =$row['cat_id'];
            $cat_title =$row['cat_title'];
            echo "<td>{$cat_title}</td>";
          }

          echo "<td>{$post_status}</td>";
          echo "<td><img width='100%' src='../images/{$post_image}'alt='{$post_image}'></td>";
          echo "<td>{$post_tags}</td>";

          $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
          $getCommentCount = mysqli_query($connection,$query);
          $countComments = mysqli_num_rows($getCommentCount);
          $post_comment_count = $countComments;

          // $row = mysqli_fetch_array($getCommentCount);
          // $comment_id = $row['comment_id'];

          echo "<td><a href='post_comments.php?p_id=$post_id'>{$post_comment_count}</a></td>";
          echo "<td>{$post_view_count} <br> <a href='posts.php?reset={$post_id}' class='btn btn-danger'>reset</a></td>";
          echo "<td>{$post_date}</td>";

          if($post_status == 'published'){
            echo "<td><a href='../post.php?p_id={$post_id}'>View</a></td>";
          } else {
            echo "<td>Post Unpublished</td>";
          }

          echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
          echo "<td><a rel='$post_id' href='javascript:void(0)' class='delete_modal_trigger'>Delete</a></td>";
          // echo "<td><a onClick=\"javascript: return confirm('Are you sure you wish to delete?'); \" href='posts.php?delete={$post_id}'>Delete</a></td>";
        echo "</tr>";
      }
    ?>
  </tbody>
</table>

</form>

<script>
$(document).ready(function(){

$(".delete_modal_trigger").on('click',function(){

  var id = $(this).attr("rel");
  var delete_url ="posts.php?delete="+ id + "";

$(".modal_delete_button").attr("href",delete_url);
$("#myModal").modal('show');

});

});

</script>
