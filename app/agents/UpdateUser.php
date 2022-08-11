<?php

use Carbon\Carbon;
class UpdateUser extends ElectroApi {

    const USER_UID ='uid';
    const USERNAME = 'username';
    const EMAIL = 'email';
    const PASSWORD = 'password';
    const AVATAR = 'avatar';


    protected function onAssemble() {
    $this->killWithBadRequestExceptionIfTextualParamIsMissing(self::USER_UID);
    $this->killWithBadRequestExceptionIfTextualParamIsMissing(self::USERNAME);
    $this->killWithBadRequestExceptionIfTextualParamIsMissing(self::EMAIL);
    $this->killWithBadRequestExceptionIfTextualParamIsMissing(self::PASSWORD);
    $this->killWithBadRequestExceptionIfMultipartParamIsMissing(self::AVATAR);
    }
    protected function onDevise() {
        $this->resSendOK([
            'eevee' => 'Hi i\'m UpdateUser agent.'
        ]);
    }
}
