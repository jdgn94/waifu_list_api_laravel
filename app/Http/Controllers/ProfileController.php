<?php

namespace App\Http\Controllers;

use App\Http\Utils\UserUtils;
use App\Models\Profile;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function __construct(
        private UserUtils $userUtils
    ) {
    }

    public function index()
    {
    }

    public function show(int $id)
    {
        try {
            $profile = Profile::find($id);
            if (!$profile) {
                return response()->json(["message" => "Profile not found"], 404);
            }

            return response()->json(["message" => "user profile", "data" => $profile], 200);
        } catch (\Throwable $th) {
            return response()->json(["message" => "error on get user profile", "errors" => $th->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique',
            'telegram_id' => 'required|string|max:255|unique',
        ]);

        if ($validator->fails()) {
            return response()->json(["message" => "error on create user profile", "errors" => $validator->errors()], 422);
        }

        Log::info("Creating user");
        Log::info($request->all());

        return response()->json(["message" => "Testing function to create profile"], 200);
        try {
            DB::beginTransaction();
            $new_user = $this->userUtils->create($request->name, $request->username, Hash::make($request->password));

            Profile::create([
                'user_id' => $new_user->id,
                'telegram_id' => $request->telegram_id,
            ]);

            DB::commit();

            return response()->json(['message' => ('User created successfully')], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request)
    {
    }

    public function destroy()
    {
    }
}
