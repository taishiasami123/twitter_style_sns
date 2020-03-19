<?php
session_start();
require('dbconnect.php');
if (isset($_SESSION['id'])) {
  $member_id = $_SESSION['id'];
  $post_id = $_REQUEST['id'];
  // 投稿を検査する
  $messages = $db->prepare('SELECT * FROM posts WHERE id=?');
  $messages->execute(array($post_id));
  $message = $messages->fetch();
  if ($message['member_id'] == $member_id) {
    // 削除する
    $del = $db->prepare('DELETE FROM posts WHERE id=?');
    $del->execute(array($post_id));
  }
}
header('Location: index.php');
exit();
?>