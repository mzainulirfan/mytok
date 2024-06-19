<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AddressModel;

class Addresses extends BaseController
{
    private $addressModel;
    public function __construct()
    {
        $this->addressModel = new AddressModel();
    }
    public function save()
    {
        $username =  $this->request->getVar('usernameUser');
        $data = [
            'address_name' =>  $this->request->getVar('addressName'),
            'address_line' =>  $this->request->getVar('addressLine'),
            'address_phone' =>  $this->request->getVar('addressPhone'),
            'address_kecamatan' =>  $this->request->getVar('addressKecamatan'),
            'address_kabupaten' =>  $this->request->getVar('addressKabupaten'),
            'address_province' =>  $this->request->getVar('addressProvency'),
            'address_postal_code' =>  $this->request->getVar('addressPostalCode'),
            'created_at' =>  date('Y-m-d H:i:s')
        ];
        $this->addressModel->save($data);
        session()->setFlashdata('success', 'new address has been saved');
        return redirect()->to('users/' . $username . '/address');
    }
    public function deleteAddress($addressId)
    {
        $username =  $this->request->getVar('usernameUser');
        $this->addressModel->delete($addressId);
        session()->setFlashdata('success', 'delete address has been successfully');
        return redirect()->to('users/' . $username . '/address');
    }
}
