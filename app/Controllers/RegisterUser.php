<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UsersModel;

class RegisterUser extends BaseController
{
    private $userModel;
    public function __construct()
    {
        $this->userModel = new UsersModel();
    }
    public function save()
    {
        $fullname =  $this->request->getVar('fullnameUser');
        $email =  $this->request->getVar('emailUser');
        $phone =  $this->request->getVar('phoneUser');
        $password =  $this->request->getVar('passwordUser');

        $validationRules = [
            'fullnameUser' => 'required|is_unique[users.fullname_user]',
            'emailUser' => 'required|valid_email|is_unique[users.email_user]',
            'phoneUser' => 'required|numeric'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('errors', 'Fail to create a user, try again!');
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }
        $data = [
            'fullname_user' => $fullname,
            'username_user' => url_title($fullname, '-', true),
            'email_user' => $email,
            'phone_user' => $phone,
            'gender_user' => 'male',
            'password_user' => password_hash($password, PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d H:i:s')
        ];
        $this->userModel->save($data);
        session()->setFlashdata('success', 'new user saved successfully');
        return redirect()->to('/auth');
    }
}
