<?php
require_once 'C:\xampp\htdocs\Articles management system\controller\home.php';
// fبدء الجلسة
session_start();
// id الحصول عل  ال
$id = $_GET["id"];
$object = new Post(0);
// تنفيذ تابع القراءة لجلب المعلومات من اجل عرضها بالواجهة
$result = $object->read($id)->get_result();
// استخراج المعلومات
$row = $result->fetch_assoc();
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

   <title>Blog management system</title>
</head>





<body class="body2">
   <div class="cover-container d-flex h-100 p-4 mx-auto flex-column">


      <?php if ($toast_message): ?>
      <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true"
         style="position: absolute; top: 20px; right: 20px;">
         <div class="toast-header">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
               class="bi bi-shield-exclamation" viewBox="0 0 16 16">
               <path
                  d="M5.338 1.59a61 61 0 0 0-2.837.856.48.48 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.7 10.7 0 0 0 2.287 2.233c.346.244.652.42.893.533q.18.085.293.118a1 1 0 0 0 .101.025 1 1 0 0 0 .1-.025q.114-.034.294-.118c.24-.113.547-.29.893-.533a10.7 10.7 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.8 11.8 0 0 1-2.517 2.453 7 7 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7 7 0 0 1-1.048-.625 11.8 11.8 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 63 63 0 0 1 5.072.56" />
               <path
                  d="M7.001 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.553.553 0 0 1-1.1 0z" />
            </svg>
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





      <div class="text-center mb-4">

         <h1>Edit The articale</h1>
         <p class="text-muted">Complete the form below to edit a new article</p>
      </div>

      <div class="container d-flex justify-content-center">
         <form action="http://localhost/Articles%20management%20system/controller/edit_post_2.php" method="post" style="width:80vw; min-width:300px;">
            <div class="row mb-3">
               <div class="col">
                  <label class="form-label">Articale title:</label>
                  <input type="text" class="form-control" name="title" placeholder="Enter Articale title "
                     value=<?php echo $row["title"]; ?>>
               </div>
               <div class="col">
                  <label class="form-label">Author name:</label>
                  <input type="text" class="form-control" name="author" placeholder="Enter Auther name"
                     value=<?php echo $row["author"]; ?>>
               </div>
            </div>
            <input type="hidden" class="form-control" name="id"
               value=<?php echo $row["id"]; ?>>
            <div class="mb-3">
               <label class="form-label">Content:</label>
               <textarea class="form-control" name="content" rows="8" cols="150"
                  placeholder="Enter your article"><?php echo htmlspecialchars($row["content"]); ?></textarea>
            </div>
            <div>
               <button type="submit" class="btn btn-success" name="submit">Edit</button>
               <a href="list_posts.php" class="btn btn-danger">Cancel</a>
            </div>
         </form>
      </div>

      <!-- Bootstrap JS and dependencies -->
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>

   </div>
</body>

</html>