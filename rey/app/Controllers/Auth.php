<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\NetworkLogModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    // ====================== LOGIN VIEW ======================
    public function login()
    {
        return view('auth/login');
    }

    // ====================== REGISTER VIEW ======================
    public function register()
    {
        return view('auth/register');
    }

    // ====================== LOGIN ATTEMPT ======================
    public function attemptLogin()
    {
        $model = new UserModel();
        $logModel = new NetworkLogModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model->where('email', $email)->first();

        $ipAddress = $this->request->getIPAddress();
        $macAddress = exec('getmac');
        $macAddress = explode(' ', $macAddress)[0] ?? 'unknown';

        if ($user && password_verify($password, $user['password'])) {
            session()->set([
                'id'       => $user['id'],
                'username' => $user['username'],
                'email'    => $user['email'],
                'role'     => $user['role'],
                'logged_in'=> true
            ]);

            $logModel->save([
                'user_id'     => $user['id'],
                'action'      => 'Logged in successfully',
                'ip_address'  => $ipAddress,
                'mac_address' => $macAddress
            ]);

            return $user['role'] === 'admin' 
                ? redirect()->to('/admin/dashboard') 
                : redirect()->to('/user/dashboard');
        }

        // Failed login
        $logModel->save([
            'user_id'     => 0,
            'action'      => 'Failed login attempt for email: ' . $email,
            'ip_address'  => $ipAddress,
            'mac_address' => $macAddress
        ]);

        return redirect()->back()->with('error', 'Invalid email or password');
    }

    // ====================== REGISTER ATTEMPT ======================
    public function attemptRegister()
    {
        $validation = \Config\Services::validation();
        $logModel = new NetworkLogModel();

        $validation->setRules([
            'username' => 'required|min_length[3]|max_length[50]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]',
            'role'     => 'required|in_list[user,admin]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()
                             ->with('errors', $validation->getErrors());
        }

        $model = new UserModel();

        $userData = [
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'), // raw password
            'role'     => $this->request->getPost('role'),
        ];

        $model->save($userData);

        $newUserId = $model->getInsertID();
        $ipAddress = $this->request->getIPAddress();
        $macAddress = exec('getmac');
        $macAddress = explode(' ', $macAddress)[0] ?? 'unknown';

        $logModel->save([
            'user_id'     => $newUserId,
            'action'      => 'Registered new account',
            'ip_address'  => $ipAddress,
            'mac_address' => $macAddress
        ]);

        return redirect()->to('/login')
                         ->with('success', 'Registration successful. You can now log in.');
    }

    // ====================== LOGOUT ======================
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'You have been logged out.');
    }
}
