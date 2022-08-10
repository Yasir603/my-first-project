<?php

class RegisterUser extends ElectroApi {

    protected function onDevise() {
        $this->resSendOK([
            'eevee' => 'Hi i\'m RegisterUser agent.'
        ]);
    }
}
