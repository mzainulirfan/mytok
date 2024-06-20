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
        $addressUserId = session()->get('user_id');
        
        $validationRules = [
            'addressName' => 'required',
            'addressLine' => 'required',
            'addressPhone' => 'required|numeric',
            'addressKecamatan' => 'required',
            'addressKabupaten' => 'required',
            'addressProvency' => 'required',
            'addressPostalCode' => 'required|numeric',
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('errors', 'Fail to create new address, try again!');
            return redirect()->back()->withInput()->with('validation', $this->validator);
        };
        $data = [
            'address_name' =>  $this->request->getVar('addressName'),
            'address_line' =>  $this->request->getVar('addressLine'),
            'address_phone' =>  $this->request->getVar('addressPhone'),
            'address_kecamatan' =>  $this->request->getVar('addressKecamatan'),
            'address_kabupaten' =>  $this->request->getVar('addressKabupaten'),
            'address_province' =>  $this->request->getVar('addressProvency'),
            'address_postal_code' =>  $this->request->getVar('addressPostalCode'),
            'address_user_id' =>  $addressUserId,
            'created_at' =>  date('Y-m-d H:i:s')
        ];
        $this->addressModel->save($data);
        session()->setFlashdata('success', 'new address has been saved');
        return redirect()->to('users/' . $username . '/address');
    }
    public function editAddress($addressId)
    {
        $username =  $this->request->getVar('usernameUser');
        $currentAddressId =  $this->request->getVar('currentAddressId');
        $validationRules = [
            'addressName' => 'required',
            'addressLine' => 'required',
            'addressPhone' => 'required|numeric',
            'addressKecamatan' => 'required',
            'addressKabupaten' => 'required',
            'addressProvency' => 'required',
            'addressPostalCode' => 'required|numeric',
        ];
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('errors', 'Fail to create edit address, try again!');
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $data = [
            'address_name' =>  $this->request->getVar('addressName'),
            'address_line' =>  $this->request->getVar('addressLine'),
            'address_phone' =>  $this->request->getVar('addressPhone'),
            'address_kecamatan' =>  $this->request->getVar('addressKecamatan'),
            'address_kabupaten' =>  $this->request->getVar('addressKabupaten'),
            'address_province' =>  $this->request->getVar('addressProvency'),
            'address_postal_code' =>  $this->request->getVar('addressPostalCode'),
            'updated_at' =>  date('Y-m-d H:i:s')
        ];
        $this->addressModel->update($currentAddressId, $data);
        session()->setFlashdata('success', 'edit address has been saved');
        return redirect()->to('users/' . $username . '/address');
    }

    public function asignToMainAddress($addressId)
    {
        $userId =  $this->request->getVar('userId');
        $username =  $this->request->getVar('usernameUser');
        $isMainAddress = $this->addressModel->where('address_user_id', $userId)->where('address_is_main', 1)->first();
        $data = [
            'address_is_main' => 1
        ];
        if ($isMainAddress) {
            $this->addressModel
                ->update($isMainAddress['address_id'], ['address_is_main' => 0]);
        }
        $this->addressModel
            ->update($addressId, ['address_is_main' => 1]);

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
