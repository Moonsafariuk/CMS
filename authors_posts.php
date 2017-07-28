
<?php include "includes/header.php"; ?>

    <!-- Navigation -->
    <?php include "includes/navbartop.php";?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

              <?php
              if(isset($_GET['author'])){
              //  $post_id = $_GET['p_id'];
                $author_username = $_GET['author'];
              }

                //get ID
                $query = "SELECT * FROM users WHERE username = '{$author_username}'";
                $queryGetUserID= mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($queryGetUserID)){
                $author_id = $row['user_id'];
                }

                //use id to get posts
                $query = "SELECT * FROM posts WHERE post_author = $author_id";
                $queryAllAuthorPosts = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($queryAllAuthorPosts)){
                  $post_id = $row['post_id'];
                  $post_title = $row['post_title'];
                //  $post_author = $row['post_author'];
                  $post_date = $row['post_date'];
                  $post_image = $row['post_image'];
                  $post_content = $row['post_content'];


                ?>

                <h1 class="page-header">
                    All articles by:
                    <small><?php echo $author_username ?></small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <?php echo $post_title ?>
                </h2>
                <p class="lead">
                    by <?php echo $author_username ?>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id ?>"><img class="img-responsive" src="images/<?php echo $post_image ?>" alt=""></a>
                <!-- <img class="img-responsive" src="images/<?php // echo $post_image ?>" alt=""> -->
                <hr>
                <p> <?php echo $post_content ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>">Full Post<span class="glyphicon glyphicon-chevron-right"></span></a>
                <!-- <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a> -->

                <hr>

              <?php
                } //end of content while loop
                  ?>




            </div>

            <!-- Blog Sidebar Widgets Column -->

            <?php include "includes/navbarside.php"; ?>


            <?php include "includes/footer.php"; ?>
