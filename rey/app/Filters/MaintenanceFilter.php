<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\SystemSettingModel;

class MaintenanceFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // Get system mode
        $model = new SystemSettingModel();
        $mode = $model->getMode();

        $isLoggedIn = $session->get('logged_in') ?? false;
        $isAdmin = $session->get('role') === 'admin';

        // Only redirect non-admin logged-in users if system is in maintenance
        if ($mode === 'maintenance' && $isLoggedIn && !$isAdmin) {
            // Prevent filter from affecting login, register, or landing page
            $uri = $request->getUri()->getPath();
            if (!str_starts_with($uri, 'login') && !str_starts_with($uri, 'register') && !str_starts_with($uri, 'admin')) {
                return redirect()->to('/maintenance');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // nothing
    }
}
