<?php

class DeleteUser extends ElectroApi {

    const USER_UID ='uid';

    protected function onAssemble() {
    $this->killWithBadRequestExceptionIfTextualParamIsMissing(self::USER_UID);
    }

    protected function onDevise() {
        $userEntity = $this->killCompromisedIfNullElseGetUserEntity(
        $this->getAppDB()->getUserDao()->getUserWithUid($_POST[self::USER_UID]),
        null ,
        "no_user_found"
    );

        $this->getAppDB()->getUserDao()->deleteUser($userEntity);

        $this->resSendOK([
            'user' => 'user deleted successfully.'
        ]);
    }
}
