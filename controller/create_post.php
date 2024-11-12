<?php
//  الموجودة ضمنها method  من اجل االتعامل مع ال home.php تضمين الملف
require_once 'home.php';
session_start();
//  create من اجل استدعاء التابع object انشاء
$object = new Post(0);
//استقبال القيم  ليتم تخزينها في قاعدة البيانات
$object->content = $_POST['content'];
$object->title = $_POST['title'];
$object->author = $_POST['author'];



if (empty($object->content) && empty($object->title)) {
    // تخزين رسالة النجاح في الجلسة
    $_SESSION['toast_message'] = "content and title cannot be empty!";
    header("Location:http://localhost/Articles%20management%20system/view/add-new.php");
    exit(); // إنهاء السكربت بعد التوجيه
} elseif (empty($object->content)) {
    // تحقق من وجود المؤلف
    $_SESSION['toast_message'] = "content  cannot be empty!";
    header("Location:http://localhost/Articles%20management%20system/view/add-new.php");
    exit(); // إنهاء السكربت بعد التوجيه
} elseif (empty($object->title)) {

    $_SESSION['toast_message'] = " title cannot be empty!";
    header("Location:http://localhost/Articles%20management%20system/view/add-new.php");
    exit(); // إنهاء السكربت بعد التوجيه
} else {

    $createResult = $object->create();
    $_SESSION['toast_message'] = "Article created successfully!";

    header("Location: http://localhost/Articles%20management%20system/view/list_posts.php");
    exit();
}
