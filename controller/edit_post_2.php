<?php
require_once 'home.php';

session_start();
//  update من اجل استدعاء التابع object انشاء
$object = new Post(0);
// الحصول على البيانات من النموذج
$object->content = $_POST['content'] ;
$object->$title = $_POST['title'];
$object->author = $_POST['author'] ;
$object->id = $_POST['id'] ;
$object->updated_at = date('Y-m-d H:i:s');

if (empty($object->content) && empty($object->title)) {
    // تخزين رسالة النجاح في الجلسة
    $_SESSION['toast_message'] = "content and title cannot be empty!";
    header("Location:http://localhost/Articles%20management%20system/view/edit_post.php?id=.$object->id");
    exit(); // إنهاء السكربت بعد التوجيه
} elseif (empty($object->content)) {
    // تحقق من وجود المؤلف
    $_SESSION['toast_message'] = "content  cannot be empty!";
    header("Location:http://localhost/Articles%20management%20system/view/edit_post.php?id=$object->id");
    exit(); // إنهاء السكربت بعد التوجيه
} elseif (empty($object->$title)) {
   
    $_SESSION['toast_message'] = " title cannot be empty!";
    header("Location:http://localhost/Articles%20management%20system/view/edit_post.php?id=$object->id");
    exit(); // إنهاء السكربت بعد التوجيه
} else {

    $object->update();
    $_SESSION['toast_message'] = "Article Update successfully!";

    header("Location: http://localhost/Articles%20management%20system/view/list_posts.php");

    exit();
}
