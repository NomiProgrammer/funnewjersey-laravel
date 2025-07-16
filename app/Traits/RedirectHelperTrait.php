<?php

namespace App\Traits;

use App\Enums\MessageType;
use App\Enums\RedirectMessage;
use App\Enums\RedirectType;
use Illuminate\Http\RedirectResponse;

trait RedirectHelperTrait
{
    private function returnWithMessageAfterCreate($model, $successMessage, $failedMessage, $routeName): RedirectResponse
    {
        $actionStatus = $model->wasRecentlyCreated;
        [$messageType, $message] = $this->getMessages($successMessage, $failedMessage, $actionStatus);

        return $actionStatus
            ? redirect()->route($routeName)->with([
                'alert-type' => $messageType,
                'messege' => $message,
            ])
            : redirect()->back()->with([
                'alert-type' => $messageType,
                'messege' => $message,
            ]);
    }

    private function returnWithMessageAfterUpdate($model, $successMessage, $failedMessage, $routeName): RedirectResponse
    {
        $actionStatus = $model->wasChanged();
        [$messageType, $message] = $this->getMessages($successMessage, $failedMessage, $actionStatus);

        return $actionStatus
            ? redirect()->route($routeName)->with([
                'alert-type' => $messageType,
                'messege' => $message,
            ])
            : redirect()->back()->with([
                'alert-type' => $messageType,
                'messege' => $message,
            ]);
    }

    private function generateMessages($successMessage, $failedMessage): array
    {
        $successMessage = $successMessage;
        $failedMessage = $failedMessage;

        return [
            $successMessage,
            $failedMessage,
        ];
    }

    private function getMessages($successMessage, $failedMessage, $actionStatus): array
    {
        [$successMessage, $failedMessage] = $this->generateMessages($successMessage, $failedMessage);

        $messageType = $actionStatus ? MessageType::SUCCESS->value : MessageType::ERROR->value;
        $message = $actionStatus ? __($successMessage) : __($failedMessage);

        return [
            $messageType,
            $message,
        ];
    }

    private function redirectWithMessage(string $type, ?string $route = null, array $params = [], array|string $notification = []): RedirectResponse
    {
        $messages = RedirectMessage::getAll();
        // Handle if notification is a string
        if (is_string($notification)) {
            $notification = [
                'messege'    => __($notification),
                'alert-type' => ($type === RedirectType::ERROR->value) ? MessageType::ERROR->value : MessageType::SUCCESS->value,
            ];
        } elseif (empty($notification)) {
            // Default notification if none provided
            $notification = [
                'messege'    => __($messages[$type]),
                'alert-type' => ($type === RedirectType::ERROR->value) ? MessageType::ERROR->value : MessageType::SUCCESS->value,
            ];
        }

        return $route
            ? redirect()->route($route, $params)->with($notification)
            : redirect()->back()->with($notification);
    }

}
