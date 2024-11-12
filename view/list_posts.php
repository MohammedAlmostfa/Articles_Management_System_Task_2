<?php
// بدء جلسة المستخدم
session_start();

// تضمين ملف home.php الذي يحتوي على الكلاس أو الدوال المطلوبة
require_once 'C:\xampp\htdocs\Articles management system\controller\home.php';

// إنشاء كائن من الكلاس Post
$object = new Post(0);

// استدعاء الدالة listAll() واسترجاع النتيجة
$result = $object->listAll()->get_result();

// مصفوفة لتخزين البيانات
$dataArray = [];
while ($row = $result->fetch_assoc()) {
    // إضافة كل صف إلى المصفوفة
    $dataArray[] = $row;
}

// الحصول على رسالة الإشعار من الجلسة
$toast_message = isset($_SESSION['toast_message']) ? $_SESSION['toast_message'] : null;

// فقد الرسالة بعد استخدامها
unset($_SESSION['toast_message']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>PHP CRUD Application</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.html"">Home</a>
    <button class=" navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">

            <li class="nav-item">
              <a class="nav-link" href="add-new.php" role="button">Add New</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="list_posts.php" role="button">My Articles</a>
            </li>
          </ul>
        </div>
    </div>
  </nav>



  <?php if ($toast_message): ?>
  <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true"
    style="position: absolute; top: 20px; right: 20px;">
    <div class="toast-header">

      <strong class="me-auto">Notification</strong>
      <small><?php echo date("h:i:s"); // هنا استخدم دالة لتعريف الوقت المناسب
      ?></small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      <?php echo htmlspecialchars($toast_message); ?>
    </div>
  </div>
  <?php endif; ?>

  <br>
  <div class="text-center mb-4">
    <h1>The Table of article</h1>
  </div>


  <br>
  <div class="container">
    <table class="table table-striped">
      <thead class="table-success">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Title</th>
          <th scope="col">Author</th>
          <th scope="col">Content</th>
          <th scope="col">Created_at</th>
          <th scope="col">Update_at</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php

        if (isset($dataArray)) {
            $i = 0;
            foreach ($dataArray as $row) {
                $i++;
                ?>

        <tr>
          <td><?php echo $i ?></td>
          <td><?php echo $row['title']; ?></td>
          <td><?php echo $row['author']; ?></td>
          <td>Article: <?php echo $i; ?></td>
          <td><?php echo $row['created_at']; ?>
          </td>
          <td><?php echo $row['updated_at']; ?>
          </td>
          <td>

            <a href="edit_post.php?id=<?php echo urlencode($row['id']); ?>"
              class="link-dark"><i class="fa-solid fa-pen-to-square fs-3 me-3"></i></a>
            <a href="http://localhost/Articles%20management%20system/controller/delete_post.php?id=<?php echo urlencode($row['id']); ?>"
              class="link-dark" onclick="return confirm('Are you sure you want to delete this post?');"><i
                class="fa-solid fa-trash fs-3 me-3"></i></a>
            <a href="view_post.php?id=<?php echo urlencode($row['id']); ?>"
              class="link-dark"><i class="fa-solid fa-book fs-3 me-3"></i></a>
          </td>
        </tr>
        <?php
            }
        } else {
            echo "No data available.";
        }
?>


      </tbody>
    </table>
  </div>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
  </script>

  </script>
</body>

</html>