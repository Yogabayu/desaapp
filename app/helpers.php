<?php

if (!function_exists('breadcrumb_name')) {
    function breadcrumb_name($name)
    {
        $customNames = [
            'admin' => 'Admin',
            'dashboard' => 'Dashboard',
            'profile' => 'Profile',
            'login' => 'Login',
            'galeri' => 'Galeri',
            'article' => 'Article',
            // Tambahkan custom nama lainnya sesuai kebutuhan
        ];

        return $customNames[$name] ?? ucfirst($name);
    }
}