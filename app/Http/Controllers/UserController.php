<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(private readonly UserService $userService) {}

    public function index(): JsonResponse
    {
        return response()->json($this->userService->paginate());
    }

    public function show(int $id): JsonResponse
    {
        return response()->json($this->userService->findOrFail($id));
    }

    public function store(Request $request): JsonResponse
    {
        $user = $this->userService->create($request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
        ]));

        return response()->json($user, 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $user = $this->userService->update($id, $request->validate([
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'email' => ['sometimes', 'required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,'.$id],
            'password' => ['sometimes', 'required', 'string', 'min:8'],
        ]));

        return response()->json($user);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->userService->delete($id);

        return response()->json(status: 204);
    }
}
