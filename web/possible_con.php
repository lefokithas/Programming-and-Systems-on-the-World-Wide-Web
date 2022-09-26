<?php
  include_once 'cus_header.php';

  if ($_SESSION["useruid"] === NULL) {
    header("location: ../index.php?error=nologin");
    exit();
  }

  $username = $_SESSION["useruid"];
  include 'includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8">
     <link rel="stylesheet" type="text/css" href="style8.css">
     <script type="text/javascript">


</script>
</head>
<body>
<header></header>
<table border="1" cellspacing="0" cellpadding="0">
     <tr class="heading">
       <th>No.</th>
          <th>Poi</th>
          <th>Date</th>
          <th>Time</th>
          <th>P.Connection</th>
     </tr>
     <?php

     ?>
</table>
</body>
</html>

<?php
  include_once 'footer.php';
?>
