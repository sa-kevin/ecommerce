<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function getAll();
    public function getById($id);
    public function getByEmail($email);
    public function store(array $data);
    public function update(array $data, $id);
    public function delete($id);

}
