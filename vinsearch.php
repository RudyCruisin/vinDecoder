<div>
    <h1>Search for VIN Data</h1>

    <form action="" method="post">
        <input class="inputvin" type="text" name="inputvin" placeholder="ENTER VIN NUMBER">
        <button type="submit" name="submit" class="submitButton">SEARCH</button>
    </form>
</div>

<?php

//Clicking the search button runs searchfunction.php which handles API call for VIN input by user.

if (isset($_POST['inputvin'])) {
    require 'includes/searchfunction.php';
}

//Clicking the add to database button inserts data to mysql table.

if (isset($_POST['writeData'])) {
    require 'includes/createdata.php';
}

?>

