<?php include('includes/header.php'); ?>
    <section>
        <form action="actions.php" method="post">
            <label>Name</label>
            <input type="text" name="routeName">
            <label>Distance</label>
            <input type="test" name="routeDistance">
            <label>Google Map</label>
            <textarea name="routeGoogleMap"></textarea>
            <label>Description</label>
            <textarea name="routeDescription"></textarea>
            <input type="submit" name="routeSubmit" value="Add Route">
        </form>
        <form action="actions.php" method="post">
            <label>Name</label>
            <input type="text" name="runName">
            <label>Route</label>
            <select name="routeID">
                <option>choose</option>
                <?php getRoutes($dbCon); ?>
            </select>
            <label>Date</label>
            <select name="addRunDay">
                <option>Day</option>
                <?php dropDownDate("addRunDay"); ?>
            </select>
            <select name="addRunMonth">
                <option>Month</option>
                <?php dropDownDate("addRunMonth"); ?>
            </select>
            <select name="addRunYear">
                <option>Year</option>
                <?php dropDownDate("addRunYear"); ?>
            </select>
            <label>Price</label>
            <input type="text" name="runPrice">
            <label>Description</label>
            <textarea name="runDescription"></textarea>
            <input type="submit" name="runSubmit" value="Add Run">
        </form>
    </section>
<?php include('includes/footer.php'); ?>