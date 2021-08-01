<?php
require_once 'includes/header.php';
?>

<div>

    <h2>VIN DATA</h2>
    <?php
    require_once 'includes/searchfunction.php';
    ?>

    <div class="buttons">
        <form action="includes/createdata.php" method="post">
            <button type="submit" name="writeData">Add to Database</button>
        </form>

        <form action="index.php" method="post">
            <button type="submit" name="return">Search Again</button>
        </form>
    </div>
</div>

<?php
require_once 'includes/footer.php';
?>