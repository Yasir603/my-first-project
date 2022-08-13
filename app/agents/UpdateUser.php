<?php

use Carbon\Carbon;
class UpdateUser extends ElectroApi {

    const USER_UID ='uid';
    const USERNAME = 'username';
    const EMAIL = 'email';
    const PASSWORD = 'password';

    protected function onAssemble() {
        $this->killWithBadRequestExceptionIfTextualParamIsMissing(self::USER_UID);
        $this->killWithBadRequestExceptionIfTextualParamIsMissing(self::USERNAME);
        $this->killWithBadRequestExceptionIfTextualParamIsMissing(self::EMAIL);
        $this->killWithBadRequestExceptionIfTextualParamIsMissing(self::PASSWORD);
    }

    protected function onDevise() {

        $userEntity = $this->killCompromisedIfNullElseGetUserEntity(
            $this->getAppDB()->getUserDao()->getUserWithUid($_POST[self::USER_UID]),
            null ,
            "no_user_found"
        );

        $userEntity->setUsername($_POST[self::USERNAME]);
        $userEntity->setEmail($_POST[self::EMAIL]);
        $userEntity->setPassword($_POST[self::PASSWORD]);
        $userEntity->setUpdatedAt(Carbon::now());

        $this->killCompromisedIfNullElseGetUserEntity(
            $this->getAppDB()->getUserDao()->updateUser($userEntity),
            null ,
            "failed_to_update"
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
