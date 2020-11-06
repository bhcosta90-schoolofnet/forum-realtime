<?php

namespace App\Observers;

use App\Models\User;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PhotoUserObserver
{
    public function creating(User $user)
    {
        if (is_a($user->photo, UploadedFile::class) && $user->photo->isValid()) {
            $this->upload($user);
        }
    }

    public function deleting(User $user)
    {
        Storage::delete($user->photo);
    }

    public function updating(User $user)
    {
        if (is_a($user->photo, UploadedFile::class) && $user->photo->isValid()) {
            $previous = $user->getOriginal('photo');
            $this->upload($user);
            if($previous){
                Storage::delete($previous);
            }
        }
    }

    protected function upload(User $user)
    {
        $extension = $user->photo->extension();
        $mimeType = $user->photo->getMimeType();

        if(!in_array($mimeType, User::PHOTO_ALLOWED)) {
            throw new Exception('Extension ' . $mimeType . ' not allowed');
        }

        $name = bin2hex(openssl_random_pseudo_bytes(8));
        $nameImage = sprintf("avatars/%s/%s.%s", md5($user->id), $name, $extension);

        $user->photo->storeAs('', $nameImage);

        $img = \Image::make($user->photo->getRealPath());
        $img->fit(250, 250)->save(Storage::path($nameImage));

        $user->photo = $nameImage;
    }
}
