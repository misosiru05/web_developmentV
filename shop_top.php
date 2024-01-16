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

		<main>
			<!-- ↓headerとfooterの箇所には記述しないで、この中に記述してください。↓-->

			<!-- ショップページトップの画像 -->
			<img src="images/shoptopimage.png" class="shopTop">
			<!-- <?php echo session_id(); ?> -->

			<!-- フォーム -->
			<br><br>
			<form action='shop_cart.php' method='post'>
				
				<!-- イチゴタルト -->
				<div class="item"><img src="images/28185248_s.jpg" class="shopItemimg">
					<div class="shopItemtext">
						<h2>【当店イチオシ！】イチゴタルト</h2>
						<h3>￥700(税別)</h3>
						<h3>新鮮なイチゴとサクサクのタルト記事が絶妙なバランス。<br>特別な日のデザートにはピッタリ。</h3>
						<h3 class="caption">※一度の購入につき10個まで</h3>
						<button type="button" onclick="buttonClickm1()">ー</button>
						<input type="text" id="num1" value="0" readonly>
						<button type="button" onclick="buttonClickp1()">＋</button>
						<button type="button" onclick="buttonClickc1()">カートに入れる</button>
						<input type="hidden" id="num1submit" name="num1" value="0">			
					</div>
				</div>

				<!-- 珈琲豆 -->
				<div class="item"><img src="images/26944234_s.jpg" class="shopItemimg">
					<div class="shopItemtext">
						<h2>【オリジナルブレンド】珈琲豆500g</h2>
						<h3>￥1,500(税別)</h3>
						<h3>深い香りと濃厚な味わい。<br>当店自慢のオリジナル珈琲豆で、至福の一杯をお楽しみください。</h3>
						<h3 class="caption">※一度の購入につき10個まで</h3>
						<button type="button" onclick="buttonClickm2()">ー</button>
						<input type="text" id="num2" value="0" readonly>
						<button type="button" onclick="buttonClickp2()">＋</button>
						<button type="button" onclick="buttonClickc2()">カートに入れる</button>
						<input type="hidden" id="num2submit" name="num2" value="0" >
					</div>
					
				</div>

				<!-- コーヒーミル -->
				<div class="item"><img src="images/27994532_s.jpg" class="shopItemimg">
					<div class="shopItemtext">
						<h2>コーヒーミル</h2>
						<h3>￥2,990(税別)</h3>
						<h3>アンティークな魅力。コーヒーミルで豆を挽く贅沢なひとときを。<br>コーヒーライフを彩る上質なアクセサリーです。</h3>
						<h3 class="caption">※一度の購入につき3個まで</h3>
						<button type="button" onclick="buttonClickm3()">ー</button>
						<input type="text" id="num3" value="0" readonly>
						<button type="button" onclick="buttonClickp3()">＋</button>
						<button type="button" onclick="buttonClickc3()">カートに入れる</button>
						<input type="hidden" id="num3submit" name="num3" value="0" >
					</div>
				</div>

				<!-- カートに進む -->
				<br><p>
					<input type="submit" name="submit" value="カートへ進む" class="cbutton">
				</p><br><br>

				</form>

				<!-- スクリプト -->
				<script>

					//イチゴタルト数量処理
					var num1 = parseInt(document.getElementById('num1').value);
					
					function buttonClickm1(){
						if(num1>0){
						num1--;
						document.getElementById('num1').value = num1;
						}
					}

					function buttonClickp1(){
						if(num1<10){
						num1++;
						document.getElementById('num1').value = num1;
						}
					}

					function buttonClickc1(){
						document.getElementById('num1submit').value = num1;
					}

					//珈琲豆数量処理
					var num2 = parseInt(document.getElementById('num2').value);
					
					function buttonClickm2(){
						if(num2>0){
						num2--;
						document.getElementById('num2').value = num2;
						}
					}

					function buttonClickp2(){
						if(num2<10){
						num2++;
						document.getElementById('num2').value = num2;
						}
					}

					function buttonClickc2(){
						document.getElementById('num2submit').value = num2;
					}

					//コーヒーミル数量処理
					var num3 = parseInt(document.getElementById('num3').value);
					
					function buttonClickm3(){
						if(num3>0){
						num3--;
						document.getElementById('num3').value = num3;
						}
					}

					function buttonClickp3(){
						if(num3<3){
						num3++;
						document.getElementById('num3').value = num3;
						}
					}

					function buttonClickc3(){
						document.getElementById('num3submit').value = num3;
					}

				</script>

				

			
			<!-- ↑headerとfooterの箇所には記述しないで、この中に記述してください。↑-->
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
.shopTop {
	width : 100%;
}

.item {
	text-align: center;
	padding-top: 80px;
	padding-bottom:40px;
	padding-right: 30px;
}

.shopItemimg {
	display: inline-block;
	padding-right: 40px;
	padding-left: 100px;
	width : 400px;
	height: 400px;
}

.shopItemtext {
	display: inline-block;
	vertical-align: top;
	text-align: left;
}


.cbutton {
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
.cbutton:hover {
	box-shadow    : none;     
	color         : #ffffff;   
	background    : #000000;   
  }
  </style>
