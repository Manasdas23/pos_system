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
    <nav style="background-color: #45474B;" class="shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <i class="material-icons text-white text-3xl mr-3">warehouse</i>
                    <h1 class="text-2xl font-bold text-white">Inventory Dashboard</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-white font-semibold">Welcome, <?php echo $user['full_name'] ?: $user['username']; ?></span>
                    <a href="<?php echo base_url('auth/logout'); ?>" class="bg-white text-charcoal px-4 py-2 rounded-lg hover:bg-opacity-90 transition-colors">
                        <i class="material-icons text-sm mr-1">logout</i>
                        Logout
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <!-- Inventory Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Products Card -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="material-icons text-3xl text-blue-500">inventory_2</i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Products</p>
                        <p class="text-2xl font-bold text-gray-900">1,245</p>
                    </div>
                </div>
            </div>

            <!-- Low Stock Card -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="material-icons text-3xl text-red-500">error</i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Low Stock</p>
                        <p class="text-2xl font-bold text-gray-900">23</p>
                    </div>
                </div>
            </div>

            <!-- Out of Stock Card -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="material-icons text-3xl text-orange-500">warning</i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Out of Stock</p>
                        <p class="text-2xl font-bold text-gray-900">5</p>
                    </div>
                </div>
            </div>

            <!-- Total Value Card -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="material-icons text-3xl text-green-500">attach_money</i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Value</p>
                        <p class="text-2xl font-bold text-gray-900">$45,678</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <h2 class="text-xl font-bold text-charcoal mb-6">Quick Actions</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <button class="flex items-center justify-center p-4 bg-charcoal text-white rounded-lg hover:bg-opacity-90 transition-colors">
                    <i class="material-icons mr-2">add_circle</i>
                    <span class="font-semibold">Add Product</span>
                </button>
                <button class="flex items-center justify-center p-4 bg-blue-500 text-white rounded-lg hover:bg-opacity-90 transition-colors">
                    <i class="material-icons mr-2">edit</i>
                    <span class="font-semibold">Update Stock</span>
                </button>
                <button class="flex items-center justify-center p-4 bg-green-500 text-white rounded-lg hover:bg-opacity-90 transition-colors">
                    <i class="material-icons mr-2">local_shipping</i>
                    <span class="font-semibold">Receive Stock</span>
                </button>
                <button class="flex items-center justify-center p-4 bg-purple-500 text-white rounded-lg hover:bg-opacity-90 transition-colors">
                    <i class="material-icons mr-2">assessment</i>
                    <span class="font-semibold">Stock Report</span>
                </button>
            </div>
        </div>

        <!-- Inventory Management -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Product Search & List -->
            <div class="lg:col-span-2 bg-white rounded-xl shadow-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-charcoal">Product Inventory</h2>
                    <button class="bg-charcoal text-white px-4 py-2 rounded-lg hover:bg-opacity-90 transition-colors">
                        <i class="material-icons mr-1">add</i>
                        Add New Product
                    </button>
                </div>
                
                <!-- Search Bar -->
                <div class="mb-6">
                    <div class="flex space-x-4">
                        <div class="flex-1">
                            <input type="text" placeholder="Search products..." 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-charcoal focus:border-transparent outline-none">
                        </div>
                        <button class="bg-charcoal text-white px-6 py-3 rounded-lg hover:opacity-90 transition-opacity">
                            <i class="material-icons">search</i>
                        </button>
                    </div>
                </div>

                <!-- Product Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SKU</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">Sample Product 1</td>
                                <td class="px-6 py-4 whitespace-nowrap">SKU001</td>
                                <td class="px-6 py-4 whitespace-nowrap">25</td>
                                <td class="px-6 py-4 whitespace-nowrap">$10.99</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">In Stock</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button class="text-blue-600 hover:text-blue-900 mr-3">Edit</button>
                                    <button class="text-red-600 hover:text-red-900">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">Sample Product 2</td>
                                <td class="px-6 py-4 whitespace-nowrap">SKU002</td>
                                <td class="px-6 py-4 whitespace-nowrap">5</td>
                                <td class="px-6 py-4 whitespace-nowrap">$15.50</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Low Stock</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button class="text-blue-600 hover:text-blue-900 mr-3">Edit</button>
                                    <button class="text-red-600 hover:text-red-900">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">Sample Product 3</td>
                                <td class="px-6 py-4 whitespace-nowrap">SKU003</td>
                                <td class="px-6 py-4 whitespace-nowrap">0</td>
                                <td class="px-6 py-4 whitespace-nowrap">$8.75</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Out of Stock</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button class="text-blue-600 hover:text-blue-900 mr-3">Edit</button>
                                    <button class="text-red-600 hover:text-red-900">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Alerts & Recent Activities -->
            <div class="space-y-6">
                <!-- Stock Alerts -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-charcoal mb-4">Stock Alerts</h3>
                    <div class="space-y-3">
                        <div class="flex items-center p-3 bg-red-50 border border-red-200 rounded-lg">
                            <i class="material-icons text-red-500 mr-3">error</i>
                            <div>
                                <p class="font-semibold text-red-800">Product A</p>
                                <p class="text-sm text-red-600">Out of stock</p>
                            </div>
                        </div>
                        <div class="flex items-center p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                            <i class="material-icons text-yellow-500 mr-3">warning</i>
                            <div>
                                <p class="font-semibold text-yellow-800">Product B</p>
                                <p class="text-sm text-yellow-600">Low stock (5 left)</p>
                            </div>
                        </div>
                        <div class="flex items-center p-3 bg-orange-50 border border-orange-200 rounded-lg">
                            <i class="material-icons text-orange-500 mr-3">schedule</i>
                            <div>
                                <p class="font-semibold text-orange-800">Product C</p>
                                <p class="text-sm text-orange-600">Expiring soon</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activities -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-charcoal mb-4">Recent Activities</h3>
                    <div class="space-y-3">
                        <div class="flex items-center p-3 bg-light-gray rounded-lg">
                            <i class="material-icons text-green-500 mr-3">add_circle</i>
                            <div>
                                <p class="font-semibold">Stock added</p>
                                <p class="text-sm text-gray-600">Product X - 50 units</p>
                                <p class="text-xs text-gray-500">2 minutes ago</p>
                            </div>
                        </div>
                        <div class="flex items-center p-3 bg-light-gray rounded-lg">
                            <i class="material-icons text-blue-500 mr-3">edit</i>
                            <div>
                                <p class="font-semibold">Product updated</p>
                                <p class="text-sm text-gray-600">Product Y - Price changed</p>
                                <p class="text-xs text-gray-500">15 minutes ago</p>
                            </div>
                        </div>
                        <div class="flex items-center p-3 bg-light-gray rounded-lg">
                            <i class="material-icons text-purple-500 mr-3">local_shipping</i>
                            <div>
                                <p class="font-semibold">Stock received</p>
                                <p class="text-sm text-gray-600">Shipment #123 - 200 items</p>
                                <p class="text-xs text-gray-500">1 hour ago</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>