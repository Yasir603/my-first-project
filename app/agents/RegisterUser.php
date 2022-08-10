<?php

use Carbon\Carbon;
use Ramsey\Uuid\Uuid;

class RegisterUser extends ElectroApi {

    const USERNAME = 'username';
    const EMAIL = 'email';
    const PASSWORD = 'password';
    const AVATAR = 'avatar';


    protected function onAssemble() {
      $this->killWithBadRequestExceptionIfTextualParamIsMissing(self::USERNAME);
      $this->killWithBadRequestExceptionIfTextualParamIsMissing(self::EMAIL);
      $this->killWithBadRequestExceptionIfTextualParamIsMissing(self::PASSWORD);
      $this->killWithBadRequestExceptionIfMultipartParamIsMissing(self::AVATAR);
    }

    protected function onDevise() {

      $generatedName = "";
      $isImageSaved = ImageUploader::withSrc($_FILES[self::AVATAR]['tmp_name'])
          ->destinationDir($this->getUserAvatarImageDirPath())
          ->generateUniqueName($_FILES[self::AVATAR]['name'])
          ->mapGeneratedName($generatedName)
          ->compressQuality(75)
          ->save();

      if (!$isImageSaved) {
          $this->killFailureWithMsg('failed_to_save_image');
      }

      $this->killCustomFailureIfAnyHaveSome(
          'user_with_this_email_already_exist',
          null,
          $this->getAppDB()->getUserDao()->getUserWithEmail($_POST[self::EMAIL])
      );


      $register_time = Carbon::now();

      $userEntity = $this->killFailureIfNullElseGetUserEntity(
          $this->getAppDB()->getUserDao()->insertUser(
              new UserEntity(
                  Uuid::uuid4()->toString(),
                  $_POST[self::USERNAME],
                  $_POST[self::EMAIL],
                  $_POST[self::PASSWORD],
                  $generatedName,
                  $register_time,
                  $register_time
              )
          ), null ,
          "failed_to_insert_user_entity"
      );



        $this->resSendOK([
          'user' => [
            'uid' => $userEntity->getUid(),
            'username' => $userEntity->getUsername(),
            'email' => $userEntity->getEmail(),
            'password' => $userEntity->getPassword(),
            'avatar' => $this->createLinkForUserAvatarImage($userEntity->getAvatar())
         ]
        ]);
    }
}
