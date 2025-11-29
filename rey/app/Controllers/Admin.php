<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ServiceModel;
use App\Models\AppointmentModel;
use App\Models\StaffModel;
use App\Models\PaymentModel;
use App\Models\SystemSettingModel;
use App\Models\NetworkLogModel;
use CodeIgniter\Controller;

class Admin extends Controller
{
    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->checkLogin();
        $this->checkAdmin();
    }

    // ====================== LOGIN & ROLE CHECK ======================
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

    // ====================== ACTIVITY LOG HELPER ======================
    private function logActivity($action)
{
    $logModel = new NetworkLogModel();

    $userId = $this->session->get('id') ?? 0; // ✅ use 'id' instead of 'user_id'
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


    // ====================== DASHBOARD ======================
    public function dashboard()
{
    $userModel = new UserModel();
    $serviceModel = new ServiceModel();
    $appointmentModel = new AppointmentModel();
    $systemModel = new SystemSettingModel();
    $logModel = new NetworkLogModel();

    $builder = $logModel->builder();
    $builder->select('network_logs.*, users.username')
            ->join('users', 'network_logs.user_id = users.id', 'left')
            ->orderBy('network_logs.created_at', 'DESC');

    $data = [
        'totalUsers'       => $userModel->countAll(),
        'totalServices'    => $serviceModel->countAll(),
        'totalAppointments'=> $appointmentModel->countAll(),
        'systemMode'       => $systemModel->getMode(),
        'networkLogs'      => $builder->get()->getResultArray()
    ];

    return view('admin/dashboard', $data);
}


    // ====================== CLEAR NETWORK LOGS ======================
    public function clearNetworkLogs()
    {
        $logModel = new NetworkLogModel();
        $logModel->where('id >', 0)->delete();
        $this->logActivity("Cleared all network logs");

        return redirect()->back()->with('success', 'All network logs cleared.');
    }

    // ====================== SYSTEM MODE TOGGLE ======================
    public function toggleSystemMode()
    {
        $model = new SystemSettingModel();
        $newMode = $model->toggleMode();

        $this->logActivity("System mode changed to: " . $newMode);

        return redirect()->to('/admin/home')
            ->with('message', 'System switched to ' . ucfirst($newMode) . ' mode.');
    }

    // ====================== MANAGE USERS ======================
    public function manageUsers()
    {
        $model = new UserModel();
        $data['users'] = $model->findAll();
        return view('admin/manage_users', $data);
    }

    public function createUser()
    {
        return view('admin/create_user');
    }

    public function storeUser()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'username' => 'required|min_length[3]|max_length[20]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]',
            'role'     => 'required|in_list[admin,user]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $model = new UserModel();
        $model->save([
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => $this->request->getPost('role'),
        ]);

        $this->logActivity("Created new user: " . $this->request->getPost('username'));

        return redirect()->to('/admin/manage-users')->with('success', 'User created successfully');
    }

    public function editUser($id)
    {
        $model = new UserModel();
        $data['user'] = $model->find($id);
        return view('admin/edit_user', $data);
    }

    public function updateUser($id)
    {
        $model = new UserModel();
        $data = [
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'role'     => $this->request->getPost('role'),
        ];

        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $model->update($id, $data);
        $this->logActivity("Updated user ID: $id");

        return redirect()->to('/admin/manage-users')->with('success', 'User updated successfully');
    }

    public function deleteUser($id)
    {
        $model = new UserModel();
        $model->delete($id);
        $this->logActivity("Deleted user ID: $id");

        return redirect()->to('/admin/manage-users')->with('success', 'User deleted successfully');
    }

    // ====================== MANAGE SERVICES ======================
    public function manageServices()
    {
        $model = new ServiceModel();
        $data['services'] = $model->findAll();
        return view('admin/manage_services', $data);
    }

    public function createService()
    {
        return view('admin/create_service');
    }

    public function storeService()
    {
        $model = new ServiceModel();
        $model->save([
            'name'        => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'price'       => $this->request->getPost('price'),
        ]);

        $this->logActivity("Created new service: " . $this->request->getPost('name'));

        return redirect()->to('/admin/manage-services')->with('success', 'Service created successfully');
    }

    public function editService($id)
    {
        $model = new ServiceModel();
        $data['service'] = $model->find($id);
        return view('admin/edit_service', $data);
    }

    public function updateService($id)
    {
        $model = new ServiceModel();
        $model->update($id, [
            'name'        => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'price'       => $this->request->getPost('price'),
        ]);

        $this->logActivity("Updated service ID: $id");

        return redirect()->to('/admin/manage-services')->with('success', 'Service updated successfully');
    }

    public function deleteService($id)
    {
        $model = new ServiceModel();
        $model->delete($id);
        $this->logActivity("Deleted service ID: $id");

        return redirect()->to('/admin/manage-services')->with('success', 'Service deleted successfully');
    }

    // ====================== MANAGE APPOINTMENTS ======================
    public function manageAppointments()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('appointments');
        $builder->select('appointments.id, appointments.appointment_date, appointments.status, users.full_name, users.email, users.phone, services.name as service_name');
        $builder->join('users', 'appointments.user_id = users.id', 'left');
        $builder->join('services', 'appointments.service_id = services.id', 'left');
        $data['appointments'] = $builder->get()->getResultArray();

        return view('admin/manage_appointments', $data);
    }

    public function viewAppointment($id)
    {
        $appointmentModel = new AppointmentModel();

        $data['appointment'] = $appointmentModel
            ->select('appointments.*, services.name as service_name, users.full_name, users.email, users.phone')
            ->join('services', 'appointments.service_id = services.id')
            ->join('users', 'appointments.user_id = users.id')
            ->where('appointments.id', $id)
            ->first();

        if (!$data['appointment']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Appointment not found');
        }

        return view('admin/view_appointment', $data);
    }

    public function updateAppointment($id)
    {
        $appointmentModel = new AppointmentModel();

        if (!$this->validate([
            'status' => 'required|in_list[pending,confirmed,completed,cancelled]',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $appointmentModel->update($id, [
            'status' => $this->request->getPost('status'),
        ]);

        $this->logActivity("Updated appointment ID: $id");

        return redirect()->to('/admin/manage-appointments')->with('success', 'Appointment updated successfully');
    }

    public function deleteAppointment($id)
    {
        $appointmentModel = new AppointmentModel();
        $appointmentModel->delete($id);

        $this->logActivity("Deleted appointment ID: $id");

        return redirect()->to('/admin/manage-appointments')->with('success', 'Appointment deleted successfully');
    }

    public function rescheduleAppointment($id)
    {
        $appointmentModel = new AppointmentModel();
        $appointment = $appointmentModel->find($id);

        if (!$appointment) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Appointment not found');
        }

        $this->logActivity("Rescheduled appointment ID: $id");

        $data['appointment'] = $appointment;
        $data['appointmentId'] = $id;

        return view('admin/reschedule_appointment', $data);
    }

    // ====================== MANAGE STAFF ======================
    public function manageStaff()
    {
        $model = new StaffModel();
        $data['staff'] = $model->findAll();
        return view('admin/manage_staff', $data);
    }

    public function createStaff()
    {
        return view('admin/create_staff');
    }

    public function storeStaff()
    {
        $model = new StaffModel();
        $model->save([
            'name'         => $this->request->getPost('name'),
            'position'     => $this->request->getPost('position'),
            'availability' => $this->request->getPost('availability'),
        ]);

        $this->logActivity("Created new staff: " . $this->request->getPost('name'));

        return redirect()->to('/admin/manage-staff')->with('success', 'Staff created successfully');
    }

    public function editStaff($id)
    {
        $model = new StaffModel();
        $data['staff'] = $model->find($id);
        return view('admin/edit_staff', $data);
    }

    public function updateStaff($id)
    {
        $model = new StaffModel();
        $model->update($id, [
            'name'         => $this->request->getPost('name'),
            'position'     => $this->request->getPost('position'),
            'availability' => $this->request->getPost('availability'),
        ]);

        $this->logActivity("Updated staff ID: $id");

        return redirect()->to('/admin/manage-staff')->with('success', 'Staff updated successfully');
    }

    public function deleteStaff($id)
    {
        $model = new StaffModel();
        $model->delete($id);

        $this->logActivity("Deleted staff ID: $id");

        return redirect()->to('/admin/manage-staff')->with('success', 'Staff deleted successfully');
    }

    // ====================== MANAGE PAYMENTS ======================
    public function managePayments()
    {
        $model = new PaymentModel();
        $data['payments'] = $model->findAll();
        return view('admin/manage_payments', $data);
    }

    public function viewPayment($id)
    {
        $model = new PaymentModel();
        $data['payment'] = $model->find($id);
        return view('admin/view_payment', $data);
    }

    public function issueRefund($id)
    {
        $model = new PaymentModel();
        $payment = $model->find($id);
        if ($payment) {
            $model->update($id, ['status' => 'refunded']);
            $this->logActivity("Refunded payment ID: $id");
        }
        return redirect()->to('/admin/manage-payments')->with('success', 'Payment refunded successfully');
    }
}
