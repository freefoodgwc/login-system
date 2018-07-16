 <?php

if (isset($_POST['submit'])){

  include_once 'dbh.inc.php';

  $first = mysqli_real_escape_string($conn,$_POST['first']);
  $last = mysqli_real_escape_string($conn,$_POST['last']);
  $email = mysqli_real_escape_string($conn,$_POST['email']);
  $uid = mysqli_real_escape_string($conn,$_POST['uid']);
  $pwd = mysqli_real_escape_string($conn,$_POST['pwd']);

  //Error handlers
  //In case the user does not fill everthing out
  if (empty($first) ||empty($last) || empty($email) || empty($uid) || empty ($pwd)){
    header("Location: ../signup.php?signup=empty");
    exit();
  }else {
    //Checks if input characters are correct
    if (!preg_match("/^[a-zA-Z]*$/", $first) ||!preg_match("/^[a-zA-Z]*$", $last)) {
      header("Location: ../signup.php?signup=invailid");
      exit();
    }else {
      //checks if the user email is valid
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location: ../signup.php?signup=email");
        exit();
      }else {
        $spl = "SELECT * FROM user WHERE user_uid='$uid'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);

        if ($resultCheck > 0){
            header("Location: ../signup.php?signup=usertaken");
            exit();
        } else {
            //Makes the password sercure from everyone
            $hashedPwd = password_hask($pwd, PASWORD_DEFAULT);
            //Inserts the user into the database
            $sql = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pwd) VALUES ('$first', '$last', '$email', '$uid', '$hasedPwd');";
            $result =mysqli_query($conn, $sql);
            header("Location: ../signup.php?signup=success");
            exit();
        }
      }
    }
  }

} else{
  header("Location: ../signup.php");
  exit();
}
