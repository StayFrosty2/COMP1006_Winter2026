create table users11 (
    user_id     INT AUTO_INCREMENT PRIMARY KEY,
    
    username    VARCHAR(100) NOT NULL,
    password    VARCHAR(255) NOT NULL,
    image_path  VARCHAR(255),
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
 );