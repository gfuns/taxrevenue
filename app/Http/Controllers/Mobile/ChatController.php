<?php

namespace App\Http\Controllers\Mobile;

use App\Events\PrivateConversationEvent;
use App\Http\Controllers\Controller;
use App\Models\PrivateChat;
use App\Models\PrivateConversation;
use Auth;
use Cloudinary;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function __construct()
    {
        Auth::shouldUse('api');
    }

    /**
     * viewContactList
     *
     * @return void
     */
    public function viewContactList()
    {

        $userId = Auth::user()->id;
        $fetchPrivateChats = PrivateChat::where(function ($query) use ($userId) {
            $query->where(function ($subQuery) use ($userId) {
                $subQuery->where('sender_id', $userId)
                    ->where('sender_deleted', 0);
            })->orWhere(function ($subQuery) use ($userId) {
                $subQuery->where('recipient_id', $userId)
                    ->where('recipient_deleted', 0);
            });
        })->get();

        $contactList = array();
        foreach ($fetchPrivateChats as $ct) {
            if ($ct->recipient_id == Auth::user()->id) {
                $contactList[] = [
                    'chat_id' => (int) $ct->id,
                    'contact_id' => (int) $ct->sender_id,
                    'contact_name' => $ct->getName($ct->sender_id),
                    'display_photo' => $ct->getPhoto($ct->sender_id),
                    'last_conversation' => PrivateConversation::orderBy("id", "desc")->where("private_chat_id", $ct->id)->first(),
                ];
            } else {
                $contactList[] = [
                    'chat_id' => (int) $ct->id,
                    'contact_id' => (int) $ct->recipient_id,
                    'contact_name' => $ct->getName($ct->recipient_id),
                    'display_photo' => $ct->getPhoto($ct->recipient_id),
                    'last_conversation' => PrivateConversation::orderBy("id", "desc")->where("private_chat_id", $ct->id)->first(),
                ];
            }
        }

        return new JsonResponse([
            'message' => 'Successful',
            'contact_list' => $contactList,
        ], 200);

    }

    /**
     * initializeChat
     *
     * @param Request request
     *
     * @return void
     */
    public function initializeChat(Request $request)
    {
        $validator = $this->validate($request, [
            'receiver_id' => 'required|numeric',
        ]);

        $chatExist = PrivateChat::where("sender_id", $request->receiver_id)->where("recipient_id", Auth::user()->id)->first();
        $existingChat = PrivateChat::where("sender_id", Auth::user()->id)->where("recipient_id", $request->receiver_id)->first();

        if (isset($chatExist) || isset($existingChat)) {

            return new JsonResponse([
                'response' => [
                    "message" => 'Chat Initialized Successfully',
                    "chat" => $chatExist == null ? $existingChat : $chatExist,
                ],
            ], 200);

        }

        $senderId = null;
        $recipientId = null;

        if (Auth::user()->account_type == "business") {
            $senderId = Auth::user()->id;
            $recipientId = $request->receiver_id;
        } else {
            $senderId = $request->receiver_id;
            $recipientId = Auth::user()->id;
        }

        $chat = new PrivateChat;
        $chat->sender_id = $senderId;
        $chat->recipient_id = $recipientId;
        if ($chat->save()) {

            return new JsonResponse([
                'response' => [
                    "message" => 'Chat Initialized Successfully',
                    "chat" => $chat,
                ],
            ], 200);

        } else {
            return new JsonResponse([
                'response' => [
                    'message' => 'Unable To Initialize Chat',
                    'details' => 'Invalid Data Format',
                ],
            ], 400);
        }

    }

    /**
     * chatConversations
     *
     * @param Request request
     *
     * @return void
     */
    public function chatConversations(Request $request)
    {
        $validator = $this->validate($request, [
            'chat_id' => 'required|numeric',
        ]);

        $userId = Auth::user()->id;
        $chatId = $request->chat_id;

        $privateChat = PrivateChat::where(function ($query) use ($userId, $chatId) {
            $query->where(function ($subQuery) use ($userId, $chatId) {
                $subQuery->where('id', $chatId)
                    ->where('sender_id', $userId)
                    ->where('sender_deleted', 0);
            })->orWhere(function ($subQuery) use ($userId, $chatId) {
                $subQuery->where('id', $chatId)
                    ->where('recipient_id', $userId)
                    ->where('recipient_deleted', 0);
            });
        })->first();

        // $privateChat = PrivateChat::find($request->chat_id);
        if (isset($privateChat)) {

            $chatConversations = PrivateConversation::where(function ($query) use ($userId, $chatId) {
                $query->where('private_chat_id', $chatId)
                    ->where('sender_id', $userId)
                    ->where('sender_deleted', 0);
            })->orWhere(function ($query) use ($userId, $chatId) {
                $query->where('private_chat_id', $chatId)
                    ->where('sender_id', '<>', $userId)
                    ->where('recipient_deleted', 0);
            })->get();

            return new JsonResponse([
                'response' => [
                    "message" => 'Successful',
                    "chat" => $privateChat,
                    "conversations" => $chatConversations,
                ],
            ], 200);

        } else {
            return new JsonResponse([
                'response' => [
                    'message' => 'Unable To Retrieve Chat Conversations',
                    'details' => 'We could not find a chat for the provided chat id',
                ],
            ], 400);
        }
    }

    /**
     * newChat
     *
     * @param Request request
     *
     * @return void
     */
    public function newChat(Request $request)
    {
        $validator = $this->validate($request, [
            'chat_id' => 'required|numeric',
            'message_type' => 'required',
            'message' => 'required',
        ]);

        $chat = PrivateChat::find($request->chat_id);
        if (isset($chat)) {
            $conversation = new PrivateConversation;
            $conversation->private_chat_id = $request->chat_id;
            $conversation->sender_id = Auth::user()->id;
            $conversation->message_type = $request->message_type;
            if ($request->message_type == "Text") {
                $conversation->message = $request->message;
                $conversation->file_name = "message.txt";
                $conversation->file_size = strlen($request->message);
            } elseif ($request->message_type == "Document" || $request->message_type == "Image") {
                $uploadedFileUrl = Cloudinary::upload($request->file('message')->getRealPath())->getSecurePath();
                $conversation->message = $uploadedFileUrl;
                $conversation->file_name = $request->file('message')->getClientOriginalName();
                $conversation->file_size = $request->file('message')->getSize();
            } else {
                $uploadedFileUrl = Cloudinary::upload($request->file('message')->getRealPath(), [
                    "resource_type" => "video"])->getSecurePath();
                $conversation->message = $uploadedFileUrl;
                $conversation->file_name = $request->file('message')->getClientOriginalName();
                $conversation->file_size = $request->file('message')->getSize();
            }
            if ($conversation->save()) {

                event(new PrivateConversationEvent($chat, $conversation));

                return new JsonResponse([
                    'response' => [
                        "message" => 'Chat Sent Successfully',
                        "chat" => $conversation,
                    ],
                ], 200);

            } else {
                return new JsonResponse([
                    'response' => [
                        'message' => 'Unable To Send Chat',
                        'details' => 'Invalid Data Format',
                    ],
                ], 400);
            }
        } else {
            return new JsonResponse([
                'response' => [
                    'message' => 'Unable To Send Chat',
                    'details' => 'We could not find a chat for the provided chat id',
                ],
            ], 400);
        }

    }

    /**
     * deleteChat
     *
     * @param Request request
     *
     * @return void
     */
    public function deleteChat(Request $request)
    {
        $validator = $this->validate($request, [
            'chat_id' => 'required|numeric',
        ]);

        $privateChat = PrivateChat::find($request->chat_id);

        if (isset($privateChat)) {

            try {
                if ($privateChat->sender_id == Auth::user()->id) {
                    $privateChat->sender_deleted = 1;
                    $privateChat->save();
                } else {
                    $privateChat->recipient_deleted = 1;
                    $privateChat->save();
                }

                return new JsonResponse([
                    'response' => [
                        "message" => 'Successful',
                        'details' => 'Chat Deleted',
                    ],
                ], 200);

            } catch (\Exception $e) {
                report($e);
                return new JsonResponse([
                    'response' => [
                        'message' => 'Unable To Delete Chat',
                        'details' => 'Something went wrong',
                    ],
                ], 400);
            }

        } else {
            return new JsonResponse([
                'response' => [
                    'message' => 'Unable To Delete Chat',
                    'details' => 'We could not find a chat for the provided chat id',
                ],
            ], 400);
        }
    }

    /**
     * deleteConversation
     *
     * @param Request request
     *
     * @return void
     */
    public function deleteConversation(Request $request)
    {
        $validator = $this->validate($request, [
            'conversation_id' => 'required|numeric',
        ]);

        $conversation = PrivateConversation::find($request->conversation_id);

        if (isset($conversation)) {

            try {
                if ($conversation->sender_id == Auth::user()->id) {
                    $conversation->sender_deleted = 1;
                    $conversation->save();
                } else {
                    $conversation->recipient_deleted = 1;
                    $conversation->save();
                }

                return new JsonResponse([
                    'response' => [
                        "message" => 'Successful',
                        'details' => 'Conversation Deleted',
                    ],
                ], 200);

            } catch (\Exception $e) {
                report($e);
                return new JsonResponse([
                    'response' => [
                        'message' => 'Unable To Delete Conversation',
                        'details' => 'Something went wrong',
                    ],
                ], 400);
            }

        } else {
            return new JsonResponse([
                'response' => [
                    'message' => 'Unable To Delete Conversation',
                    'details' => 'We could not find a chat conversation for the provided conversation id',
                ],
            ], 400);
        }
    }

    /**
     * searchContactList
     *
     * @param Request request
     *
     * @return void
     */
    public function searchContactList(Request $request)
    {
        $validator = $this->validate($request, [
            'contact_name' => 'required',
        ]);

        $userId = Auth::user()->id;
        $desiredName = $request->contact_name; // Replace with the desired name you want to search for

        $contacts = PrivateChat::select('private_chats.id', 'private_chats.sender_id', 'private_chats.recipient_id', 'private_chats.sender_deleted', 'private_chats.recipient_deleted')
            ->join('customers as c1', 'private_chats.sender_id', '=', 'c1.id')
            ->join('customers as c2', 'private_chats.recipient_id', '=', 'c2.id')
            ->where(function ($query) use ($desiredName) {
                $query->where('c1.first_name', $desiredName)
                    ->orWhere('c1.last_name', $desiredName)
                    ->orWhere('c2.first_name', $desiredName)
                    ->orWhere('c2.last_name', $desiredName);
            })
            ->where(function ($query) use ($userId) {
                $query->orWhere('private_chats.sender_id', $userId)
                    ->orWhere('private_chats.recipient_id', $userId);
            })
            ->where(function ($query) use ($userId) {
                $query->where(function ($subQuery) use ($userId) {
                    $subQuery->where('private_chats.sender_id', $userId)
                        ->where('private_chats.sender_deleted', 0);
                })->orWhere(function ($subQuery) use ($userId) {
                    $subQuery->where('private_chats.recipient_id', $userId)
                        ->where('private_chats.recipient_deleted', 0);
                });
            })->get();

        $contactList = array();
        foreach ($contacts as $ct) {
            if ($ct->recipient_id == Auth::user()->id) {
                $contactList[] = [
                    'chat_id' => (int) $ct->id,
                    'contact_id' => (int) $ct->sender_id,
                    'contact_name' => $ct->getName($ct->sender_id),
                    'display_photo' => $ct->getPhoto($ct->sender_id),
                    'last_conversation' => PrivateConversation::orderBy("id", "desc")->where("private_chat_id", $ct->id)->first(),
                ];
            } else {
                $contactList[] = [
                    'chat_id' => (int) $ct->id,
                    'contact_id' => (int) $ct->recipient_id,
                    'contact_name' => $ct->getName($ct->recipient_id),
                    'display_photo' => $ct->getPhoto($ct->recipient_id),
                    'last_conversation' => PrivateConversation::orderBy("id", "desc")->where("private_chat_id", $ct->id)->first(),
                ];
            }
        }

        return new JsonResponse([
            'message' => 'Successful',
            'contact_list' => $contactList,
        ], 200);
    }
}
