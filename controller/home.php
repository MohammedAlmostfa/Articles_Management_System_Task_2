<?php
//نعريف class Datasate
class Database
{
    // متغيرات الكلاس
    private $connection;
    protected $database_table = "posts";
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "blog_db";

    // تابع لإنشاء قاعدة بيانات
    public function createDatabase()
    {
        $sql = "CREATE DATABASE IF NOT EXISTS $this->dbname";
        if ($this->connection->query($sql) === true) {
            echo "Database created successfully";
        } else {
            echo "Database not created successfully: " . $this->connection->error;
        }
    }

    // تابع لإنشاء جدول
    public function createTable()
    {
        $this->connection->select_db($this->dbname);
        $sql = "CREATE TABLE IF NOT EXISTS $this->database_table (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255),
            content TEXT,
            author VARCHAR(100),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        if ($this->connection->query($sql) === true) {
            echo "Table created successfully";
        } else {
            echo "Table not created successfully: " . $this->connection->error;
        }
    }

    // تابع للاتصال بقاعدة البيانات
    public function connect()
    {
        // معلومات الاتصال
        $this->connection = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        // التحقق من الاتصال
        if ($this->connection->connect_error) {
            die("Error connecting to database: " . $this->connection->connect_error);
            $this->createDatabase();
            $this->createTable();
        }
    }
    // تابع لتنفيذ الاستعلامات
    public function executeQuery($query, $params = [])
    {
        // تحقق من الاتصال بقاعدة البيانات
        $this->connect();
        // تحضير الاستعلام
        $stmt = $this->connection->prepare($query);
        // ربط المعاملات
        if ($params) {
            $stmt->bind_param(...$params);
        }
        // تنفيذ الاستعلام
        $stmt->execute();
        return $stmt;
    }
}

class Post extends Database
{
    //متغيرات الكلاس
    public $id;
    public $title;
    public $content;
    public $author;
    public $created_at;
    public $updated_at;


    // تابع الاضافة
    public function create()
    {
        //تحصير الاستعلام
        $query = "INSERT INTO " . $this->database_table . " (title, content, author) VALUES (?, ?, ?)";
        $params = [
            'sss',
            $this->title,
            $this->content,
            $this->author
        ];

        //استدعاء تابع الاستعلام
        $stmt = $this->executeQuery($query, $params);
        return $stmt;
    }


    public function update()
    {
       
     
    


        $query = "UPDATE " . $this->database_table . " SET title = ?, content = ?, author = ?, updated_at = ? WHERE id = ?";
        $params = [
            'ssssi',
            $this->title,
            $this->content,
            $this->author,
            $this->updated_at,
            $this->id
        ];

        $stmt = $this->executeQuery($query, $params);
        return $stmt;
    }

    // تابع الحذف
    public function delete($id)
    {
        $query = "DELETE FROM " . $this->database_table . " WHERE id = ?";
        $params = ['i', $id];

        // تنفيذ الاستعلام
        $stmt = $this->executeQuery($query, $params);

        // التحقق مما إذا كانت عملية الحذف ناجحة
        if ($stmt) {
            return true; // إعادة true عند النجاح
        } else {

            return false; // إعادة false عند الفشل
        }
    }

    //تابع عرض معلومات المقالة

    public function read($id)
    {
        // إعداد استعلام SQL لاختيار البيانات من الجدول باستخدام معرّف محدد
        $query = "SELECT * FROM " . $this->database_table . " WHERE id = ?";
        $params = ['i', $id]; // تعيين النوع والمعامل لتمريره في الاستعلام

        // تنفيذ الاستعلام
        $stmt = $this->executeQuery($query, $params);
        return $stmt; // اعادة البانات
    }

    // تابع عرض البيانات
    public function listAll()
    {
        $query = "SELECT * FROM " . $this->database_table;
        $stmt = $this->executeQuery($query);
        return $stmt;
    }
}
