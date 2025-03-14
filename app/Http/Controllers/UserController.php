<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::with(['role', 'division'])->paginate(10);
        return UserResource::collection($user);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with(['role', 'division'])->findOrFail($id);
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * Soft delete a user
     */
    public function destroy(string $id)
    {
        $authUser = auth()->user(); // Get the currently authenticated user
        $user = User::findOrFail($id);

        // Prevent deleting the logged-in user
        if ($authUser->id == $user->id) {
            return response()->json(['message' => 'You cannot delete your own account.'], 403);
        }

        // Perform soft delete
        $user->delete();

        return response()->json(['message' => 'User deleted successfully.']);
    }

    /**
     * Restore user from soft delete
     */
    public function restore(string $id)
    {
        $user = User::onlyTrashed()->findOrFail($id);

        if (!$user) {
            return response()->json(['message' => 'User not found or not deleted'], 404);
        }

        $user->restore(); // Restore user

        return response()->json(['message' => 'User restored successfully']);
    }

    public function getUserDetails(Request $request)
    {
        return new UserResource($request->user());
    }
}
