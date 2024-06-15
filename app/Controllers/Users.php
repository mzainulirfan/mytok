<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UsersModel;
use App\Models\ordersModel;

class Users extends BaseController
{
    private $userModel;
    private $orderModel;
    public function __construct()
    {
        $this->userModel = new UsersModel();
        $this->orderModel = new OrdersModel();
    }
    public function index()
    {
        $users = $this->userModel->findAll();
        $data = [
            'title' => 'user',
            'users' => $users
        ];
        return view('users/index', $data);
    }
    public function save()
    {
        $fullname =  $this->request->getVar('fullnameUser');
        $email =  $this->request->getVar('emailUser');
        $phone =  $this->request->getVar('phoneUser');
        $password =  $this->request->getVar('passwordUser');

        $valiationRules = [
            'fullnameUser' => 'required|is_unique[users.fullname_user]',
            'emailUser' => 'required|valid_email',
            'phoneUser' => 'required|numeric'
        ];
        if (!$this->validate($valiationRules)) {
            session()->setFlashdata('errors', 'Fail to create a user, try again!');
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }
        $data = [
            'fullname_user' => $fullname,
            'username_user' => url_title($fullname, '-', true),
            'email_user' => $email,
            'phone_user' => $phone,
            'password_user' => password_hash($password, PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d H:i:s')
        ];
        $this->userModel->save($data);
        session()->setFlashdata('success', 'new user saved successfully');
        return redirect()->to('/users');
    }
    public function detailUser($username)
    {
        $user = $this->userModel->where('username_user', $username)->first();
        $userId = $user['user_id'];
        $orders = $this->orderModel->where('order_user_id', $userId)->get()->getResultArray();
        $data = [
            'title' => $user['fullname_user'],
            'orders' => $orders,
            'user' => $user
        ];
        return view('users/detail', $data);
    }
}
