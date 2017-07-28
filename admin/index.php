<?php include "includes/adminHeader.php"; ?>

    <div id="wrapper">

<?php include "includes/adminNavigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to the Admin page,
                            <?php echo $_SESSION['username'];?>

                        </h1>
                    </div>
                </div>
                <!-- /.row -->


                         <!-- /.row -->

         <div class="row">
             <div class="col-lg-3 col-md-6">
                 <div class="panel panel-primary">
                     <div class="panel-heading">
                         <div class="row">
                             <div class="col-xs-3">
                                 <i class="fa fa-file-text fa-5x"></i>
                             </div>
                             <div class="col-xs-9 text-right">
                               <?php
                               $query = "SELECT * FROM posts WHERE post_status = 'published'";
                               $livePostCountQuery = mysqli_query($connection,$query);
                               $livePostCount = mysqli_num_rows($livePostCountQuery);
                               echo "<div class='huge'>{$livePostCount}</div>";
                               ?>

                                 <div>Posts</div>
                             </div>
                         </div>
                     </div>
                     <a href="posts.php">
                         <div class="panel-footer">
                             <span class="pull-left">View Details</span>
                             <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                             <div class="clearfix"></div>
                         </div>
                     </a>
                 </div>
             </div>
             <div class="col-lg-3 col-md-6">
                 <div class="panel panel-green">
                     <div class="panel-heading">
                         <div class="row">
                             <div class="col-xs-3">
                                 <i class="fa fa-comments fa-5x"></i>
                             </div>
                             <div class="col-xs-9 text-right">
                               <?php
                               $query = "SELECT * FROM comments WHERE comment_status ='approved'";
                               $approvedCommentCountQuery = mysqli_query($connection,$query);
                               $approvedCommentCount = mysqli_num_rows($approvedCommentCountQuery);
                               echo "<div class='huge'>{$approvedCommentCount}</div>";
                               ?>
                               <div>Comments</div>
                             </div>
                         </div>
                     </div>
                     <a href="comments.php">
                         <div class="panel-footer">
                             <span class="pull-left">View Details</span>
                             <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                             <div class="clearfix"></div>
                         </div>
                     </a>
                 </div>
             </div>
             <div class="col-lg-3 col-md-6">
                 <div class="panel panel-yellow">
                     <div class="panel-heading">
                         <div class="row">
                             <div class="col-xs-3">
                                 <i class="fa fa-user fa-5x"></i>
                             </div>
                             <div class="col-xs-9 text-right">
                               <?php
                               $query = "SELECT * FROM users";
                               $allUserCountQuery = mysqli_query($connection,$query);
                               $allUserCount = mysqli_num_rows($allUserCountQuery);
                               echo "<div class='huge'>{$allUserCount}</div>";
                               ?>
                                 <div> Users</div>
                             </div>
                         </div>
                     </div>
                     <a href="users.php">
                         <div class="panel-footer">
                             <span class="pull-left">View Details</span>
                             <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                             <div class="clearfix"></div>
                         </div>
                     </a>
                 </div>
             </div>
             <div class="col-lg-3 col-md-6">
                 <div class="panel panel-red">
                     <div class="panel-heading">
                         <div class="row">
                             <div class="col-xs-3">
                                 <i class="fa fa-list fa-5x"></i>
                             </div>
                             <div class="col-xs-9 text-right">
                               <?php
                               $query = "SELECT * FROM category";
                               $categoryCountQuery = mysqli_query($connection,$query);
                               $categoryCount = mysqli_num_rows($categoryCountQuery);
                               echo "<div class='huge'>{$categoryCount}</div>";
                               ?>
                                  <div>Categories</div>
                             </div>
                         </div>
                     </div>
                     <a href="categories.php">
                         <div class="panel-footer">
                             <span class="pull-left">View Details</span>
                             <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                             <div class="clearfix"></div>
                         </div>
                     </a>
                 </div>
             </div>
         </div>
                         <!-- /.row -->

<?php

$query = "SELECT * FROM posts WHERE post_status = 'draft'";
$selectDraftPosts = mysqli_query($connection,$query);
$postDraftCount = mysqli_num_rows($selectDraftPosts);

$query = "SELECT * FROM posts WHERE post_status = 'unapproved'";
$selectUnapprovedPosts = mysqli_query($connection,$query);
$UnapprovedPostsCount = mysqli_num_rows($selectUnapprovedPosts);

$query = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
$selectUnapprovedComments = mysqli_query($connection,$query);
$unapprovedCommentCount = mysqli_num_rows($selectUnapprovedComments);



$query = "SELECT * FROM users WHERE access_level = 'subscriber'";
$selectSubscriberUsers = mysqli_query($connection,$query);
$SubscriberUsersCount = mysqli_num_rows($selectSubscriberUsers);

$query = "SELECT * FROM users WHERE access_level = 'admin'";
$adminUserCountQuery = mysqli_query($connection,$query);
$adminUserCount = mysqli_num_rows($adminUserCountQuery);


?>



<div class="row">

  <script type="text/javascript">
       google.charts.load('current', {'packages':['bar']});
       google.charts.setOnLoadCallback(drawChart);

       function drawChart() {
         var data = google.visualization.arrayToDataTable([
           ['Counts', 'Totals'],

           <?php
           $element_text = ['Live Posts'    ,'Unapproved Posts'   ,'Draft Posts'   ,'Approved Comments'    ,'Pending Comments'    , 'Admins'       , 'Subscribers'        ,'Categories'];
           $element_count = [$livePostCount,$UnapprovedPostsCount,$postDraftCount ,$approvedCommentCount , $unapprovedCommentCount , $adminUserCount ,$SubscriberUsersCount ,$categoryCount ];

           if(isset($element_text)){
             $columnCount = count($element_text);
           }

           for($i=0; $i < $columnCount ; $i++){
             echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}]," ;
           }
           ?>

        //   ['Bar1', 1000, 400, 200],
        //   ['Bar2', 1000, 400, 200],
         ]);

         var options = {
          //  chart: {
          //    title: '',
          //    subtitle: '',
          //  }

          title: 'Current Totals',
          hAxis: {title: 'Numbers',
          titleTextStyle: {color: 'black'},
          count: -1,
          viewWindowMode: 'pretty',
          slantedText: true,
          textPosition: 'in'


          },
          legend:{position:'none'},

          vAxis: { title: 'Totals' }


         };

         var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

         chart.draw(data, google.charts.Bar.convertOptions(options));
       }
     </script>

<div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>


</div>





            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include "includes/adminFooter.php";?>
