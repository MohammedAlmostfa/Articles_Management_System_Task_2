<?php
session_start();
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

   <div class="container">
      <div class="text-center mb-4">
         <h1>Add New article</h1>
         <p class="text-muted">Complete the form below to add a new article</p>
      </div>

      <div class="container d-flex justify-content-center">
         <form action="http://localhost/Articles%20management%20system/controller/create_post.php" method="post"
            style="width:50vw; min-width:300px;">
            <div class="row mb-3">
               <div class="col">
                  <label class="form-label">Article title:</label>
                  <input type="text" class="form-control" name="title" placeholder="Enter Article title">
               </div>

               <div class="col">
                  <label class="form-label">Author name:</label>
                  <input type="text" class="form-control" name="author" placeholder="Enter Author name">
               </div>
            </div>

            <div class="mb-3">
               <label class="form-label">Content:</label>
               <textarea class="form-control" name="content" rows="8" cols="150"
                  placeholder="Enter your article"></textarea>
            </div>

            <div>
               <button type="submit" class="btn btn-success" name="submit">Save</button>
               <a href="add-new.php" class="btn btn-danger">Cancel</a>
            </div>
         </form>
      </div>
   </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
  </script>

   <!-- Bootstrap -->
</body>

</html>