<?php
require_once 'C:\xampp\htdocs\Articles management system\controller\home.php';
;

session_start();

// الحصول على المعرف من عنوان URL (ID)
$id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;

// إنشاء كائن من فئة Post
$object = new Post(0);

// قراءة المقال باستخدام المعرف
$result = $object->read($id);



// استخدم get_result() للحصول على نتيجة الاستعلام
$row = $result->get_result()->fetch_assoc();
// هنا يمكنك استخدام البيانات المستخرجة من $row

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read-Only Data Presentation</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .star {
            font-size: 25px;
            color: gray;
            cursor: pointer;
            justify-content: center;
        }

        .star.selected {
            color: gold;
        }

        

        
    </style>
</head>

<body>

    <div class="container mt-5">
        <h2>The Article Information:</h2>

        <div class="textarea-container">
            <textarea class="form-control" id="content" rows="10" readonly>
<?php
echo "\n";
echo "Title: " . $row['title'] . "\n";
echo "Author: " . $row['author'] . "\n";
echo "Created at: " . $row['created_at'] . "\n";

if ($row['updated_at']) {
    echo "Updated at: " . $row['updated_at'] . "\n";
} else {
    echo "Updated at: The article has not been updated yet\n";
}
echo "Content: " . $row['content'];
?>
            </textarea>
            <br>
            <br>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success back-button" data-toggle="modal" data-target="#exampleModalCenter">
                Back
            </button>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Evaluate The Article</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="star-rating">
                        <span class="star" onclick="rate(1)">★</span>
                        <span class="star" onclick="rate(2)">★</span>
                        <span class="star" onclick="rate(3)">★</span>
                        <span class="star" onclick="rate(4)">★</span>
                        <span class="star" onclick="rate(5)">★</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <a type="button" href="list_posts.php" class="btn btn-danger">Ignore</a>
                    <a type="button" href="list_posts.php" class="btn btn-success">Evaluate</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function rate(rating) {
            const stars = document.querySelectorAll('.star');
            stars.forEach((star, index) => {
                star.classList.toggle('selected', index < rating);
            });
        }
    </script>

</html>
