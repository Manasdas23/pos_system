<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS System - <?php echo $role; ?> Login</title>
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
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <!-- Back Button -->
            <div class="text-left">
                <a href="<?php echo base_url('auth'); ?>" class="inline-flex items-center text-dark-green hover:text-charcoal transition-colors">
                    <i class="material-icons mr-2">arrow_back</i>
                    Back to Role Selection
                </a>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-8">
                <!-- Header -->
                <div class="text-center mb-8">
                    <?php 
                    $role_colors = array(
                        'manager' => 'gold',
                        'cashier' => 'dark-green', 
                        'inventory_operator' => 'charcoal'
                    );
                    $current_role_key = isset($role_key) ? $role_key : 'manager';
                    $bg_color = isset($role_colors[$current_role_key]) ? $role_colors[$current_role_key] : 'gold';
                    ?>
                    
                    <div class="w-20 h-20 mx-auto mb-4 <?php echo $current_role_key; ?>-bg rounded-full flex items-center justify-center">
                        <?php if($current_role_key == 'manager'): ?>
                            <i class="material-icons text-charcoal" style="font-size: 40px;">manage_accounts</i>
                        <?php elseif($current_role_key == 'cashier'): ?>
                            <i class="material-icons text-white" style="font-size: 40px;">point_of_sale</i>
                        <?php else: ?>
                            <i class="material-icons text-white" style="font-size: 40px;">warehouse</i>
                        <?php endif; ?>
                    </div>
                    
                    <h2 class="text-3xl font-bold text-charcoal"><?php echo $role; ?> Login</h2>
                    <p class="text-dark-green mt-2">Enter your credentials to access the system</p>
                </div>

                <!-- Login Form -->
                <form method="POST" action="<?php echo base_url('auth/process_login'); ?>" class="space-y-6">
                    <input type="hidden" name="role" value="<?php echo $current_role_key; ?>">
                    
                    <div>
                        <label for="username" class="block text-sm font-semibold text-charcoal mb-2">
                            Username
                        </label>
                        <input 
                            type="text" 
                            id="username" 
                            name="username" 
                            required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg <?php echo $current_role_key; ?>-focus outline-none transition-colors"
                            placeholder="Enter your username"
                        >
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-semibold text-charcoal mb-2">
                            Password
                        </label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg <?php echo $current_role_key; ?>-focus outline-none transition-colors"
                            placeholder="Enter your password"
                        >
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-gray-300 text-<?php echo $bg_color; ?> focus:ring-<?php echo $bg_color; ?>">
                            <span class="ml-2 text-sm text-dark-green">Remember me</span>
                        </label>
                        <a href="#" class="text-sm <?php echo $current_role_key; ?>-text hover:underline">
                            Forgot password?
                        </a>
                    </div>

                    <button 
                        type="submit" 
                        class="w-full <?php echo $current_role_key; ?>-bg text-white py-3 px-4 rounded-lg font-semibold hover:opacity-90 transition-opacity"
                    >
                        Sign In as <?php echo $role; ?>
                    </button>
                </form>

                <!-- Additional Links -->
                <div class="mt-6 text-center">
                    <p class="text-sm text-dark-green">
                        Need help? 
                        <a href="#" class="<?php echo $current_role_key; ?>-text hover:underline font-semibold">
                            Contact Support
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>