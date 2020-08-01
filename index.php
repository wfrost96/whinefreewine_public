<html>

  <head>
    <title>Whine Free Wine</title>

    <!--specific style sheet for the portfolio example-->
    <link rel="stylesheet" type="text/css" href="findmywine.css"/>

    <?php include "./template_top.php"?>

    <h1>Welcome to Whine Free Wine!</h1>
    <h2>Find your favourite wines across the UK's best restaurants and bars.</h2>

      <form action="findmywine-result.php" method="GET">
        <table align="center">

          <tr>
              <td><label for="inpStyle" class="findmywine_input_box_label">Name:</label></td>
              <td>
                <input type="text" id="inpStyle" list="name" name="name" placeholder="e.g., Bread & Butter Chardonnay" class="findmywine_input_box" autocomplete="off" maxlength="30">
                <datalist id="name">
                  <?php include "./findmywine-style.html" ?>
                </datalist>
              </td>
          </tr>

          <tr>
              <td><label for="inpStyle" class="findmywine_input_box_label">Colour:</label></td>
              <td>
                <input type="text" id="inpStyle" list="colour" name="colour" placeholder="e.g., red" class="findmywine_input_box" autocomplete="off" maxlength="30">
                <datalist id="style">
                  <?php include "./findmywine-style.html" ?>
                </datalist>
              </td>
          </tr>

          <tr>
              <td><label for="inpGrape" class="findmywine_input_box_label">Grape:</label></td>
              <td>
                <input type="text" id="inpGrape" list="grape" name="grape" placeholder="e.g., Cabernet Sauvignon/Merlot" class="findmywine_input_box" autocomplete="off" maxlength="30">
                <datalist id="grape">
                  <?php include "./findmywine-grapes.html" ?>
                </datalist>
              </td>
          </tr>

          <tr>
              <td><label for="country" class="findmywine_input_box_label">Country:</label></td>
              <td>
                <input type="text" id="inpCountry" list="country" name="country" placeholder="e.g., France" class="findmywine_input_box" autocomplete="off" maxlength="20">
                <datalist id="country">
                  <?php include "./findmywine-country.html" ?>
                </datalist>
              </td>
          </tr>

          <tr>
            <td><label for="price" class="findmywine_input_box_label">Max price:</label></td>
            <td><input type="text" name="price" id="price" placeholder="e.g., 14" class="findmywine_input_box" autocomplete="off" maxlength="4"></td>
          </tr>
        </table>

        <br>
        <div class="buttons">
          <input type="submit" value="Find" class="findmywine_submit_button">
        </div>

    </form>

    <?php include "../../template_bottom.php"?>
