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
		<h1 class="inputTop">購入情報を入力</h1>
		<main class="mains">
			<!-- ↓headerとfooterの箇所には記述しないで、この中に記述してください。-->
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
					$prepare->bindParam(':session_id',$session_id);
					$prepare->execute();
					$result = $prepare->fetch(PDO::FETCH_ASSOC);
					//var_dump($result);
					$paysum = $result["paysum"];
			?>

			
			<div class="forms">
			<form action="shop_confirm.php" method="post">
				<p>お名前：<input type="text" name="fullName"><p>
				<p>郵便番号：<input type="text" name="postTop" class="post"> - <input type="text" name="postBottom" class="post"></p>
				<p>住所１：<input type="text" name="address1"></p>
				<p>住所２：<input type="text" name="address2"></p>
				<p>メールアドレス：<input type="text" name="mail"></p>
				<p>電話番号：<input type="text" name="phone"></p>
				<p>お届け日：<input type="date" name="date"></p>
				<p>お届け時間帯：
					<select name="time">
						<option>午前中</option>
						<option>正午～14時</option>
						<option>14時～16時</option>
						<option>16時～18時</option>
						<option>18時～20時</option>
					</select>
				</p>
				<p>備考：<textarea name="ps"></textarea></p>
				<p class="buttons"><input type="submit" name="nextTo" value="購入情報確認へ"></p>
				<input type="hidden" name="paysum" value="<?php echo $paysum; ?>">
			</form>
		</div>

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
.inputTop{
	text-align: center;
}
.mains {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            width: 400px; /* フォームの幅を必要に応じて調整 */
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        p {
            margin: 10px 0;
        }

        textarea {
            width: 100%;
            height: 100px; /* テキストエリアの高さを必要に応じて調整 */
        }

        input[type="submit"] {
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
			margin-left: 70px;
        }
		input[type="submit"]:hover{
			box-shadow    : none;     
			color         : #ffffff;   
			background    : #000000;  
		}
		.post{
			width: 20%;
		}
		.buttons{
			align-items: center;
   			justify-content: center;
		}