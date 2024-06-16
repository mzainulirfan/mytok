<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UsersModel;

class Auth extends BaseController
{
    private $userModel;
    public function __construct()
    {
        $this->userModel = new UsersModel();
    }
    public function index()
    {
        $data = [
            'title' => 'login'
        ];
        return view('auth/index', $data);
    }
    public function authProcess()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $validationRules = [
            'username' => 'required',
            'password' => 'required',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }
        $user = $this->userModel->where('username_user', $username)->first();
        if (!$user) {
            session()->setFlashdata('error', 'Username not found');
            return redirect()->back()->withInput();
        }

        // Verify password
        if (!password_verify($password, $user['password_user'])) {
            session()->setFlashdata('error', 'Invalid password');
            return redirect()->back()->withInput();
        }

        // Set user session data
        $sessionData = [
            'user_id' => $user['user_id'],
            'username' => $user['username_user'],
            'fullname' => $user['fullname_user'],
            'logged_in' => true
        ];
        session()->set($sessionData);

        // Redirect to the dashboard or home page
        return redirect()->to('/');
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth');
    }
}
