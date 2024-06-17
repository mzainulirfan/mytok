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
    public function updateUser($userId)
    {
        $newFullname =  $this->request->getVar('fullnameUser');
        $username =  $this->request->getVar('usernameUser');
        $newEmail =  $this->request->getVar('emailUser');
        $phone =  $this->request->getVar('phoneUser');

        $user = $this->userModel->find($userId);
        $currentFullname = $user['fullname_user'];
        $currentEmail = $user['email_user'];

        $fullnameRules = ($newFullname == $currentFullname) ? 'required' : 'required|is_unique[users.fullname_user]';
        $emailRules = ($newEmail == $currentEmail) ? 'required' : 'required|is_unique[users.email_user]';

        $validationRules = [
            'fullnameUser' => $fullnameRules,
            'emailUser' => $emailRules,
            'phoneUser' => 'required|numeric'
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('errors', 'Fail to create a user, try again!');
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $data = [
            'user_id' => $userId,
            'fullname_user' => $newFullname,
            'email_user' => $newEmail,
            'phone_user' => $phone,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $this->userModel->update($userId, $data);
        session()->setFlashdata('success', 'user has been update successfully');
        return redirect()->to('users/' . $username . '/detail');
    }

    public function resetPassword($userId)
    {
        $userId = $userId;
        $newPassword =  $this->request->getVar('newPasswordUser');
        $username =  $this->request->getVar('usernameUser');
        $validationRules = [
            'newPasswordUser' => 'required'
        ];
        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }
        $data = [
            'user_id' => $userId,
            'password_user' => password_hash($newPassword, PASSWORD_DEFAULT),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $this->userModel->update($userId, $data);
        session()->setFlashdata('success', 'user has been update successfully');
        return redirect()->to('users/' . $username . '/detail');
    }
    public function uploadPhotoUser($userId)
    {
        $photoUser = $this->request->getFile('photoUser');
        $userId = $this->request->getVar('userId');
        $username = $this->request->getVar('usernameUser');
        $fileName = $photoUser->getName();
        $validationRule = [
            'photoUser' => [
                'label' => 'Image File',
                'rules' => 'uploaded[photoUser]'
                . '|is_image[photoUser]'
                . '|mime_in[photoUser,image/jpg,image/jpeg,image/gif,image/png]'
                . '|max_size[photoUser,1024]', // Max size 1MB
            ],
        ];

        if (!$this->validate($validationRule)) {
            $data['validation'] = $this->validator;
            return view('upload_form', $data);
        }
        $targetDirectory = FCPATH . 'dist/img/profile';
        $photoUser->move($targetDirectory, $fileName);

        $data = [
            'photo_user' => $fileName,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $this->userModel->update($userId, $data);
        return redirect()->to('users/' . $username . '/detail');
    }
    
    public function deleteUser($userId)
    {
        $this->userModel->delete($userId);
        session()->setFlashdata('success', 'delete user has been successfully');
        return redirect()->to('/users');
    }
}
