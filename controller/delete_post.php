<?php
session_start(); // ابدأ جلسة المستخدم
$id = $_GET["id"];
require_once 'home.php';
$object = new Post(0);
$result = $object->delete($id);

if ($result) {
    // تخزين رسالة النجاح في الجلسة
    $_SESSION['toast_message'] = "The article has been successfully deleted!";
    header("Location: http://localhost/Articles%20management%20system/view/list_posts.php");
    ;
    exit(); // إنهاء السكربت بعد التوجيه
} else {
    // في حالة الفشل، يمكنك تخزين رسالة فشل في الجلسة
    $_SESSION['toast_message'] = "An error occurred while trying to delete the article!";
    header("Location: http://localhost/Articles%20management%20system/view/list_posts.php");
    ;
    exit(); // إنهاء السكربت بعد التوجيه
}
