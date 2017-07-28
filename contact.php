
<?php

if(isset($_POST['submit'])){
  if(!empty($_POST['subject']) && !empty($_POST['message']) && !empty($_POST['message'])){
  //if all boxes are filled.
    unset($contactAttemptMessage);
    $to = "alexanderchapman0@gmail.com";
    $subject = "Message from CMS contact form - subject: ".$_POST['subject'];
    $message = "Message from CMS contact form: ".$_POST['message'];
    // use wordwrap() if lines are longer than 70 characters
    $message = wordwrap($message,70);
    $from = $_POST['email'];
    $headers = "From:" . $from;
    mail($to,$subject,$message,$headers);
    $contactAttemptMessage = "<br>Message Sent<br>";
  } else {
      $contactAttemptMessage = "Please Fill In All Fields";
  }
}
?>


<?php include "includes/contactHeader.php"; ?>

    <!-- Navigation -->
    <?php include "includes/navbartop.php";?>


    <!-- Page message -->
    <div class="container">

<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact</h1>

                <?php if(isset($contactAttemptMessage) && !empty($contactAttemptMessage))
                  echo "<h4 class='text-center'>{$contactAttemptMessage}</h4>";
                  unset($contactAttemptMessage);
                ?>
                    <form role="form" action="" method="post" id="contact-form" autocomplete="off">

                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="yourname@emailworld.com">
                        </div>

                        <div class="form-group">
                            <label for="subject" class="sr-only">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="What are you contacting us about?">
                        </div>
                         <div class="form-group">
                            <textarea class="form-control" name="message" id="message" cols="50" rows="10"></textarea>
                        </div>

                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                    </form>

                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>

<?php include "includes/footer.php";?>
