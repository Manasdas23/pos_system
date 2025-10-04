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
                    <a href="<?php echo base_url('manager/dashboard'); ?>" class="flex items-center text-charcoal hover:text-gray-700 mr-6">
                        <i class="material-icons mr-2">arrow_back</i>
                        <span class="font-semibold">Back to Dashboard</span>
                    </a>
                    <i class="material-icons text-charcoal text-3xl mr-3">people</i>
                    <h1 class="text-2xl font-bold text-charcoal">User Management</h1>
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
        <!-- Success/Error Messages -->
        <?php if (isset($success) && !empty($success)): ?>
        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
            <i class="material-icons text-green-600 mr-2">check_circle</i>
            <?php echo $success; ?>
        </div>
        <?php endif; ?>

        <?php if (isset($error) && !empty($error)): ?>
        <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
            <i class="material-icons text-red-600 mr-2">error</i>
            <?php echo $error; ?>
        </div>
        <?php endif; ?>

        <!-- Header with Add User Button -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-bold text-charcoal">System Users</h2>
                    <p class="text-gray-600 mt-1">Manage user accounts and permissions</p>
                </div>
                <a href="<?php echo base_url('manager/add_user'); ?>" class="manager-bg text-charcoal px-6 py-3 rounded-lg font-semibold hover:bg-opacity-90 transition-colors flex items-center">
                    <i class="material-icons mr-2">person_add</i>
                    Add New User
                </a>
            </div>
        </div>

        <!-- Users Table -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Login</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php if (!empty($users)): ?>
                            <?php foreach ($users as $user_item): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full <?php echo strtolower($user_item->role_name); ?>-bg flex items-center justify-center">
                                                <span class="text-white font-semibold text-sm">
                                                    <?php echo strtoupper(substr($user_item->full_name ?: $user_item->username, 0, 2)); ?>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                <?php echo htmlspecialchars($user_item->full_name ?: 'N/A'); ?>
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                @<?php echo htmlspecialchars($user_item->username); ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                        <?php if($user_item->role_name === 'manager'): ?>bg-yellow-100 text-yellow-800<?php endif; ?>
                                        <?php if($user_item->role_name === 'cashier'): ?>bg-green-100 text-green-800<?php endif; ?>
                                        <?php if($user_item->role_name === 'inventory_operator'): ?>bg-blue-100 text-blue-800<?php endif; ?>">
                                        <?php echo htmlspecialchars($user_item->role_display_name); ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <?php echo htmlspecialchars($user_item->email ?: 'N/A'); ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php if ($user_item->is_active): ?>
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                    <?php else: ?>
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Inactive</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?php echo $user_item->last_login ? date('M j, Y', strtotime($user_item->last_login)) : 'Never'; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <!-- Edit Button -->
                                        <a href="<?php echo base_url('manager/edit_user/' . $user_item->id); ?>" 
                                           class="text-blue-600 hover:text-blue-900 flex items-center">
                                            <i class="material-icons text-sm mr-1">edit</i>
                                            Edit
                                        </a>
                                        
                                        <!-- Toggle Status Button -->
                                        <?php if ($user_item->id != $user['user_id']): ?>
                                        <a href="<?php echo base_url('manager/toggle_user_status/' . $user_item->id); ?>" 
                                           class="text-orange-600 hover:text-orange-900 flex items-center"
                                           onclick="return confirm('Are you sure you want to <?php echo $user_item->is_active ? 'deactivate' : 'activate'; ?> this user?')">
                                            <i class="material-icons text-sm mr-1"><?php echo $user_item->is_active ? 'pause' : 'play_arrow'; ?></i>
                                            <?php echo $user_item->is_active ? 'Deactivate' : 'Activate'; ?>
                                        </a>
                                        
                                        <!-- Delete Button -->
                                        <a href="<?php echo base_url('manager/delete_user/' . $user_item->id); ?>" 
                                           class="text-red-600 hover:text-red-900 flex items-center"
                                           onclick="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
                                            <i class="material-icons text-sm mr-1">delete</i>
                                            Delete
                                        </a>
                                        <?php else: ?>
                                        <span class="text-gray-400 text-xs">(Current User)</span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                    <i class="material-icons text-4xl mb-4">people_outline</i>
                                    <p>No users found</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-8">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="material-icons text-3xl text-blue-500">people</i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Users</p>
                        <p class="text-2xl font-bold text-gray-900"><?php echo count($users); ?></p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="material-icons text-3xl text-green-500">check_circle</i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Active Users</p>
                        <p class="text-2xl font-bold text-gray-900">
                            <?php echo count(array_filter($users, function($u) { return $u->is_active; })); ?>
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="material-icons text-3xl manager-text">manage_accounts</i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Managers</p>
                        <p class="text-2xl font-bold text-gray-900">
                            <?php echo count(array_filter($users, function($u) { return $u->role_name === 'manager'; })); ?>
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="material-icons text-3xl cashier-text">point_of_sale</i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Cashiers</p>
                        <p class="text-2xl font-bold text-gray-900">
                            <?php echo count(array_filter($users, function($u) { return $u->role_name === 'cashier'; })); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>