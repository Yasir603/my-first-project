<?php

class LoginUser extends ElectroApi {



    const EMAIL = 'email';
    const PASSWORD = 'password';

    protected function onAssemble() {
        $this->killWithBadRequestExceptionIfTextualParamIsMissing(self::EMAIL);
        $this->killWithBadRequestExceptionIfTextualParamIsMissing(self::PASSWORD);
    }

    protected function onDevise() {


        $this->killCompromisedIfNullElseGetUserEntity(
               $this->getAppDB()->getUserDao()->getUserWithEmail($_POST[self::EMAIL]),
              null,
              "invalid_email"

        );

        $userEntity =   $this->killCompromisedIfNullElseGetUserEntity(
            $this->getAppDB()->getUserDao()->getUserWithPassword($_POST[self::PASSWORD]),
            null,
            "wrong_password",
           );



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
