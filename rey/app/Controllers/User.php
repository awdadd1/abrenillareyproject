<?php

namespace App\Controllers;

use App\Models\ServiceModel;
use App\Models\AppointmentModel;
use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Controllers\BaseController; // Add this import
// After
class User extends BaseController
{
    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->checkLogin();
        $this->checkUser();
    }

    /**
     * Check if the user is logged in.
     */
    protected function checkLogin()
    {
        if (!$this->session->get('logged_in')) {
            return redirect()->to('/login');
        }
    }

    /**
     * Check if the logged-in user is a regular user.
     */
    protected function checkUser()
    {
        if ($this->session->get('role') !== 'user') {
            return redirect()->to('/admin/dashboard');
        }
    }

    public function dashboard()
    {
        return view('user/dashboard');
    }

    public function profile()
    {
        $userModel = new UserModel();
        $user = $userModel->find($this->session->get('id'));

        return view('user/profile', ['user' => $user]);
    }

    public function updateProfile()
    {
        $userModel = new UserModel();
        
        $data = [
            'full_name' => $this->request->getPost('full_name'),
            'email'     => $this->request->getPost('email'),
            'phone'     => $this->request->getPost('phone'),
            'address'   => $this->request->getPost('address'),
            'age'       => $this->request->getPost('age')
        ];

        if (!$userModel->update($this->session->get('id'), $data)) {
            return redirect()->back()->with('error', 'Failed to update profile');
        }

        $this->logActivity("Updated profile"); // ✅ Activity log

        return redirect()->to('/user/profile')->with('success', 'Profile updated successfully');
    }

    public function browseServices()
    {
        $model = new ServiceModel();
        $data['services'] = $model->findAll();
        return view('user/browse_services', $data);
    }

    public function bookAppointment()
    {
        $appointmentModel = new AppointmentModel();

        $data = [
            'user_id'          => $this->session->get('id'),
            'service_id'       => $this->request->getPost('service_id'),
            'full_name'        => $this->request->getPost('full_name'),
            'email'            => $this->request->getPost('email'),
            'phone'            => $this->request->getPost('phone'),
            'appointment_date' => $this->request->getPost('appointment_date'),
            'status'           => 'booked'
        ];

        if (!$appointmentModel->save($data)) {
            $errors = $appointmentModel->errors();
            return redirect()->back()->with('error', 'Failed to book appointment: ' . implode(', ', $errors));
        }

        $this->logActivity("Booked appointment for service ID: " . $data['service_id']); // ✅ Activity log

        return redirect()->to('/user/view-appointments');
    }

    public function viewAppointments()
    {
        $model = new AppointmentModel();

        $data['appointments'] = $model->where('appointments.user_id', $this->session->get('id'))
            ->select('appointments.id, appointments.appointment_date, appointments.status, services.name as service_name, users.full_name, users.email, users.phone')
            ->join('services', 'appointments.service_id = services.id')
            ->join('users', 'appointments.user_id = users.id')
            ->findAll();

        return view('user/view_appointments', $data);
    }

    public function rescheduleAppointment($id)
    {
        $appointmentModel = new AppointmentModel();
        $appointment = $appointmentModel->find($id);

        if (!$appointment) {
            return redirect()->back()->with('error', 'Appointment not found.');
        }

        return view('user/reschedule_appointment', [
            'appointmentId' => $id,
            'appointment'   => $appointment
        ]);
    }

    public function updateAppointment($id)
    {
        $model = new AppointmentModel();
        $model->update($id, [
            'appointment_date' => $this->request->getPost('new_date'),
            'status'           => 'rescheduled'
        ]);

        $this->logActivity("Rescheduled appointment ID: $id"); // ✅ Activity log

        return redirect()->to('/user/view-appointments');
    }

    public function cancelAppointment($id)
    {
        $model = new AppointmentModel();
        $model->delete($id);

        $this->logActivity("Cancelled appointment ID: $id"); // ✅ Activity log

        return redirect()->to('/user/view-appointments');
    }

    public function logout()
    {
        $this->logActivity("Logged out"); // ✅ Activity log
        $this->session->destroy();
        return redirect()->to('/login');
    }
}
