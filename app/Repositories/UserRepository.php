<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
  public function getAll()
  {
    return User::all();
  }
  public function getById($id)
  {
    return User::findOrFail($id);
  }
  public function getByEmail($email)
  {
    return User::where("email", $email)->first();
  }
  public function store(array $data)
  {
    return User::create($data);
  }
  public function update($id, array $data)
  {
    return User::whereId( $id )->update($data);
  }
  public function delete($id)
  {
    return User::destroy($id);
  }
}
