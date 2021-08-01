<div>
    <h1>Search for VIN Data</h1>

    <form action="" method="post">
        <input type="text" name="inputvin" placeholder="VIN NUMBER">
        <button type="submit" name="submit">SEARCH</button>
    </form>
</div>

<?php

if (isset($_POST['inputvin'])) {
    require 'includes/searchfunction.php';
}

if (isset($_POST['writeData'])) {
    require 'includes/createdata.php';
}

?>

