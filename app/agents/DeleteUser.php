<?php

class DeleteUser extends ElectroApi {

    protected function onDevise() {
        $this->resSendOK([
            'eevee' => 'Hi i\'m DeleteUser agent.'
        ]);
    }
}
