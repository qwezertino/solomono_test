<?php

class m0001_initial {
    public function up()
    {
        $db = \thecodeholic\phpmvc\Application::$app->db;

        // Create categories table
        $SQL = "CREATE TABLE categories (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=INNODB;";
        $db->pdo->exec($SQL);

        // Create products table
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

        // Insert sample products
        $SQL = "INSERT INTO products (name, price, category_id) VALUES
                ('Smartphone', 699.99, 1),
                ('Laptop', 999.99, 1),
                ('Novel', 14.99, 2),
                ('T-shirt', 19.99, 3),
                ('Action Figure', 24.99, 4),
                ('Coffee Maker', 49.99, 5);";
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = \thecodeholic\phpmvc\Application::$app->db;

        // Drop products table
        $SQL = "DROP TABLE products;";
        $db->pdo->exec($SQL);

        // Drop categories table
        $SQL = "DROP TABLE categories;";
        $db->pdo->exec($SQL);
    }
}
