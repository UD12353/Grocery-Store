-- Update existing categories
UPDATE `products` SET category = 'grocery' WHERE category = 'meat';
UPDATE `products` SET category = 'dry fruits' WHERE category = 'fish';
UPDATE `products` SET category = 'vegetables' WHERE category = 'vegitables';

-- Insert sample products for new categories

-- Dairy Products
INSERT INTO `products` (name, category, details, price, image) VALUES
('Fresh Milk', 'dairy', 'Pure and fresh cow milk, pasteurized and homogenized.', 3, 'milk.png'),
('Cheddar Cheese', 'dairy', 'Aged cheddar cheese block, perfect for sandwiches.', 5, 'cheese.png'),
('Salted Butter', 'dairy', 'Creamy salted butter for cooking and baking.', 4, 'butter.png'),
('Greek Yogurt', 'dairy', 'Thick and creamy plain Greek yogurt, high in protein.', 2, 'yogurt.png');

-- Bakery Products
INSERT INTO `products` (name, category, details, price, image) VALUES
('Whole Wheat Bread', 'bakery', 'Freshly baked whole wheat bread loaf.', 2, 'bread.png'),
('Chocolate Cake', 'bakery', 'Rich and moist chocolate cake slice.', 4, 'cake.png'),
('Croissant', 'bakery', 'Buttery and flaky french croissant.', 3, 'croissant.png'),
('Oatmeal Cookies', 'bakery', 'Healthy oatmeal cookies with raisins.', 3, 'cookies.png');

-- Snacks Products
INSERT INTO `products` (name, category, details, price, image) VALUES
('Potato Chips', 'snacks', 'Crispy salted potato chips.', 2, 'chips.png'),
('Mixed Nuts', 'snacks', 'Roasted and salted mixed nuts.', 6, 'nuts.png'),
('Popcorn', 'snacks', 'Butter flavored microwave popcorn.', 3, 'popcorn.png'),
('Pretzels', 'snacks', 'Crunchy salted pretzels.', 3, 'pretzels.png');

-- Beverages Products
INSERT INTO `products` (name, category, details, price, image) VALUES
('Orange Juice', 'beverages', '100% pure squeezed orange juice.', 4, 'orange_juice.png'),
('Green Tea', 'beverages', 'Organic green tea bags, pack of 20.', 5, 'green_tea.png'),
('Coffee Beans', 'beverages', 'Roasted arabica coffee beans.', 8, 'coffee.png'),
('Soda Can', 'beverages', 'Refreshing carbonated soft drink.', 1, 'soda.png');

-- Vegetable Products (New additions)
INSERT INTO `products` (name, category, details, price, image) VALUES
('Broccoli', 'vegetables', 'Fresh green broccoli.', 3, 'broccoli.png'),
('Carrots', 'vegetables', 'Organic crunchy carrots.', 2, 'carrots.png'),
('Spinach', 'vegetables', 'Fresh spinach leaves bunch.', 1, 'spinach.png'),
('Potatoes', 'vegetables', 'Farm fresh potatoes.', 2, 'potatoes.png');

-- Grocery Products (New additions)
INSERT INTO `products` (name, category, details, price, image) VALUES
('Basmati Rice', 'grocery', 'Premium long grain basmati rice.', 10, 'rice.png'),
('Wheat Flour', 'grocery', 'Whole wheat flour for chapatis and baking.', 5, 'flour.png'),
('Sunflower Oil', 'grocery', 'Refined sunflower oil for cooking.', 6, 'oil.png');

-- Dry Fruits Products (New additions)
INSERT INTO `products` (name, category, details, price, image) VALUES
('Almonds', 'dry fruits', 'Premium quality raw almonds.', 12, 'almonds.png'),
('Cashews', 'dry fruits', 'Whole cashew nuts.', 14, 'cashews.png'),
('Raisins', 'dry fruits', 'Sweet dried grapes.', 8, 'raisins.png');
