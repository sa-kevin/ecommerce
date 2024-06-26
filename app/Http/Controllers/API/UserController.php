<?php

namespace App\Http\Controllers\API;

use App\Classes\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepositoryInterface;

    // dependency injection
    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepositoryInterface = $userRepositoryInterface;
    }
    public function index()
    {
        $data = $this->userRepositoryInterface->getAll();
        return ApiResponseHelper::sendResponse(UserResource::collection($data), '', 200);
    }
    public function show(string $id)
    {
        $user = $this->userRepositoryInterface->getById($id);
        return ApiResponseHelper::sendResponse(UserResource::collection($user),'', 200);
    }
    public function store(StoreUserRequest $request)
    {
        $data = [
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
        ];
        DB::beginTransaction();
        try {
            $user = $this->userRepositoryInterface->store($data);
            DB::commit();
            return ApiResponseHelper::sendResponse(new UserResource($user),'Record create succesfully',200);
        } catch (\Exception $ex) {
            DB::rollBack();
            return ApiResponseHelper::rollback($ex);
        }
    }


    public function update(UpdateUserRequest $request, $id)
    {
        $data = [
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
        ];
        DB::beginTransaction();
        try {
            $this->userRepositoryInterface->update($data, $id);
            DB::commit();
            return ApiResponseHelper::sendResponse(null,'Record updated succesfully',200);
        } catch (\Exception $ex) {
            DB::rollBack();
            return ApiResponseHelper::rollback($ex);
        }
    }

    public function destroy($id)
    {
        $this->userRepositoryInterface->delete($id);
        return ApiResponseHelper::sendResponse(null,'Record deleted succesfully',200);
    }
}
