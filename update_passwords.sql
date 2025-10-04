-- Update user passwords with correct hashes
-- Password for all users: password123

UPDATE users SET password = '$2y$10$iO1HAZQwUF6wN5zW.d44d.iCTPZr/ogVfd1oUz6na/d0tkohl3D7.' WHERE username = 'manager1';
UPDATE users SET password = '$2y$10$D3Jaikb7x1EJZBqSWDCyaORF27hKHLnP.uGnO0FFHimGuiOL/pDIG' WHERE username = 'cashier1';
UPDATE users SET password = '$2y$10$SpmKVFPWjzG0/w0FWF83ceA0QBPN0B4kWtC0sses5MzzpxxT0bKOC' WHERE username = 'inventory1';