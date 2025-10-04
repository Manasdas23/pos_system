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
    <nav class="cashier-bg shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <i class="material-icons text-white text-3xl mr-3">point_of_sale</i>
                    <h1 class="text-2xl font-bold text-white">Cashier Dashboard</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-white font-semibold">Welcome, <?php echo $user['full_name'] ?: $user['username']; ?></span>
                    <a href="<?php echo base_url('auth/logout'); ?>" class="bg-white text-dark-green px-4 py-2 rounded-lg hover:bg-opacity-90 transition-colors">
                        <i class="material-icons text-sm mr-1">logout</i>
                        Logout
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Today's Sales Card -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="material-icons text-3xl text-green-500">monetization_on</i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Today's Sales</p>
                        <p class="text-2xl font-bold text-gray-900">$1,234</p>
                    </div>
                </div>
            </div>

            <!-- Transactions Today Card -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="material-icons text-3xl cashier-text">receipt</i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Transactions</p>
                        <p class="text-2xl font-bold text-gray-900">45</p>
                    </div>
                </div>
            </div>

            <!-- Average Sale Card -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="material-icons text-3xl text-blue-500">trending_up</i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Avg. Sale</p>
                        <p class="text-2xl font-bold text-gray-900">$27.42</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- POS Interface -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Product Search & Cart -->
            <div class="lg:col-span-2 bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-charcoal mb-6">Point of Sale</h2>
                
                <!-- Product Search -->
                <div class="mb-6">
                    <div class="flex space-x-4">
                        <div class="flex-1">
                            <input type="text" placeholder="Search products by name or barcode..." 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-dark-green focus:border-transparent outline-none">
                        </div>
                        <button class="cashier-bg text-white px-6 py-3 rounded-lg hover:opacity-90 transition-opacity">
                            <i class="material-icons">search</i>
                        </button>
                    </div>
                </div>

                <!-- Cart Items -->
                <div class="border rounded-lg p-4 mb-6 bg-light-gray">
                    <h3 class="font-semibold mb-4">Shopping Cart</h3>
                    <div class="space-y-2 mb-4">
                        <div class="flex justify-between items-center p-2 bg-white rounded">
                            <span>Sample Product 1</span>
                            <span>2 x $10.00 = $20.00</span>
                            <button class="text-red-500 hover:text-red-700">
                                <i class="material-icons text-sm">delete</i>
                            </button>
                        </div>
                        <div class="flex justify-between items-center p-2 bg-white rounded">
                            <span>Sample Product 2</span>
                            <span>1 x $15.50 = $15.50</span>
                            <button class="text-red-500 hover:text-red-700">
                                <i class="material-icons text-sm">delete</i>
                            </button>
                        </div>
                    </div>
                    <div class="border-t pt-2">
                        <div class="flex justify-between font-bold text-lg">
                            <span>Total:</span>
                            <span>$35.50</span>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <button class="cashier-bg text-white py-3 px-4 rounded-lg font-semibold hover:opacity-90 transition-opacity">
                        <i class="material-icons mr-2">payment</i>
                        Process Payment
                    </button>
                    <button class="bg-gray-500 text-white py-3 px-4 rounded-lg font-semibold hover:opacity-90 transition-opacity">
                        <i class="material-icons mr-2">pause</i>
                        Hold Transaction
                    </button>
                    <button class="bg-red-500 text-white py-3 px-4 rounded-lg font-semibold hover:opacity-90 transition-opacity">
                        <i class="material-icons mr-2">clear</i>
                        Clear Cart
                    </button>
                </div>
            </div>

            <!-- Quick Actions & Recent Sales -->
            <div class="space-y-6">
                <!-- Quick Product Categories -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-charcoal mb-4">Quick Categories</h3>
                    <div class="grid grid-cols-2 gap-3">
                        <button class="flex flex-col items-center p-3 bg-light-gray rounded-lg hover:cashier-bg hover:text-white transition-colors">
                            <i class="material-icons mb-1">local_cafe</i>
                            <span class="text-sm">Beverages</span>
                        </button>
                        <button class="flex flex-col items-center p-3 bg-light-gray rounded-lg hover:cashier-bg hover:text-white transition-colors">
                            <i class="material-icons mb-1">restaurant</i>
                            <span class="text-sm">Food</span>
                        </button>
                        <button class="flex flex-col items-center p-3 bg-light-gray rounded-lg hover:cashier-bg hover:text-white transition-colors">
                            <i class="material-icons mb-1">shopping_bag</i>
                            <span class="text-sm">Grocery</span>
                        </button>
                        <button class="flex flex-col items-center p-3 bg-light-gray rounded-lg hover:cashier-bg hover:text-white transition-colors">
                            <i class="material-icons mb-1">more_horiz</i>
                            <span class="text-sm">Others</span>
                        </button>
                    </div>
                </div>

                <!-- Recent Sales -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-charcoal mb-4">Recent Sales</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center p-3 bg-light-gray rounded-lg">
                            <div>
                                <p class="font-semibold">#001</p>
                                <p class="text-sm text-gray-600">10:30 AM</p>
                            </div>
                            <span class="font-bold">$23.50</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-light-gray rounded-lg">
                            <div>
                                <p class="font-semibold">#002</p>
                                <p class="text-sm text-gray-600">10:45 AM</p>
                            </div>
                            <span class="font-bold">$45.20</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-light-gray rounded-lg">
                            <div>
                                <p class="font-semibold">#003</p>
                                <p class="text-sm text-gray-600">11:15 AM</p>
                            </div>
                            <span class="font-bold">$12.75</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>