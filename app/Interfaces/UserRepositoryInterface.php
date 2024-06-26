<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function getAll();
    public function findById($id);
    public function findByEmail($email);
    public function store(array $data);
    public function update($id, array $data);
    public function delete($id);

}
