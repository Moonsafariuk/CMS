<?php

function querySuccess($result){

    global $connection;
    if(!$result){
      die("Query Failed: ". mysqli_error($connection));
    }
}


function insertCategories() {

global $connection;

if(isset($_POST['submit'])){

  $catTitle = $_POST['catTitle'];

  if($catTitle == "" || empty($catTitle)){
    echo "<h2>Please enter a new Category</h2>";

  } else {

    $query = "INSERT INTO category(cat_title) ";
    $query .= "VALUES('{$catTitle}'); ";

    $queryAddNewCategory = mysqli_query($connection,$query);

      echo "<h2> '{$_POST['catTitle']}' has been added.</h2>";
      echo "<h3> Add another.... </h3> <br>";

    if(!$queryAddNewCategory){

      die("Query Failed" . mysqli_error($connection));
    }
  }
}

}





function findAllCategories(){
  global $connection;

  // Find all and display categories from DB
    $query = "SELECT * FROM category";
    $select_categories = mysqli_query($connection,$query);

    while($row = mysqli_fetch_assoc($select_categories)){

      $cat_id = $row['cat_id'];
      $cat_title = $row['cat_title'];

      echo "<tr>";
      echo "<td>{$cat_id}</td>";
      echo "<td>{$cat_title}</td>";
      echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
      echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
      echo "</tr>";

    }
}

function deleteCategory(){
  global $connection;

  // delete category from DB
  if(isset($_GET['delete'])){

    $cat_id_delete = $_GET['delete'];
    $query = "DELETE FROM category WHERE cat_id = {$cat_id_delete}";
    $queryCategoryDelete = mysqli_query($connection,$query);
    header("Location: categories.php");
  }
}



function usersOnline(){



  if(isset($_GET['usersonline'])){
  global $connection;
    if(!$connection){

      session_start();
      include("../includes/db.php");

      $session = session_id();
      $time = time();
      $time_out_in_seconds = 60;
      $time_out = $time - $time_out_in_seconds;

      $query = "SELECT * FROM users_online WHERE session = '$session'";
      $userQuery = mysqli_query($connection,$query);
      $userCount = mysqli_num_rows($userQuery);

      if($userCount == NULL){
        $query = "INSERT INTO users_online(session , time ) VALUES ('$session' , '$time')";
        $nullUserQuery = mysqli_query($connection,$query);
      } else {
        $query = "UPDATE users_online SET time = '$time' WHERE session = '$session'";
        $updateUserQuery = mysqli_query($connection,$query);
      }

      $query = "SELECT * FROM users_online WHERE time > '$time_out' ";
      $totalUsersOnlineQuery = mysqli_query($connection,$query);

//return echo number
      echo $totalUserOnlineCount = mysqli_num_rows($totalUsersOnlineQuery);

      }

    }// get request isset

}

usersOnline();


 ?>
