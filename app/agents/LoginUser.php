<?php

class LoginUser extends ElectroApi {

    protected function onDevise() {
        $this->resSendOK([
            'eevee' => 'Hi i\'m LoginUser agent.'
        ]);
    }
}
