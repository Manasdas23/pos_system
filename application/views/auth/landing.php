<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS System - Select Your Role</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
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
        <div class="max-w-4xl w-full space-y-8">
            <!-- Header -->
            <div class="text-center">
                <h1 class="text-4xl font-bold text-charcoal mb-2">Point of Sales System</h1>
                <p class="text-lg text-dark-green">Please select your role to continue</p>
            </div>

            <!-- Role Selection Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
                <!-- Manager Card -->
                <a href="<?php echo base_url('auth/login/manager'); ?>" class="role-card block">
                    <div
                        class="bg-white rounded-xl shadow-lg p-8 text-center  flex justify-between flex-col h-full border-2 border-transparent hover:border-gold">
                        <div class="w-24 h-24 mx-auto mb-6 bg-gold rounded-full flex items-center justify-center">
                            <i class="material-icons text-charcoal" style="font-size: 48px;">manage_accounts</i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-semibold text-charcoal mb-3">Manager</h3>
                            <p class="text-dark-green text-sm leading-6">
                                Access to all system features including reports,
                                user management, and system configuration.
                            </p>
                        </div>

                        <div
                            class="mt-6 bg-gold text-charcoal py-3 px-6 rounded-lg font-semibold hover:bg-opacity-90 transition-colors">
                            Login as Manager
                        </div>
                    </div>
                </a>

                <!-- Cashier Card -->
                <a href="<?php echo base_url('auth/login/cashier'); ?>" class="role-card block">
                    <div
                        class="bg-white rounded-xl shadow-lg p-8 text-center flex justify-between flex-col h-full border-2 border-transparent hover:border-gold">
                        <div class="w-24 h-24 mx-auto mb-6 bg-dark-green rounded-full flex items-center justify-center">
                            <i class="material-icons text-white" style="font-size: 48px;">point_of_sale</i>
                        </div>

                        <div>
                            <h3 class="text-2xl font-semibold text-charcoal mb-3">Cashier</h3>
                            <p class="text-dark-green text-sm leading-6">
                                Process sales transactions, handle payments,
                                and manage customer interactions at the point of sale.
                            </p>
                        </div>

                        <div
                            class="mt-6 bg-dark-green text-white py-3 px-6 rounded-lg font-semibold hover:bg-opacity-90 transition-colors">
                            Login as Cashier
                        </div>
                    </div>
                </a>

                <!-- Inventory Operator Card -->
                <a href="<?php echo base_url('auth/login/inventory_operator'); ?>" class="role-card block">
                    <div
                        class="bg-white rounded-xl shadow-lg p-8 text-center flex justify-between flex-col h-full border-2 border-transparent hover:border-gold">
                        <div class="w-24 h-24 mx-auto mb-6 bg-charcoal rounded-full flex items-center justify-center">
                            <i class="material-icons text-white" style="font-size: 48px;">warehouse</i>
                        </div>
                        <div>

                            <h3 class="text-2xl font-semibold text-charcoal mb-3">Inventory Operator</h3>
                            <p class="text-dark-green text-sm leading-6">
                                Manage product inventory, track stock levels,
                                and handle product information updates.
                            </p>
                        </div>
                        <div
                            class="mt-6 bg-charcoal text-white py-3 px-6 rounded-lg font-semibold hover:bg-opacity-90 transition-colors">
                            Login as Operator
                        </div>
                    </div>
                </a>
            </div>

            <!-- Footer -->
            <div class="text-center mt-12">
                <p class="text-dark-green text-sm">
                    © 2025 POS System. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</body>

</html>