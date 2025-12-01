-- Remove duplicate products from specific categories
-- This script keeps the oldest product (lowest ID) and deletes newer duplicates (higher IDs) with the same name.

DELETE p1 
FROM products p1 
INNER JOIN products p2 
WHERE 
    p1.id > p2.id 
    AND p1.name = p2.name 
    AND p1.category IN ('grocery', 'dry fruits', 'bakery', 'snacks', 'beverages');

-- Optional: You can uncomment the line below to remove duplicates from ALL categories if you wish
-- AND p1.category IN ('grocery', 'dry fruits', 'bakery', 'snacks', 'beverages', 'vegetables', 'dairy', 'fruits');
