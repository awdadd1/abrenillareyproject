<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use Config\Services;
use App\Models\NetworkLogModel;

abstract class BaseController extends Controller
{
    protected $request;
    protected $session;
    protected $helpers = [];

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload session service
        $this->session = Services::session();
    }

    protected function checkLogin()
    {
        if (!$this->session->get('logged_in')) {
            return redirect()->to('/login');
        }
    }

    protected function checkAdmin()
    {
        if ($this->session->get('role') !== 'admin') {
            return redirect()->to('/user/dashboard');
        }
    }

    protected function checkUser()
    {
        if ($this->session->get('role') !== 'user') {
            return redirect()->to('/admin/dashboard');
        }
    }

    /**
     * Log activity for the current user.
     *
     * @param string $action Description of the activity.
     */
    protected function logActivity(string $action)
    {
        $logModel = new NetworkLogModel();

        $userId = $this->session->get('id') ?? 0;
        $ipAddress = $this->request->getIPAddress();
        $macAddress = exec('getmac');
        $macAddress = explode(' ', $macAddress)[0] ?? 'unknown';

        $logModel->save([
            'user_id'     => $userId,
            'action'      => $action,
            'ip_address'  => $ipAddress,
            'mac_address' => $macAddress
        ]);
    }
}
