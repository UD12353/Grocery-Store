-- SQL to add various fruits to the products table
-- Run this in phpMyAdmin or MySQL command line after importing shop_db.sql

-- Insert Orange
INSERT INTO `products` (`name`, `category`, `details`, `price`, `image`) VALUES
('Fresh Orange', 'fruits', 'Sweet and juicy oranges, rich in Vitamin C. Perfect for fresh juice or eating. Imported from premium farms.', 45, 'orange.jpg');

-- Insert Apple
INSERT INTO `products` (`name`, `category`, `details`, `price`, `image`) VALUES
('Red Apple', 'fruits', 'Crispy and sweet red apples. Great source of fiber and antioxidants. Fresh from the orchard.', 120, 'apple.jpg');

-- Insert Banana
INSERT INTO `products` (`name`, `category`, `details`, `price`, `image`) VALUES
('Ripe Banana', 'fruits', 'Fresh yellow bananas, rich in potassium. Perfect for smoothies, desserts, or eating fresh.', 50, 'banana.jpg');

-- Insert Pineapple
INSERT INTO `products` (`name`, `category`, `details`, `price`, `image`) VALUES
('Golden Pineapple', 'fruits', 'Sweet and tangy pineapple. Loaded with vitamins and enzymes. Great for tropical dishes and juices.', 80, 'pineapple.jpg');

-- Insert Santara (Mandarin Orange)
INSERT INTO `products` (`name`, `category`, `details`, `price`, `image`) VALUES
('Santara (Mandarin)', 'fruits', 'Sweet and easy-to-peel mandarin oranges. Rich in Vitamin C and antioxidants. Kids favorite!', 60, 'santara.jpg');

-- Insert Dragon Fruit
INSERT INTO `products` (`name`, `category`, `details`, `price`, `image`) VALUES
('Dragon Fruit', 'fruits', 'Exotic dragon fruit with vibrant pink skin and white flesh. Rich in antioxidants and fiber.', 150, 'dragon_fruit.jpg');

-- Insert Mango
INSERT INTO `products` (`name`, `category`, `details`, `price`, `image`) VALUES
('Alphonso Mango', 'fruits', 'King of fruits! Sweet and aromatic Alphonso mangoes. Premium quality, perfect for desserts.', 200, 'mango.jpg');

-- Insert Grapes
INSERT INTO `products` (`name`, `category`, `details`, `price`, `image`) VALUES
('Green Grapes', 'fruits', 'Seedless green grapes, sweet and crunchy. Rich in vitamins and perfect for snacking.', 90, 'grapes.jpg');

-- Insert Watermelon
INSERT INTO `products` (`name`, `category`, `details`, `price`, `image`) VALUES
('Fresh Watermelon', 'fruits', 'Juicy and refreshing watermelon. Perfect for summer. Hydrating and naturally sweet.', 40, 'watermelon.jpg');

-- Insert Strawberry
INSERT INTO `products` (`name`, `category`, `details`, `price`, `image`) VALUES
('Fresh Strawberry', 'fruits', 'Sweet and aromatic strawberries. Perfect for desserts, smoothies, or eating fresh.', 180, 'strawberry.jpg');

-- Insert Papaya
INSERT INTO `products` (`name`, `category`, `details`, `price`, `image`) VALUES
('Ripe Papaya', 'fruits', 'Sweet and soft papaya, rich in digestive enzymes. Great for breakfast and smoothies.', 55, 'papaya.jpg');

-- Insert Pomegranate
INSERT INTO `products` (`name`, `category`, `details`, `price`, `image`) VALUES
('Pomegranate', 'fruits', 'Fresh pomegranate with ruby-red seeds. Rich in antioxidants and vitamins.', 110, 'pomegranate.jpg');
