
<?php include "includes/adminHeader.php"; ?>

    <div id="wrapper">

<?php include "includes/adminNavigation.php"; ?>

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

                          case '34';
                            echo "nice 34";
                          break;

                          default:
                            include "includes/viewAllPosts.php";
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

<?php include "includes/adminFooter.php";?>
