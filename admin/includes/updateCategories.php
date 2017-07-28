

                          <form action="" method="post">
                            <div class="form-group">
                              <label for="catTitle">Edit Category </label>

                              <?php

                              if(isset($_GET['edit'])){

                                $cat_id = $_GET['edit'];
                                $query = "SELECT * FROM category WHERE cat_id = $cat_id";
                                $queryEditCategory = mysqli_query($connection,$query);

                                while($row = mysqli_fetch_assoc($queryEditCategory)){

                                  $cat_id =$row['cat_id'];
                                  $cat_title =$row['cat_title'];

                                  ?>

                                  <input class="form-control" type="text" name="catTitle" value="<?php if(isset($cat_title)){echo $cat_title;} ?>">


                            <?php } }?>

                            <?php
                            // update category query
                            if(isset($_POST['updateCategory'])){
                                $cat_title_new = $_POST['catTitle'];
                                $query = "UPDATE category SET cat_title = '{$cat_title_new}' WHERE cat_id = {$cat_id_edit}";
                                $queryUpdate = mysqli_query($connection,$query);

                                if(!$queryUpdate){
                                  die("Query Failed ". mysqli_error($connection));
                                }

                            }
                             ?>

                            </div>
                            <div class="form-group">
                              <input class="btn btn-primary" type="submit" name="updateCategory" value="Update">
                            </div>
                          </form>
