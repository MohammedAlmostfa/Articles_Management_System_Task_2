

CREATE DATABASE blog_db;
CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,          
    title VARCHAR(255) NOT NULL,                 
    content TEXT NOT NULL,                        
    author VARCHAR(100),                           
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    updated_at TIMESTAMP  NULL ON UPDATE CURRENT_TIMESTAMP 
    );