<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>カフェサイト(仮称)</title>
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<header id="same">
			<h1 class="name">Name</h1>
			<h1><a href="index.html">TOP</a></h1>
			<h1><a href="menu.html">Menu</a></h1>
			<h1><a href="reservation.html">Reserve</a></h1>
			<h1><a href="shop.html">Shop</a></h1>
		</header>
		<main>
			<!-- <p>headerとfooterの箇所には記述しないで、この中に記述してください。</p> -->
			<!-- PHP -->
			<?php
				error_reporting(E_ALL);
				ini_set('display_errors', 1);
				//echo session_id();
				// データベース接続処理 
				$dsn = 'mysql:dbname=webcafe;host=localhost';
				$db_user = 'webcafe';
				$db_password = 'webcafe';
				try{
					$pdo = new PDO($dsn, $db_user, $db_password);
					//echo 'DBアクセス成功';
				}catch(PDOException $e){
					echo 'PDOException: ' . $e->getMessage();
					exit();
				}

				function addToCart($pdo, $session_id, $product, $price, $quantity, $path) {
					$prepare = $pdo->prepare("INSERT INTO `cart` (`session_id`, `product`, `price`, `quantity`, `path`) VALUES (:session_id, :product, :price, :quantity, :path)");
					$prepare->bindParam(':session_id', $session_id);
					$prepare->bindParam(':product', $product);
					$prepare->bindParam(':price', $price);
					$prepare->bindParam(':quantity', $quantity, PDO::PARAM_INT);
					$prepare->bindParam(':path', $path);
					$prepare->execute();
				}

				$session_id = session_id();

				$num1 = $_POST['num1'];
				if ($num1 != 0) {
					addToCart($pdo, $session_id, '【当店イチオシ！】イチゴタルト', 700, $num1, 'images/28185248_s.jpg');
				}

				$num2 = $_POST['num2'];
				if ($num2 != 0) {
					addToCart($pdo, $session_id, '【オリジナルブレンド】珈琲豆500g', 1500, $num2, 'images/26944234_s.jpg');
				}

				$num3 = $_POST['num3'];
				if ($num3 != 0) {
					addToCart($pdo, $session_id, 'コーヒーミル', 2900, $num3, 'images/27994532_s.jpg');
				}

				$prepare = $pdo->prepare("SELECT * FROM cart WHERE session_id = :session_id");
				$prepare->bindParam(':session_id',$session_id);
				$prepare->execute();
				$result = $prepare->fetchAll(PDO::FETCH_ASSOC);
				//var_dump($result);
				$rowcount = count($result);
				//echo $rowcount;
				?>

				<br><h1 class="cartTop"><?php echo $rowcount ?>件の商品がカートに入っています</h1>
				<?php
				$i = 0;
				$pay =0;
				while($i < $rowcount){
					echo "<div class='item'><img src='" . $result[$i]["path"] . "' class='cartitemimg'>";
					echo "<div class='cartitemtext'>";
					echo "<h2 class='itemname'>" . $result[$i]["product"] . "</h2><br>";
					$quantityAsString = strval($result[$i]["quantity"]);
					$priceAsString = strval($result[$i]["price"]);
					echo "<p class='itemprice'>" . $quantityAsString . "個    " . $priceAsString . "円</p>";
					echo "</div></div>";
					$pay +=$result[$i]["price"];
					$i ++;
					
				}
				$pay *= 1.08;
				echo "<hr>";
				echo "<h3 class='cartTop'>合計：" . $i . "点 " . $pay . "円(税込み)</h3>";

				$prepare = $pdo->prepare("INSERT INTO `paysum` (`session_id`,`paysum`) VALUES (:session_id ,:paysum)");
					$prepare->bindParam(':session_id', $session_id);
					$prepare->bindParam(':paysum', $pay);
					$prepare->execute();
				?>
				<br><br>
				<div class="form-container">
				<form action="delete_cart.php" method="post">
					<input type="submit" value="ショップページに戻る" class="buttons">
				</form>
				<form action="shop_input.php" method="post">
				<input type="submit" value="購入手続きに進む" class="buttons">
				</form>
			</div>
			<br><br>

		</main>
		<footer id="samefoot">
			<h1><a href="index.html">TOP</a></h1>
			<h1><a href="menu.html">Menu</a></h1>
			<h1><a href="reservation.html">Reserve</a></h1>
			<h1><a href="shop.html">Shop</a></h1>
		</footer>
	</body>
</html>

<style>
.cartTop{
	text-align : center;
}

.item {
	text-align: center;
	padding-top: 80px;
	padding-bottom:40px;
	padding-right: 30px;
}

.cartitemimg {
	display: inline-block;
	padding-right: 40px;
	padding-left: 50px;
	width : 200px;
	height: 200px;
}

.cartitemtext {
	display: inline-block;
	vertical-align: top;
	text-align: left;
}

.buttons{
	display       : inline-block;
	border-radius : 20%;        
	font-size     : 15pt;      
	text-align    : center;    
	cursor        : pointer;  
	padding       : 10px 53px;  
	background    : #ffffff;    
	color         : #000000;    
	line-height   : 1em;        
	transition    : .3s;        
	box-shadow    : 6px 6px 3px #666666;  
	border        : 2px solid #000000;  
}
.buttons:hover {
	box-shadow    : none;     
	color         : #ffffff;   
	background    : #000000;   
  }
.form-container{
	display : flex;
	align-items: center;
    justify-content: center;
}
.form{
	margin-right: 100px;
}
</style>