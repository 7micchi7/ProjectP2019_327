CREATE TABLE addresses(
    id INT AUTO_INCREMENT primary key,
    name VARCHAR(32),
    address VARCHAR(50),
    phone VARCHAR(32),
    email VARCHAR(50)
);
 
INSERT INTO addresses
( name, address, phone, email)
VALUES
('工科 太郎', '八王子', '012-345-6789', 'tarou@example.com'),
('蒲田 花子', '蒲田', '987-654-3210', 'hanako@example.com');

SELECT * FROM addresses;

SELECT * FROM addresses WHERE address = '八王子';