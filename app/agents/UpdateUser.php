<?php

class UpdateUser extends ElectroApi {

    protected function onDevise() {
        $this->resSendOK([
            'eevee' => 'Hi i\'m UpdateUser agent.'
        ]);
    }
}
