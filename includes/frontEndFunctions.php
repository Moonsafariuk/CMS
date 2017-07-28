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


function getBrowser()
{
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }

    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
    {
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    }
    elseif(preg_match('/Firefox/i',$u_agent))
    {
        $bname = 'Mozilla Firefox';
        $ub = "Firefox";
    }
    elseif(preg_match('/Chrome/i',$u_agent))
    {
        $bname = 'Google Chrome';
        $ub = "Chrome";
    }
    elseif(preg_match('/Safari/i',$u_agent))
    {
        $bname = 'Apple Safari';
        $ub = "Safari";
    }
    elseif(preg_match('/Opera/i',$u_agent))
    {
        $bname = 'Opera';
        $ub = "Opera";
    }
    elseif(preg_match('/Netscape/i',$u_agent))
    {
        $bname = 'Netscape';
        $ub = "Netscape";
    }

    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }

    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }
        else {
            $version= $matches['version'][1];
        }
    }
    else {
        $version= $matches['version'][0];
    }

    // check if we have a number
    if ($version==null || $version=="") {$version="?";}

    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'    => $pattern
    );
}



function escape($string){
  global $connection;
  mysqli_real_escape_string($connection, trim($string));
  return $string;
}


 ?>
