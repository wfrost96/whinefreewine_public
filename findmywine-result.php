<?php
  // Include config file
  require_once "config.php";

  $sql = "SELECT * FROM wine";

  $name = mysqli_real_escape_string($con, htmlspecialchars($_GET['name']));
  $colour = mysqli_real_escape_string($con, htmlspecialchars($_GET['colour']));
  $grape = mysqli_real_escape_string($con, htmlspecialchars($_GET['grape']));
  $country = mysqli_real_escape_string($con, htmlspecialchars($_GET['country']));
  $price = mysqli_real_escape_string($con, htmlspecialchars($_GET['price']));

  /* 1. NSGRCV */
    if( $_GET['colour'] AND $_GET['grape'] AND $_GET['name'] AND $_GET['country'] AND $_GET['price'])
      {
        $sql = "SELECT * FROM wine WHERE colour = '$colour' AND grape ='$grape' AND name = '$name' AND country = '$country' AND price = '$price'";
      }

    /* 2. NSGRC!V = NSGRC */
    if( $_GET['colour'] AND $_GET['grape'] AND $_GET['name'] AND $_GET['country'] AND !$_GET['price'])
      {
        $sql = "SELECT * FROM wine WHERE colour = '$colour' and grape ='$grape' AND name = '$name' AND country = '$country'";
      }

    /* 3. NSGR!CV = NSGRV */
    if( $_GET['colour'] AND $_GET['grape'] AND $_GET['name'] AND !$_GET['country'] AND $_GET['price'])
      {
        $sql = "SELECT * FROM wine WHERE colour = '$colour' AND grape ='$grape' AND name = '$name' AND price = '$price'";
      }

    /* 4. NSGR!C!V = NSGR */
    if( $_GET['colour'] AND $_GET['grape'] AND $_GET['name'] AND !$_GET['country'] AND !$_GET['price'])
      {
        $sql = "SELECT * FROM wine WHERE colour = '$colour' AND grape ='$grape' AND name = '$name'";
      }

    /* 5. NSG!RCV = NSGCV */
    if( $_GET['colour'] AND $_GET['grape'] AND !$_GET['name'] AND $_GET['country'] AND $_GET['price'])
      {
        $sql = "SELECT * FROM wine WHERE colour = '$colour' AND grape ='$grape' AND country = '$country' AND price = '$price'";
      }

    /* 6. NSG!RC!V = NSGC */
    if( $_GET['colour'] AND $_GET['grape'] AND !$_GET['name'] AND $_GET['country'] AND !$_GET['price'])
      {
        $sql = "SELECT * FROM wine WHERE colour = '$colour' AND grape ='$grape' AND country = '$country'";
      }

    /* 7. NSG!R!CV = NSGV */
    if( $_GET['colour'] AND $_GET['grape'] AND !$_GET['name'] AND !$_GET['country'] AND $_GET['price'])
      {
        $sql = "SELECT * FROM wine WHERE colour = '$colour' AND grape ='$grape' AND price = '$price'";
      }

    /* 8. NSG!R!C!V = NSG */
    if( $_GET['colour'] AND $_GET['grape'] AND !$_GET['name'] AND !$_GET['country'] AND !$_GET['price'])
      {
        $sql = "SELECT * FROM wine WHERE colour = '$colour' AND grape ='$grape'";
      }

    /* NS!G */

    /* 9. NS!GRCV = NSRCV */
    if( $_GET['colour'] AND !$_GET['grape'] AND $_GET['name'] AND $_GET['country'] AND $_GET['price'])
      {
        $sql = "SELECT * FROM wine WHERE colour = '$colour' AND name = '$name' AND country = '$country' AND price = '$price'";
      }

    /* 10. NS!GRC!V = NSRC */
    if( $_GET['colour'] AND !$_GET['grape'] AND $_GET['name'] AND $_GET['country'] AND !$_GET['price'])
      {
        $sql = "SELECT * FROM wine WHERE colour = '$colour' AND name = '$name' AND country = '$country'";
      }

    /* 11. NS!GR!CV = NSRV */
    if( $_GET['colour'] AND !$_GET['grape'] AND $_GET['name'] AND !$_GET['country'] AND $_GET['price'])
      {
        $sql = "SELECT * FROM wine WHERE colour = '$colour' AND name = '$name' AND price = '$price'";
      }

    /* 12. NS!GR!C!V = NSR */
    if( $_GET['colour'] AND !$_GET['grape'] AND $_GET['name'] AND !$_GET['country'] AND !$_GET['price'])
      {
        $sql = "SELECT * FROM wine WHERE colour = '$colour' AND name = '$name'";
      }

    /* 13. NS!G!RCV = NSCV */
    if( $_GET['colour'] AND !$_GET['grape'] AND !$_GET['name'] AND $_GET['country'] AND $_GET['price'])
      {
        $sql = "SELECT * FROM wine WHERE colour = '$colour' AND country = '$country' AND price = '$price'";
      }

    /* 14. NS!G!RC!V = NSC */
    if( $_GET['colour'] AND !$_GET['grape'] AND !$_GET['name'] AND $_GET['country'] AND !$_GET['price'])
      {
        $sql = "SELECT * FROM wine WHERE colour = '$colour' AND country = '$country'";
      }

    /* 15. NS!G!R!CV = NSV */
    if( $_GET['colour'] AND !$_GET['grape'] AND !$_GET['name'] AND !$_GET['country'] AND $_GET['price'])
      {
        $sql = "SELECT * FROM wine WHERE colour = '$colour' AND price = '$price'";
      }

    /* 16. NS!G!R!C!V = NS */
    if( $_GET['colour'] AND !$_GET['grape'] AND !$_GET['name'] AND !$_GET['country'] AND !$_GET['price'])
      {
        $sql = "SELECT * FROM wine WHERE colour = '$colour'";
      }

      /* N!SG */

      /* 17. N!SGRCV = NGRCV */
      if( !$_GET['colour'] AND $_GET['grape'] AND $_GET['name'] AND $_GET['country'] AND $_GET['price'])
        {
          $sql = "SELECT * FROM wine WHERE grape ='$grape' AND name = '$name' AND country = '$country' AND price = '$price'";
        }

      /* 18. N!SGRC!V = NGRC */
      if( !$_GET['colour'] AND $_GET['grape'] AND $_GET['name'] AND $_GET['country'] AND !$_GET['price'])
        {
          $sql = "SELECT * FROM wine WHERE grape ='$grape' AND name = '$name' AND country = '$country'";
        }

      /* 19. N!SGR!CV = NGRV */
      if( !$_GET['colour'] AND $_GET['grape'] AND $_GET['name'] AND !$_GET['country'] AND $_GET['price'])
        {
          $sql = "SELECT * FROM wine WHERE grape ='$grape' AND name = '$name' AND price = '$price'";
        }

      /* 20. N!SGR!C!V = NGR */
      if( !$_GET['colour'] AND $_GET['grape'] AND $_GET['name'] AND !$_GET['country'] AND !$_GET['price'])
        {
          $sql = "SELECT * FROM wine WHERE grape ='$grape' AND name = '$name'";
        }

      /* 21. N!SG!RCV = NGCV */
      if( !$_GET['colour'] AND $_GET['grape'] AND !$_GET['name'] AND $_GET['country'] AND $_GET['price'])
        {
          $sql = "SELECT * FROM wine WHERE grape ='$grape' AND country = '$country' AND price = '$price'";
        }

      /* 22. N!SG!RC!V = NGC */
      if( !$_GET['colour'] AND $_GET['grape'] AND !$_GET['name'] AND $_GET['country'] AND !$_GET['price'])
        {
          $sql = "SELECT * FROM wine WHERE grape ='$grape' AND country = '$country'";
        }

      /* 23. N!SG!R!CV = NGV */
      if( !$_GET['colour'] AND $_GET['grape'] AND !$_GET['name'] AND !$_GET['country'] AND $_GET['price'])
        {
          $sql = "SELECT * FROM wine WHERE grape ='$grape' AND price = '$price'";
        }

      /* 24. N!SG!R!C!V = NG */
      if( !$_GET['colour'] AND $_GET['grape'] AND !$_GET['name'] AND !$_GET['country'] AND !$_GET['price'])
        {
          $sql = "SELECT * FROM wine WHERE grape ='$grape'";
        }

      /* N!S!G */

      /* 25. N!S!GRCV = NRCV */
      if( !$_GET['colour'] AND !$_GET['grape'] AND $_GET['name'] AND $_GET['country'] AND $_GET['price'])
        {
          $sql = "SELECT * FROM wine WHERE name = '$name' AND country = '$country' AND price = '$price'";
        }

      /* 26. N!S!GRC!V = NRC */
      if( !$_GET['colour'] AND !$_GET['grape'] AND $_GET['name'] AND $_GET['country'] AND !$_GET['price'])
        {
          $sql = "SELECT * FROM wine WHERE name = '$name' AND country = '$country'";
        }

      /* 27. N!S!GR!CV = NRV */
      if( !$_GET['colour'] AND !$_GET['grape'] AND $_GET['name'] AND !$_GET['country'] AND $_GET['price'])
        {
          $sql = "SELECT * FROM wine WHERE name = '$name' AND price = '$price'";
        }

      /* 28. N!S!GR!C!V = NR */
      if( !$_GET['colour'] AND !$_GET['grape'] AND $_GET['name'] AND !$_GET['country'] AND !$_GET['price'])
        {
          $sql = "SELECT * FROM wine WHERE name = '$name'";
        }

      /* 29. N!S!G!RCV = NCV */
      if( !$_GET['colour'] AND !$_GET['grape'] AND !$_GET['name'] AND $_GET['country'] AND $_GET['price'])
        {
          $sql = "SELECT * FROM wine WHERE country = '$country' AND price = '$price'";
        }

      /* 30. N!S!G!RC!V = NC */
      if( !$_GET['colour'] AND !$_GET['grape'] AND !$_GET['name'] AND $_GET['country'] AND !$_GET['price'])
        {
          $sql = "SELECT * FROM wine WHERE country = '$country'";
        }

      /* 31. N!S!G!R!CV */
      if( !$_GET['colour'] AND !$_GET['grape'] AND !$_GET['name'] AND !$_GET['country'] AND $_GET['price'])
        {
          $sql = "SELECT * FROM wine WHERE price = '$price'";
        }

      /* 32. N!S!G!R!C!V = N */
      if( !$_GET['colour'] AND !$_GET['grape'] AND !$_GET['name'] AND !$_GET['country'] AND !$_GET['price'])
        {
          $sql = "SELECT * FROM wine";
        }


    $result = $con->query($sql);



?>

<html>

  <head>
    <title>Whine Free Wine | Find My Wine</title>
    <link rel="stylesheet" type="text/css" href="findmywine.css"/>

    <?php include "./template_top.php"?>

    <!--start of JavaScript for sorting results table-->
    <!--<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>-->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="./jquery.tablesorter.js"></script>

    <script>
        $(function(){
          $("#results_table").tablesorter();
        });
    </script>
    <!--end of JavaScript for sorting results table-->

  </head>
  <body>
    <div class="container">
      <section class="content">

        <h1>Results</h1>

        <h3>You searched for:
          <?php
            if($name != ""){
              echo $name . " ";
            }
            elseif($colour != ""){
              echo $colour . " ";
            }
            elseif($grape != ""){
              echo $grape . " ";
            }
            elseif($country != ""){
              echo $country . " ";
            }
            elseif($price != ""){
              echo $price . " ";
            }
            else{
              echo "<i>No search terms entered.</i>";
            }
          ?>
        </h3>

        <h3><a href="index.php">Search again</a></h3>

        <!--<h2>List of wine</h2>-->
        <table id="results_table">
          <thead>
            <tr>
              <th>Volume</th>
              <th>Colour</th>
              <th>Grape</th>
              <th>Country</th>
              <th>Price (£)</th>
              <th>Description</th>
            </tr>
          <thead>

          <tbody>
          <?php
          while($row = $result->fetch_assoc()){
              ?>
              <tr>
                <td><?php echo htmlspecialchars($row['volume']); ?></td>
                <td><?php echo htmlspecialchars($row['colour']); ?></td>
                <td><?php echo htmlspecialchars($row['grape']); ?></td>
                <td><?php echo htmlspecialchars($row['country']); ?></td>
                <td><?php echo htmlspecialchars($row['price']); ?></td>
                <td id="description"><?php echo htmlspecialchars($row['description']); ?></td>
              </tr>
              <?php
          }
          ?>
          </tbody>

        </table>

      <br><br>
      <div class="buttons">
        <a href="./index.php" class="findmywine_submit_button">Search again</a>
      </div>

    <?php include "../../template_bottom.php"?>
