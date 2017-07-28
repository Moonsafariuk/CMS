<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="./index.php">Pro Code Tips</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

              <?php

                $query = "SELECT * FROM category";
                $querySelectAllCategories = mysqli_query($connection,$query);

                while ($row = mysqli_fetch_assoc($querySelectAllCategories)){

                   $cat_title = $row['cat_title'];

                   echo "<li><a href=\"#\">{$cat_title}</a></li>";

                }


              ?>

                  <?php

                  if(isset($_SESSION['user_access_level'])){
                    if($_SESSION['user_access_level'] == 'admin'){
                      echo "<li><a href='admin'>Admin</a></li>";
                      echo "<li><a href='contact.php'>Contact</a></li>";
                      if($_GET['p_id']){
                        $postToEdit = $_GET['p_id'];
                        echo "<li><a href='admin/posts.php?source=edit_post&p_id={$postToEdit}'>Edit Post</a></li>";
                      }
                    } else if ($_SESSION['user_access_level'] == 'subscriber'){

                      echo "<li><a href='#'>Create New Post</a></li>";
                      echo "<li><a href='#'>Profile</a></li>";
                      echo "<li><a href='contact.php'>Contact</a></li>";
                    }


                  } else {

                    echo "<li><a href='registration.php'>Create Account</a></li>";
                    echo "<li><a href='contact.php'>Contact</a></li>";


                  } // ISSET access level session check


                  ?>



            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
