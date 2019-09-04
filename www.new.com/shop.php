
<?php
session_start();
if(!isset($_SESSION['user_id'])){
    require('login_tools.php');
    load();
}
$page_title = 'Магазин';
include('includes/header.html');?>
<form name="form" method="post" action="shop.php">
		<ul>
					<li><label for="filter_01">Название: </label><input id="filter_01"  name="price_start" type="text" ></li>
					
		</ul>
		<input type="submit" name="filter" value="Подобрать" /><a href="shop.php">Обнулить</a>
</form>
<?php
require('../connect_db.php');
$q = "SELECT * FROM shop";
$r = mysqli_query($dbc, $q);
if(!empty($_POST["filter"])){
    $price_start = $_POST["price_start"];
 
    $q = 'SELECT * FROM shop where item_name ="'.$price_start.'"';
    $r = mysqli_query($dbc, $q);
    if(mysqli_num_rows($r)>0){
        echo '<table><tr>';
        while($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){
            echo '<td><strong>'.$row['item_name'].
            '</strong><br/>'.$row['item_desc'].
            '<br/><img src='.$row['item_img'].
            '><br/>$'.$row['item_price'].
            '<br/><a href="added.php?id='.$row['item_id'].
            '">Добавить в карзину</a></td>';
        }
        echo '</tr></table>';
        mysqli_close($dbc);
    }else{
        echo '<p>Нет товаров удовлетворяющих условия фильтра</p>';
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
            '">Добавить в карзину</a></td>';
        }
        echo '</tr></table>';
        mysqli_close($dbc);
    }else{
        echo '<p>Магазин пуст</p>';
    }
}



echo '<p><a href="cart.php">Корзина</a> |
<a href="home.php">Главная</a> |
<a href="goodbye.php">Выход</a></p>' ;
?>