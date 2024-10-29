<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $page = $request->page ?? 1;
        $rows = $request->rows ?? 10;

        $offset = ($page - 1) * $rows;

        $query = User::query()->filter([
            'search' => $request->search,
        ]);

        $total = $query->count();

        $users = $query->offset($offset)->limit($rows)->get();

        return response()->json([
            'total' => $total,
            'rows'  => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        $password = $request->password ? Hash::make($request->password) : Hash::make('password');

        $user = User::create([
            ...$request->validated(),
            'password' => $password,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'data'    => $user,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $password = $request->password ? Hash::make($request->password) : $user->password;

        $user->update([
            ...$request->validated(),
            'password' => $password,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User updated successfully',
            'data'    => $user,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): JsonResponse
    {
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully',
        ]);
    }
}
