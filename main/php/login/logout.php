<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

    <script src="./folder/include.js"></script>


<?php
session_start();
// セッションクリア
session_destroy();

$_SESSION['message'] = "ログアウトしました。";
header('Location: login.php');
exit();
?>
