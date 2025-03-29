<?php

namespace App\Http\Controllers;

use App\Enums\ChatType;
use Illuminate\Http\Request;
use App\Models\Chat;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{

    public function __construct(
    ) {
    }

    public function index()
    {
    }

    public function show(int $telegram_id)
    {
        try {
            $chat = Chat::where('telegram_id', $telegram_id)->first();
            if (!$chat) {
                return response()->json(["message" => "Chat not found"], 404);
            }

            return response()->json(["message" => "chat", "data" => $chat], 200);
        } catch (\Throwable $th) {
            return response()->json(["message" => "error on get chat", "errors" => $th->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'telegram_id' => 'required|string|max:255',
            'type' => 'required|string|max:20',
        ]);
        if ($validator->fails()) {
            return response()->json(["message" => "error on create chat", "errors" => $validator->errors()], 422);
        }
        try {
            if (in_array($request->type, array_column(ChatType::cases(), 'value'))) {
                $chat = new Chat();
                $chat->telegram_id = $request->telegram_id;
                $chat->chat_type = $request->type;
                Log::info("Chat values: " . $chat);

                $chat->save();
                Log::info("Chat created" . $chat);

                return response()->json(['message' => 'Chat created successfully', 'data' => $chat], 201);
            }
            throw new \Exception('Chat type not supported');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, int $id)
    {
    }

    public function destroy(int $id)
    {
    }
}
