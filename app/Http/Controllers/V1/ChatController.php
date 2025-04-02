<?php

namespace App\Http\Controllers\V1;

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

            return response()->json(["message" => "chat info", "data" => ["chat" => $chat]], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json(["message" => "error on get chat", "errors" => $th->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'telegram_id' => 'required|string|max:255|unique:chats',
            'type' => 'required|string|max:20',
            'language_code' => 'string|max:10',
        ]);
        if ($validator->fails()) {
            return response()->json(["message" => "error on create chat", "errors" => $validator->errors()], 422);
        }
        try {
            if (!in_array($request->type, array_column(ChatType::cases(), 'value'))) {
                throw new \Exception('Chat type not supported');
            }
            $chat = new Chat();
            $chat->telegram_id = $request->telegram_id;
            $chat->type = $request->type;
            $chat->language = in_array($request->language, ['en', 'es']) ? $request->language : 'en';

            $chat->save();
            Log::info("Chat created" . $chat);

            return response()->json(['message' => 'Chat created successfully', "data" => ["chat" => $chat]], 201);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
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
