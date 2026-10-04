<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\Images\Exceptions\ImageException;

class Users extends BaseController
{
    protected UserModel $userModel;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->userModel = new UserModel();
    }

    public function index()
    {
        return view('users/index', ['users' => $this->userModel->orderBy('id', 'DESC')->findAll()]);
    }

    public function new()
    {
        return view('users/new');
    }

    public function create()
    {
        $rules = [
            'username' => 'required|min_length[4]|max_length[30]|alpha_numeric_punct|is_unique[users.username]',
            'full_name' => 'required|min_length[2]|max_length[100]',
            'password' => 'required|min_length[8]|max_length[255]',
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $data = $this->validator->getValidated();
        $this->userModel->insert([
            'username'  => trim($data['username']),
            'full_name' => trim($data['full_name']),
            'password'  => password_hash($data['password'], PASSWORD_DEFAULT),
            'avatar'    => null,
        ]);
        return redirect()->to('/users')->with('success', 'User added successfully.');
    }

    public function edit(int $id)
    {
        $user = $this->userModel->find($id);
        if (! $user) {
            throw PageNotFoundException::forPageNotFound('User account not found.');
        }
        return view('users/edit', ['user' => $user]);
    }

    public function update(int $id)
    {
        $user = $this->userModel->find($id);
        if (! $user) {
            throw PageNotFoundException::forPageNotFound('User account not found.');
        }

        $avatar = $this->request->getFile('avatar');
        $hasNewAvatar = $avatar !== null && $avatar->getError() !== UPLOAD_ERR_NO_FILE;
        $rules = [
            'username' => 'required|min_length[4]|max_length[30]|alpha_numeric_punct|is_unique[users.username,id,' . $id . ']',
            'full_name' => 'required|min_length[2]|max_length[100]',
            'password' => 'permit_empty|min_length[8]|max_length[255]',
        ];
        if ($hasNewAvatar) {
            $rules['avatar'] = ['uploaded[avatar]', 'is_image[avatar]', 'mime_in[avatar,image/jpeg,image/png]', 'ext_in[avatar,jpg,jpeg,png]', 'max_size[avatar,2048]'];
        }
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $validated = $this->validator->getValidated();
        $updateData = [
            'username'  => trim($validated['username']),
            'full_name' => trim($validated['full_name']),
        ];
        if (! empty($validated['password'])) {
            $updateData['password'] = password_hash($validated['password'], PASSWORD_DEFAULT);
        }
        if ($hasNewAvatar && $avatar->isValid() && ! $avatar->hasMoved()) {
            $uploadDirectory = FCPATH . 'uploads/avatars/';
            if (! is_dir($uploadDirectory)) {
                mkdir($uploadDirectory, 0775, true);
            }
            $randomName = $avatar->getRandomName();
            $extension = strtolower(pathinfo($randomName, PATHINFO_EXTENSION));
            $temporaryName = 'temp_' . $randomName;
            $finalName = pathinfo($randomName, PATHINFO_FILENAME) . '.' . $extension;
            $avatar->move($uploadDirectory, $temporaryName);
            $temporaryPath = $uploadDirectory . $temporaryName;
            $finalPath = $uploadDirectory . $finalName;
            try {
                service('image')->withFile($temporaryPath)->fit(300, 300, 'center')->save($finalPath);
                if (is_file($temporaryPath)) {
                    unlink($temporaryPath);
                }
                if (! empty($user['avatar']) && is_file($uploadDirectory . $user['avatar'])) {
                    unlink($uploadDirectory . $user['avatar']);
                }
                $updateData['avatar'] = $finalName;
            } catch (ImageException $exception) {
                if (is_file($temporaryPath)) {
                    unlink($temporaryPath);
                }
                return redirect()->back()->withInput()->with('errors', ['avatar' => 'The profile picture could not be processed.']);
            }
        }
        $this->userModel->update($id, $updateData);
        return redirect()->to('/users')->with('success', 'User updated successfully.');
    }
}
