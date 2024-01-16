src（ソースファイル）  
-index.html  
-menu.html  
-resservation.html  
-shop_top.php 
-shop_cart.php  
-shop_input.php  
-shop_confirm.php    
-shop_finish.html  
-delete_cart.php  
-delete_input.php
-style.css  
images（画像）  
memo（メモ）  
design（デザイン画像）  


【SHOPページについて】　　
データベースを使用　　
dbname:webcafe  
username:webcafe  
password:webcafe  
table:cart,paysum,privateinfomation  

cart:"session_id"(var255),"product"(var255),"price"(int255),"quaantity"(int255),"path"(var255)
paysum:"session_id"(var255),"paysum"(int255)
privateinfomation:"session_id"(var255),"fullName"(var255),"postTop"(int3),"postBottom"(int4),"address1"(var255),"address2"(var255),"mail"(var255),"phone"(var13),"date"(date),"time"(var11),"ps"(var255),"paysum"(int11)
