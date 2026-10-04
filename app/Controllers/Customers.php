<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Customers extends BaseController
{
    protected CustomerModel $customerModel;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->customerModel = new CustomerModel();
    }

    public function index()
    {
        return view('customers/index', [
            'customers' => $this->customerModel->findAll(),
        ]);
    }

    public function new()
    {
        return view('customers/new');
    }

    public function create()
    {
        $rules = [
            'full_name' => [
                'label' => 'Full name',
                'rules' => 'required|min_length[2]|max_length[100]',
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|max_length[150]|is_unique[customers.email]',
            ],
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $data = $this->validator->getValidated();

        $this->customerModel->insert([
            'full_name' => trim($data['full_name']),
            'email'     => strtolower(trim($data['email'])),
        ]);

        return redirect()
            ->to('/customers')
            ->with('success', 'Customer added successfully.');
    }

    public function edit(int $id)
    {
        $customer = $this->customerModel->find($id);

        if (! $customer) {
            throw PageNotFoundException::forPageNotFound(
                'Customer record not found.'
            );
        }

        return view('customers/edit', [
            'customer' => $customer,
        ]);
    }

    public function update(int $id)
    {
        $customer = $this->customerModel->find($id);

        if (! $customer) {
            throw PageNotFoundException::forPageNotFound(
                'Customer record not found.'
            );
        }

        $rules = [
            'full_name' => [
                'label' => 'Full name',
                'rules' => 'required|min_length[2]|max_length[100]',
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|max_length[150]'
                    . '|is_unique[customers.email,id,' . $id . ']',
            ],
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $data = $this->validator->getValidated();

        $this->customerModel->update($id, [
            'full_name' => trim($data['full_name']),
            'email'     => strtolower(trim($data['email'])),
        ]);

        return redirect()
            ->to('/customers')
            ->with('success', 'Customer updated successfully.');
    }
}