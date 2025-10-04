-- Sample data for POS system
-- Insert roles
INSERT INTO roles (name, display_name) VALUES 
('manager', 'Manager'),
('cashier', 'Cashier'),
('inventory_operator', 'Inventory Operator');

-- Insert sample users (password is 'password123' for all users)
INSERT INTO users (username, email, password, full_name, is_active) VALUES 
('manager1', 'manager@pos.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'John Manager', 1),
('cashier1', 'cashier@pos.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Jane Cashier', 1),
('inventory1', 'inventory@pos.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Bob Inventory', 1);

-- Assign roles to users
INSERT INTO user_roles (user_id, role_id) VALUES 
(1, 1), -- manager1 has manager role
(2, 2), -- cashier1 has cashier role
(3, 3); -- inventory1 has inventory_operator role