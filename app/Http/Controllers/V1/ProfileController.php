<?php

namespace App\Http\Controllers\V1;

use App\Http\Utils\UserUtils;
use App\Models\Profile;
use DB;
use Illuminate\Http\Request;
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
        Log::info("Getting user profile");
        try {
            $profile = Profile::with('user')->where('telegram_id', $id)->first();
            Log::info($profile);
            if (!$profile) {
                return response()->json(["message" => "Profile not found"], 404);
            }
            Log::debug("user profile", $profile->toArray());

            return response()->json(["message" => "user profile info", "data" => ["profile" => $profile, "request_password_change" => $profile->user->request_password_change]], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json(["message" => "error on get user profile", "errors" => $th->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        Log::info("Creating user profile");
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users',
            'telegram_id' => 'required|string|max:255|unique:profiles',
        ]);

        if ($validator->fails()) {
            return response()->json(["message" => "error on create user profile", "errors" => $validator->errors()], 422);
        }

        Log::info("Creating user");

        try {
            DB::beginTransaction();
            $user = $this->userUtils->create($request->name, $request->username, $request->telegram_id);
            Log::info("User created" . $user);

            $profile = new Profile();
            $profile->user_id = $user->id;
            $profile->telegram_id = $request->telegram_id;
            $profile->save();

            $profile = $profile->with('user')->first();
            DB::commit();

            return response()->json(['message' => 'User and Profile created successfully', 'data' => ['profile' => $profile, "request_password_change" => true]], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
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
