<?php

class m0001_initial {
    public function up()
    {
        $db = \thecodeholic\phpmvc\Application::$app->db;

        $SQL = "CREATE TABLE categories (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=INNODB;";
        $db->pdo->exec($SQL);

        $SQL = "CREATE TABLE products (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                price DECIMAL(10, 2) NOT NULL,
                category_id INT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (category_id) REFERENCES categories(id)
            ) ENGINE=INNODB;";
        $db->pdo->exec($SQL);

        // Insert sample categories
        $SQL = "INSERT INTO categories (name) VALUES
                ('Electronics'),
                ('Books'),
                ('Clothing'),
                ('Toys'),
                ('Home & Kitchen');";
        $db->pdo->exec($SQL);

        $SQL = "INSERT INTO products (name, price, category_id) VALUES
                ('Smartphone', 699.99, 1),
                ('Laptop', 999.99, 1),
                ('PC', 1199.99, 1),
                ('XBOX 360', 600.00, 1),
                ('XBOX 1', 700.00, 1),
                ('Novel', 14.99, 2),
                ('Comics', 10.00, 2),
                ('Book', 25.00, 2),
                ('Manga', 5.00, 2),
                ('T-shirt', 19.99, 3),
                ('Pants', 12.99, 3),
                ('Hat', 9.99, 3),
                ('Shoes', 50.99, 3),
                ('Action Figure', 24.99, 4),
                ('Car', 10.99, 4),
                ('Water pistol', 30.99, 4),
                ('Lego', 50.99, 4),
                ('Coffee Maker', 49.99, 5),
                ('Microwave', 149.99, 5),
                ('Owen', 249.99, 5),
                ('Toaster', 29.99, 5);";
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = \thecodeholic\phpmvc\Application::$app->db;

        $SQL = "DROP TABLE products;";
        $db->pdo->exec($SQL);

        $SQL = "DROP TABLE categories;";
        $db->pdo->exec($SQL);
    }
}
