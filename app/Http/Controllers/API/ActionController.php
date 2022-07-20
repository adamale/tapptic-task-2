<?php

namespace App\Http\Controllers\API;

use App\Enums\Action;
use App\Http\Controllers\Controller;
use App\Http\Requests\ActionRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class ActionController extends Controller
{
    public function __invoke(ActionRequest $request): JsonResponse
    {
        $input = $request->validated();

        /** @var \App\Models\User $userA */
        $userA = User::query()->findOrFail($input['user_a']);

        /** @var \App\Models\User $userB */
        $userB = User::query()->findOrFail($input['user_b']);

        return $this->takeAction($input['action'], $userA, $userB);
    }

    protected function takeAction(string $action, User $userA, User $userB): JsonResponse
    {
        if ($action === Action::LIKED->value) {
            return $this->like($userA, $userB);
        }

        return $this->unlike($userA, $userB);
    }

    protected function like(User $userA, User $userB): JsonResponse
    {
        $userA->like($userB);

        return $this->jsonSuccessResponse(message: __('action.liked', ['name' => $userB->name]));
    }

    protected function unlike(User $userA, User $userB): JsonResponse
    {
        $userA->unlike($userB);

        return $this->jsonSuccessResponse(message: __('action.unliked', ['name' => $userB->name]));
    }
}
