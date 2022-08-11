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

        for( $i=0;$i<3;$i++) {
            $generatedName = "";
            $isImageSaved = ImageUploader::withSrc($_FILES[self::IMAGE]['tmp_name'][$i])
                ->destinationDir($this->getUserAvatarImageDirPath())
                ->generateUniqueName($_FILES[self::IMAGE]['name'][$i])
                ->mapGeneratedName($generatedName)
                ->compressQuality(75)
                ->save();

            if (!$isImageSaved) {
                $this->killFailureWithMsg('failed_to_save_image');
            }


            $this->getAppDB()->getImageDao()->insertImage(
                new ImageEntity(
                    Uuid::uuid4()->toString(),
                    $generatedName,
                    $_POST[self::USER_UID],
                    Carbon::now(),
                    Carbon::now()
                )
            );
        }


        $this->resSendOK([
            'eevee' => 'Hi i\'m AddImage agent.'
        ]);
    }
}
