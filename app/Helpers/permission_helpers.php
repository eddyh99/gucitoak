<?php

if (!function_exists('hasPermission')) {
    /**
     * Check if the logged-in user has permission for a specific menu and action
     *
     * @param string $permission The permission to check (e.g., 'view', 'edit')
     * @param string $menu The menu key (e.g., 'laporan')
     * @return bool
     */
    function hasPermission(string $permission, string $menu): bool
    {
        $session = session()->get('logged_user');
        if ($session['role'] === 'admin') return true;
        $akses = $session['akses'] ?? [];

        // Check if the menu exists and contains the specific permission
        return isset($akses->$menu) && in_array($permission, $akses->$menu);
    }
}
