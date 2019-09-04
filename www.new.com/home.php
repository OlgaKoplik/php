<?php
session_start();
if(!isset($_SESSION['user_id'])){
    require('login_tools');
    load();
}
$page_title='Home';
include('includes/header.html');
echo "<h1>Our Products</h1>
<p>You log in as, {$_SESSION['first_name']} {$_SESSION['last_name']}</p>"; ?>
<form name="form" method="post" action="home.php">
		<ul class="list">
					<li><label for="filter_01">Price from:<br/> </label><input id="filter_01"  name="price_start" type="number" min="1" max="29" required></li>
					<li><label for="filter_02">to:<br/> </label><input id="filter_02"  name="price_end" type="number" min="1" max="100" required></li>		
        </ul>
        <p>
		<input type="submit" name="filter" value="Apply" /><a href="home.php" class="clear">Clear</a>
</p>
</form>
<?php
require('../connect_db.php');
$q = "SELECT * FROM shop";
$r = mysqli_query($dbc, $q);
if(!empty($_POST["filter"])){
    $price_start = $_POST["price_start"];
    $price_end = $_POST["price_end"];
    require('../connect_db.php');
    $q = 'SELECT * FROM shop where item_price >='.$price_start.' and item_price <='.$price_end;
    $r = mysqli_query($dbc, $q);
    if(mysqli_num_rows($r)>0){
        echo '<table><tr>';
        while($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){
            echo '<td><strong>'.$row['item_name'].
            '</strong><br/>'.$row['item_desc'].
            '<br/><img src='.$row['item_img'].
            '><br/>$'.$row['item_price'].
            '<br/><a href="added.php?id='.$row['item_id'].
            '">add to card</a></td>';
        }
        echo '</tr></table>';
        mysqli_close($dbc);
    }else{
        echo '<p>No items</p>';
    }

}else{
    if(mysqli_num_rows($r)>0){
        echo '<table><tr>';
        while($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){
            echo '<td><strong>'.$row['item_name'].
            '</strong><br/>'.$row['item_desc'].
            '<br/><img src='.$row['item_img'].
            '><br/>$'.$row['item_price'].
            '<br/><a href="added.php?id='.$row['item_id'].
            '">add to card</a></td>';
        }
        echo '</tr></table>';
        mysqli_close($dbc);
    }else{
        echo '<p>No items</p>';
    }
}
echo '<p><a href="cart.php">Card</a> |
<a href="goodbye.php">Sign out</a></p>' ;
?>