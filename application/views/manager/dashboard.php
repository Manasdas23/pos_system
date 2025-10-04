<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?> - POS System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'light-gray': '#F5F7F8',
                        'gold': '#F4CE14',
                        'dark-green': '#495E57',
                        'charcoal': '#45474B'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-light-gray min-h-screen">
    <!-- Navigation Header -->
    <nav class="manager-bg shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <i class="material-icons text-charcoal text-3xl mr-3">manage_accounts</i>
                    <h1 class="text-2xl font-bold text-charcoal">Manager Dashboard</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-charcoal font-semibold">Welcome, <?php echo $user['full_name'] ?: $user['username']; ?></span>
                    <a href="<?php echo base_url('auth/logout'); ?>" class="bg-charcoal text-white px-4 py-2 rounded-lg hover:bg-opacity-90 transition-colors">
                        <i class="material-icons text-sm mr-1">logout</i>
                        Logout
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <!-- Dashboard Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Sales Card -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="material-icons text-3xl text-green-500">trending_up</i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Sales</p>
                        <p class="text-2xl font-bold text-gray-900">$12,345</p>
                    </div>
                </div>
            </div>

            <!-- Total Orders Card -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="material-icons text-3xl text-blue-500">shopping_cart</i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Orders</p>
                        <p class="text-2xl font-bold text-gray-900">1,234</p>
                    </div>
                </div>
            </div>

            <!-- Active Users Card -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="material-icons text-3xl manager-text">people</i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Active Users</p>
                        <p class="text-2xl font-bold text-gray-900">12</p>
                    </div>
                </div>
            </div>

            <!-- Low Stock Items Card -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="material-icons text-3xl text-red-500">warning</i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Low Stock Items</p>
                        <p class="text-2xl font-bold text-gray-900">5</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <h2 class="text-xl font-bold text-charcoal mb-6">Quick Actions</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4">
                <button class="flex flex-col items-center p-4 bg-light-gray rounded-lg hover:bg-gold hover:text-charcoal transition-colors">
                    <i class="material-icons text-3xl mb-2">assessment</i>
                    <span class="text-sm font-semibold">Reports</span>
                </button>
                <a href="<?php echo base_url('manager/users'); ?>" class="flex flex-col items-center p-4 bg-light-gray rounded-lg hover:bg-gold hover:text-charcoal transition-colors">
                    <i class="material-icons text-3xl mb-2">people</i>
                    <span class="text-sm font-semibold">Manage Users</span>
                </a>
                <button class="flex flex-col items-center p-4 bg-light-gray rounded-lg hover:bg-gold hover:text-charcoal transition-colors">
                    <i class="material-icons text-3xl mb-2">inventory</i>
                    <span class="text-sm font-semibold">Inventory</span>
                </button>
                <button class="flex flex-col items-center p-4 bg-light-gray rounded-lg hover:bg-gold hover:text-charcoal transition-colors">
                    <i class="material-icons text-3xl mb-2">settings</i>
                    <span class="text-sm font-semibold">Settings</span>
                </button>
                <button class="flex flex-col items-center p-4 bg-light-gray rounded-lg hover:bg-gold hover:text-charcoal transition-colors">
                    <i class="material-icons text-3xl mb-2">backup</i>
                    <span class="text-sm font-semibold">Backup</span>
                </button>
                <button class="flex flex-col items-center p-4 bg-light-gray rounded-lg hover:bg-gold hover:text-charcoal transition-colors">
                    <i class="material-icons text-3xl mb-2">help</i>
                    <span class="text-sm font-semibold">Help</span>
                </button>
            </div>
        </div>

        <!-- Recent Activities -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-charcoal mb-6">Recent Activities</h2>
            <div class="space-y-4">
                <div class="flex items-center p-4 bg-light-gray rounded-lg">
                    <i class="material-icons text-green-500 mr-4">check_circle</i>
                    <div>
                        <p class="font-semibold">Sale completed by John Doe</p>
                        <p class="text-sm text-gray-600">2 minutes ago</p>
                    </div>
                </div>
                <div class="flex items-center p-4 bg-light-gray rounded-lg">
                    <i class="material-icons text-blue-500 mr-4">inventory_2</i>
                    <div>
                        <p class="font-semibold">Inventory updated by Jane Smith</p>
                        <p class="text-sm text-gray-600">15 minutes ago</p>
                    </div>
                </div>
                <div class="flex items-center p-4 bg-light-gray rounded-lg">
                    <i class="material-icons text-orange-500 mr-4">person_add</i>
                    <div>
                        <p class="font-semibold">New user registered</p>
                        <p class="text-sm text-gray-600">1 hour ago</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>