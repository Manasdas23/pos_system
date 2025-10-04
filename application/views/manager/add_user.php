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
                    <a href="<?php echo base_url('manager/users'); ?>" class="flex items-center text-charcoal hover:text-gray-700 mr-6">
                        <i class="material-icons mr-2">arrow_back</i>
                        <span class="font-semibold">Back to Users</span>
                    </a>
                    <i class="material-icons text-charcoal text-3xl mr-3">person_add</i>
                    <h1 class="text-2xl font-bold text-charcoal">Add New User</h1>
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
    <div class="max-w-3xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-lg p-8">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-charcoal mb-2">Create New User Account</h2>
                <p class="text-gray-600">Fill in the details to create a new user account for the POS system.</p>
            </div>

            <form method="POST" action="<?php echo base_url('manager/add_user'); ?>" class="space-y-6">
                <!-- Basic Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Username -->
                    <div>
                        <label for="username" class="block text-sm font-semibold text-charcoal mb-2">
                            Username <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="username" 
                            name="username" 
                            required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold focus:border-transparent outline-none transition-colors"
                            placeholder="Enter username"
                        >
                    </div>

                    <!-- Full Name -->
                    <div>
                        <label for="full_name" class="block text-sm font-semibold text-charcoal mb-2">
                            Full Name
                        </label>
                        <input 
                            type="text" 
                            id="full_name" 
                            name="full_name" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold focus:border-transparent outline-none transition-colors"
                            placeholder="Enter full name"
                        >
                    </div>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-charcoal mb-2">
                        Email Address
                    </label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold focus:border-transparent outline-none transition-colors"
                        placeholder="Enter email address"
                    >
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-charcoal mb-2">
                        Password <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            required 
                            class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold focus:border-transparent outline-none transition-colors"
                            placeholder="Enter password"
                        >
                        <button 
                            type="button" 
                            id="togglePassword" 
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-gray-700 focus:outline-none"
                            onclick="togglePasswordVisibility()"
                        >
                            <i class="material-icons" id="passwordIcon">visibility</i>
                        </button>
                    </div>
                </div>

                <!-- Role Selection -->
                <div>
                    <label for="role_id" class="block text-sm font-semibold text-charcoal mb-2">
                        User Role <span class="text-red-500">*</span>
                    </label>
                    <select 
                        id="role_id" 
                        name="role_id" 
                        required 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold focus:border-transparent outline-none transition-colors"
                    >
                        <option value="">Select a role</option>
                        <?php if (!empty($roles)): ?>
                            <?php foreach ($roles as $role): ?>
                            <option value="<?php echo $role->id; ?>">
                                <?php echo htmlspecialchars($role->display_name); ?>
                            </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <!-- User Status -->
                <div>
                    <label class="flex items-center">
                        <input 
                            type="checkbox" 
                            name="is_active" 
                            value="1" 
                            checked 
                            class="rounded border-gray-300 text-gold focus:ring-gold focus:ring-2"
                        >
                        <span class="ml-2 text-sm font-semibold text-charcoal">Active User</span>
                    </label>
                    <p class="text-xs text-gray-500 mt-1">Uncheck to create an inactive user account</p>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="<?php echo base_url('manager/users'); ?>" 
                       class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 font-semibold hover:bg-gray-50 transition-colors">
                        Cancel
                    </a>
                    <button 
                        type="submit" 
                        class="manager-bg text-charcoal px-6 py-3 rounded-lg font-semibold hover:bg-opacity-90 transition-colors flex items-center"
                    >
                        <i class="material-icons mr-2">person_add</i>
                        Create User
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const passwordIcon = document.getElementById('passwordIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.textContent = 'visibility_off';
            } else {
                passwordInput.type = 'password';
                passwordIcon.textContent = 'visibility';
            }
        }

        // Add keyboard support for eye icon
        document.getElementById('togglePassword').addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                togglePasswordVisibility();
            }
        });
    </script>
</body>
</html>