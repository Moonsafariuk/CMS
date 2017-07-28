<?php session_start(); ?>
<?php include "includes/db.php";?>
<?php include "includes/header.php"; ?>


    <div id="wrapper">
      <!-- Navigation -->
      <?php include "includes/navbartop.php";?>

        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                      <h1 class="page-header">
                          Posts
                          <small></small>
                      </h1>

                      <?php

                        if(isset($_GET['source'])){
                          $source =$_GET['source'];
                        } else {
                          $source ='';
                        }

                        switch($source){

                          case 'add_post';
                            include "includes/addPost.php";
                          break;

                          case 'edit_post';
                            include "includes/editPost.php";
                          break;

                          // case '34';
                          //   echo "nice 34";
                          // break;

                          default:
                            include "includes/managePosts.php";//"includes/viewAllPosts.php";
                          break;
                        }



                      ?>





                    </div>
                </div>
                <!-- /.row -->

              </div>
            <!-- /.container-fluid -->

          </div>
          <!-- /#page-wrapper -->

        </div>
          <!-- /#wrapper -->





            <!-- Blog Sidebar Widgets Column -->

            <?php include "includes/navbarside.php"; ?>


            <?php include "includes/footer.php"; ?>
