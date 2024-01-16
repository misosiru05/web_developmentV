<?php
session_start();

try {
    // データベース接続
    $dsn = 'mysql:dbname=webcafe;host=localhost';
    $db_user = 'webcafe';
    $db_password = 'webcafe';
    $pdo = new PDO($dsn, $db_user, $db_password);

    // セッションIDを取得
    $session_id = session_id();

    // カートの内容を削除
    $prepare = $pdo->prepare("DELETE FROM cart WHERE session_id = :session_id");
    $prepare->bindParam(':session_id', $session_id);

    if ($prepare->execute()) {
        echo "カートの内容が削除されました。";
    } else {
        echo "削除に失敗しました。";
    }
    $prepare = $pdo->prepare("DELETE FROM paysum WHERE session_id = :session_id");
    $prepare->bindParam(':session_id', $session_id);
    $prepare->execute();

} catch (PDOException $e) {
    echo 'PDOException: ' . $e->getMessage();
    exit();
}
?>

<!-- ショップページへのリダイレクト -->
<script>
    setTimeout(function () {
        window.location.href = 'shop_top.php';
    }, 1000); // 2秒後にリダイレクト
</script>
