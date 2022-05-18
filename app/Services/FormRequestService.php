<?php

namespace App\Services;

use App\Events\NewFormRequestEvent;
use App\Models\FormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class FormRequestService
{
    /**
     * Creates new FormRequest record
     *
     * @param  Request  $request
     * @param $user
     * @return array|bool[]
     */
    public function store(Request $request, $user): array
    {
        if ($this->checkUserHasRequestsThisDay($user)) {
            return [
                'success'   => false,
                'msg'       => 'You should wait 24 hours after your last request!',
            ];
        }

        if ($request->hasFile('file')) {
            $filePath = $this->saveFile($request->file('file'));
        }

        $result = FormRequest::query()
            ->create([
                'author_id' => $user->id,
                'theme'     => $request->theme,
                'message'   => $request->message,
                'file_path' => $filePath ?? null,
            ]);

        // process event
        NewFormRequestEvent::dispatchIf((bool)$result, $result);

        return [
            'success' => (bool)$result,
        ];
    }

    /**
     * Check user has submitted requests this day
     *
     * @param  User  $user
     * @return bool
     */
    protected function checkUserHasRequestsThisDay(User $user): bool
    {
        return $user->formRequests()
            ->where('created_at', '>', now()->subDay())
            ->exists();
    }

    /**
     * Save form request file
     *
     * @param  UploadedFile  $file
     * @return bool|string
     */
    protected function saveFile(UploadedFile $file): bool|string
    {
        // Generating random unique file name
        $fileExtension = $file->getClientOriginalExtension();
        $fileName = uniqid() . '.' . $fileExtension;

        return $file->storeAs('form-files', $fileName, 'public');
    }
}
