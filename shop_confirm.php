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
			<h1><a href="shop_top.php">Shop</a></h1>
		</header>
		<main class="mains">
			<!-- headerとfooterの箇所には記述しないで、この中に記述してください。-->

			<?php
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
					$session_id = session_id();
					$prepare = $pdo->prepare("SELECT * FROM paysum WHERE session_id = :session_id");
					$prepare->bindParam(':session_id', $session_id);
					$prepare->execute();
					$result = $prepare->fetch(PDO::FETCH_ASSOC);
					$paysum = $result["paysum"];

					
					$prepare = $pdo->prepare("INSERT INTO `privateinfomation` (`session_id`, `fullName`, `postTop`, `postBottom`,`address1`,`address2`, `mail`,`phone`,`date`,`time`,`ps`,`paysum`) VALUES (:session_id, :fullName, :postTop, :postBottom,:address1,:address2, :mail,:phone,:date,:time,:ps,:paysum)");
					$prepare->bindParam(':session_id', $session_id);
					$prepare->bindParam(':fullName', $_POST['fullName']);
					$prepare->bindParam(':postTop', $_POST['postTop']);
					$prepare->bindParam(':postBottom', $_POST['postBottom']);
					$prepare->bindParam(':address1', $_POST['address1']);
					$prepare->bindParam(':address2', $_POST['address2']);
					$prepare->bindParam(':mail', $_POST['mail']);
					$prepare->bindParam(':phone', $_POST['phone']);
					$prepare->bindParam(':date', $_POST['date']);
					$prepare->bindParam(':time', $_POST['time']);
					$prepare->bindParam(':ps', $_POST['ps']);
					$prepare->bindParam(':paysum', $paysum);
					$prepare->execute();

					$prepare = $pdo->prepare("SELECT * FROM cart WHERE session_id = :session_id");
					$prepare->bindParam(':session_id',$session_id);
					$prepare->execute();
					$result = $prepare->fetchAll(PDO::FETCH_ASSOC);
					$rowcount = count($result);
			?>

			<h1>購入情報確認</h1><br><br>
			<h2>お客様情報：</h2><?php echo $_POST['fullName'] . "<br>メールアドレス：" .  $_POST['mail'] . "<br>電話番号：" . $_POST['phone'] ; ?>
			<br><h2>お届け情報：</h2><?php echo "〒" . $_POST['postTop'] . " - " . $_POST['postBottom'] . "<br>住所１：" . $_POST['address1'] . "<br>住所２：" . $_POST['address2'] . "<br>お届け日:" . $_POST['date'] . "<br>お届け時間帯：" . $_POST['time'] . "<br>備考：" . $_POST['ps'] ; ?> 
			<br><h2>商品情報：</h2>
				<?php 
				$i = 0;
				while($i < $rowcount){
					echo $result[$i]["product"] . " " ;
					$quantityAsString = strval($result[$i]["quantity"]);
					$priceAsString = strval($result[$i]["price"]);
					echo $quantityAsString . "個    " . $priceAsString . "円<br>";
					$i ++;
				}
				?>
			<p><?php echo $paysum . "円（税込み）"; ?></p>

			<hr>
			<br><br><p>
				<h3>注意事項</h3>
				・在庫量によって配送が遅れる場合があります<br>
				・代金引換でのお届けになりますので現金のご用意をお願いいたします<br><br>
			</p><br>

			<div class="form-container">
			<form action="delete_input.php" method="post">
					<button type="submit" name="delete_input" class="buttons">購入情報入力ページに戻る</button>
				<input type="hidden" name="paysum" value="<?php echo $paysum; ?>" >
				</form>
				<form action="shop_finish.html" method="post">
				<button type="submit" class="buttons">購入する</button>	
				</form><br><br>
			</div><br><br>
		</main>
		<footer id="samefoot">
			<h1><a href="index.html">TOP</a></h1>
			<h1><a href="menu.html">Menu</a></h1>
			<h1><a href="reservation.html">Reserve</a></h1>
			<h1><a href="shop_top.php">Shop</a></h1>
		</footer>
	</body>
</html>
<style>
.mains{
	text-align: center;
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
</style>
