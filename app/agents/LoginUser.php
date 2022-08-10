<?php

class LoginUser extends ElectroApi {

    const CONTACT_INFO = 'contact_info';
    const TYPE = 'type';

    const EMAIL = 'email';
    const PASSWORD = 'password';

    protected function onAssemble() {
        $this->killWithBadRequestExceptionIfTextualParamIsMissing(self::CONTACT_INFO);
        $this->killWithBadRequestExceptionIfTextualParamIsMissing(self::TYPE);

        if (!in_array($_POST[self::TYPE] , [self::EMAIL, self::PASSWORD])) {
            $this->killAsBadRequestWithInvalidValueForParam(self::TYPE);
        }
    }

    protected function onDevise() {

        if ($_POST[self::TYPE] === self::EMAIL) {
            $userEntity = $this->killCompromisedIfNullElseGetUserEntity(
                $this->getAppDB()->getUserDao()->getUserWithEmail($_POST[self::CONTACT_INFO]),
                null ,
                "no_user_found_with_this_email"
            );
        } else {
            $userEntity = $this->killCompromisedIfNullElseGetUserEntity(
                $this->getAppDB()->getUserDao()->getUserWithPassword($_POST[self::CONTACT_INFO]),
                null ,
                "no_user_found_with_this_password"
            );
        }



        $this->resSendOK([
            'user' => [
                'uid' => $userEntity->getUid(),
                'username' => $userEntity->getUsername(),
                'email' => $userEntity->getEmail(),
                'password' => $userEntity->getPassword()

            ]
        ]);
    }
}
