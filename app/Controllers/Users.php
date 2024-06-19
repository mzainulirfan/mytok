<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UsersModel;
use App\Models\ordersModel;
use App\Models\AddressModel;
use App\Models\UserAddressModel;

class Users extends BaseController
{
    private $userModel;
    private $orderModel;
    private $addressModel;
    private $userAddressModel;
    public function __construct()
    {
        $this->userModel = new UsersModel();
        $this->orderModel = new OrdersModel();
        $this->addressModel = new AddressModel();
        $this->userAddressModel = new UserAddressModel();
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
        $gender =  $this->request->getVar('genderUser');
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
            'gender_user' => $gender,
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
        return view('users/orders', $data);
    }
    public function updateUser($userId)
    {
        $newFullname =  $this->request->getVar('fullnameUser');
        $username =  $this->request->getVar('usernameUser');
        $newEmail =  $this->request->getVar('emailUser');
        $gender =  $this->request->getVar('genderUser');
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
            'gender_user' => $gender,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $this->userModel->update($userId, $data);
        session()->setFlashdata('success', 'user has been update successfully');
        return redirect()->to('users/' . $username . '/detail');
    }
    public function changeUsername($userId)
    {
        $currentUsername =  $this->request->getVar('usernameUser');
        $newUsername =  $this->request->getVar('newUsername');

        $usernameRules = ($currentUsername == $newUsername) ? 'required' : 'required|is_unique[users.username_user]';
        $validationRules = [
            'newUsername' => $usernameRules
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('errors', 'Fail to change username user, try again!');
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }
        $data = [
            'username_user' => $newUsername,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $this->userModel->update($userId, $data);
        session()->setFlashdata('success', 'username user has been update successfully');
        return redirect()->to('users/' . $newUsername . '/detail');
    }

    public function resetPassword($userId)
    {
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
        $username = $this->request->getVar('usernameUser');

        $validationRule = [
            'photoUser' => [
                'label' => 'Image File',
                'rules' => 'uploaded[photoUser]'
                    . '|is_image[photoUser]'
                    . '|mime_in[photoUser,image/jpg,image/jpeg,image/gif,image/png]'
                    . '|max_size[photoUser,1024]',
            ],
        ];

        if (!$this->validate($validationRule)) {
            session()->setFlashdata('errors', 'Fail to change username user, try again!');
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }
        $user = $this->userModel->find($userId);
        $currentPhotoUser = $user['photo_user'];

        if ($currentPhotoUser != null) {
            $currentTargetDirectory = FCPATH . 'dist/img/profile/';
            unlink($currentTargetDirectory . $currentPhotoUser);
        }

        $fileName = $username . '-' . $photoUser->getRandomName();

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
        $user = $this->userModel->find($userId);
        $photoUser = $user['photo_user'];

        if ($photoUser != 'default.png') {
            $targetDirectory = FCPATH . 'dist/img/profile/';
            unlink($targetDirectory . $photoUser);
        }

        $this->userModel->delete($userId);
        session()->setFlashdata('success', 'delete user has been successfully');
        return redirect()->to('/users');
    }

    public function detailUserOrder($username)
    {
        $user = $this->userModel->where('username_user', $username)->first();
        $userId = $user['user_id'];
        $orders = $this->orderModel->where('order_user_id', $userId)->get()->getResultArray();
        $data = [
            'title' => 'Orders',
            'orders' => $orders,
            'user' => $user,
        ];
        return view('users/orders', $data);
    }
    public function detailUserAddress($username)
    {
        $user = $this->userModel->where('username_user', $username)->first();
        $userId = $user['user_id'];
        $address = $this->addressModel->where('address_user_id', $userId)->findAll();
        // $isMainAddress = $this->userAddressModel->where('user_address_user_id', $userId); //lanjutkan
        $data = [
            'title' => 'Addresses',
            'addresses' => $address,
            'user' => $user,
            // 'isMainAddress' => $isMainAddress
        ];
        return view('addresses/index', $data);
    }
}
