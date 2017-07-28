<?php include "includes/header.php"; ?>

    <!-- Navigation -->
    <?php include "includes/navbartop.php";?>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-8">
              <?php

              // sets max post per page.
              $per_page = 5;

              if(isset($_GET['page'])){

                $page = $_GET['page'];

              } else {

                $page = "";

              }


              if($page == "" || $page == 1){

                $page_1 = 0;

              } else {

                $page_1 = ($page * $per_page ) - $per_page;

              }


                $countPosts = "SELECT * FROM posts WHERE post_status = 'published' ORDER BY post_id DESC";
                $countPostsQuery = mysqli_query($connection,$countPosts);
                $totalPostCount = mysqli_num_rows($countPostsQuery);

                $totalPostCount = ceil($totalPostCount / $per_page) ;

                $query = "SELECT * FROM posts LIMIT $page_1 , $per_page";
                $queryAllPosts = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($queryAllPosts)){
                  $post_id = $row['post_id'];
                  $post_title = $row['post_title'];
                  $post_author = $row['post_author'];
                  $post_date = $row['post_date'];
                  $post_image = $row['post_image'];
                  $post_content = substr($row['post_content'],0,200)."...";
                  $post_status =$row['post_status'];

                    //get post author username from users table.
                      $query = "SELECT * FROM users WHERE user_id = $post_author ";
                      $selectAuthors = mysqli_query($connection,$query);
                      //querySuccess($selectAuthors);
                      while($row = mysqli_fetch_assoc($selectAuthors )) {
                      $post_author_id = $row['user_id'];
                      $post_author = $row['username'];
                      }



               if($post_status == 'published'){
                  //   echo "<h1 class='text-center'>Nothing To See Here.... </h1>";
                  // } else {
                ?>

                <!-- Blog Posts -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="authors_posts.php?author=<?php echo $post_author ?>"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id ?>"><img class="img-responsive" src="images/<?php echo $post_image ?>" alt=""></a>
                <hr>
                <p> <?php echo $post_content ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>">Full Post<span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

              <?php
                } // end of else
                } //end of content while loop
              ?>

            </div> <!-- cm -->

            <?php include "includes/navbarside.php"; ?>

</div>
<!-- row -->
<div class="row">
<div class="col-md-8">
<?php //echo $totalPostCount; ?>
            <ul class ="pager">

              <?php

              for($i = 1 ; $i <= $totalPostCount ; $i++){

                 if($i == $page){
                   echo "<li ><a class='active_link' href='index.php?page={$i}'>$i</a></li>";
                 } else {
                  echo "<li><a href='index.php?page={$i}'>$i</a></li>";
                 }

              }

               ?>

            </ul>
          </div>
</div>
   </div>
            <!-- /.container -->

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/footer.php"; ?>
