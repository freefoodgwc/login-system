<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
     <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<header>
    <nav>
      <div class= "main-wrapper">
          <ul>
              <li><a href="index.php">Home</a></li>
          </ul>
          <div class="nav-login">
            <?php
                if (isset($_SESSION['u_id'])) {
                  echo '<form action="includes/logout.inc.php" method="POST">
                     <button type="text" name="submit">Logout</button>
                  </form>'
                } else{
                  echo '<form action="includes/logout.inc.php" method="POST">
                      <button type="text" name="submit">Logout</button>
                   </form>
                  <form action="includes/login.onc.php" method="POST">
                      <input type="text" name="uid" placeholder="Username/e-mail">
                      <input type="password" name="pwd" placeholder="password">
                      <button type="submit" name="submit">Login In</button>
                  </form>
                  <a href="signup.php">Sign up</a>'
                }
             ?>
          </div>
      </div>
    </nav>
</header>
