<?php

use Carbon\Carbon;
use Ramsey\Uuid\Uuid;

class AddImage extends ElectroApi {

    const USER_UID = 'user_uid';
    const IMAGE = 'image';

    protected function onAssemble() {
        $this->killWithBadRequestExceptionIfTextualParamIsMissing(self::USER_UID);
        $this->killWithBadRequestExceptionIfMultipartParamIsMissing(self::IMAGE);
    }


    protected function onDevise() {

        $this->killCustomFailureIfAnyHasNone(
            "no_user_found",
            null ,
            $this->getAppDB()->getUserDao()->getUserWithUid($_POST[self::USER_UID])
        );


        $extension=array('jpeg','jpg','png','gif');
        for ($i=0;$i < count($_FILES['image']['name']);$i++) {
            $generatedName = "";

            $isImageSaved = ImageUploader::withSrc($_FILES['image']['tmp_name'][$i])
                ->destinationDir($this->getUserAvatarImageDirPath())
                ->generateUniqueName($_FILES['image']['name'][$i])
                ->mapGeneratedName($generatedName)
                ->compressQuality(75)
                ->save();

            if (!$isImageSaved) {
                die("failed to save image");
            }

            $this->killFailureIfNullElseGetImageEntity(
                $this->getAppDB()->getImageDao()->insertImage(
                    new ImageEntity(
                        Uuid::uuid4()->toString(),
                        $generatedName,
                        $_POST[self::USER_UID],
                        Carbon::now(),
                        Carbon::now()
                    )
                )
            );

        }





        $this->resSendOK([
            'image' => 'images save successfully.'
        ]);
    }
}
