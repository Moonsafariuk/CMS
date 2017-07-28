
<div class="col-md-4">
    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
        <div class="input-group">
            <input name="search" type="text" class="form-control">
            <span class="input-group-btn">
                <button name="submit" class="btn btn-default" type="submit">
                    <span class="glyphicon glyphicon-search"></span>
            </button>
            </span>
        </div>
      </form> <!--from search -->
    </div>



    <!-- Login Well -->
    <div class="well">
      <?php
      if(isset($_SESSION['user_access_level'])){
          //$ipaddress = $_SERVER["REMOTE_ADDR"];
        //  $_SESSION['username']
        $browser = getBrowser();
        $browser = $browser['name'];


        if($_SESSION['user_access_level'] == 'admin'){
          echo "Welcome back <strong>". $_SESSION['username']."</strong><br>";
          echo "Your IP is: ". $_SERVER["REMOTE_ADDR"]."<br>";
          echo "Your browser is: ". $browser ."<br>";
          echo "Your resolution is: <div id='resolution'></div>";
          include "checkCookie.php";
          echo "<br>";
          echo "<a href='includes/logout.php'><i class='fa fa-fw fa-power-off'></i> Log Out</a>";
        } else if ($_SESSION['user_access_level'] == 'subscriber'){
          echo "Logged in as subscriber";
        }
      } else {

        echo  "<h4>Login</h4>
          <form action='includes/login.php' method='post'>
            <div class='form-group'>
              <input name='username' type='text' class='form-control' placeholder='Username'>
            </div>
            <div class='input-group'>
              <input name='password' type='password' class='form-control' placeholder='Password'>
              <span class='input-group-btn'>
                <button class='btn btn-primary' name='login' type='submit'>Submit</button>
              </span>
            </div>
          </form>";

      } // ISSET access level session check

      ?>

    </div>

    <!-- Blog Categories Well -->
    <div class="well">

      <?php

        $query = "SELECT * FROM category LIMIT 4";
        $queryCategoriesSideBar = mysqli_query($connection,$query);
      ?>



        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                  <?php
                  while ($row = mysqli_fetch_assoc($queryCategoriesSideBar)){

                     $cat_title = $row['cat_title'];
                     $cat_id = $row['cat_id'];

                     echo "<li><a href=\"category.php?category=$cat_id\">{$cat_title}</a></li>";

                  }
                  ?>
                </ul>
            </div>

            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->

    <?php // include "includes/widget.php" ?>


</div>
