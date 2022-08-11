<?php

class CreatePost extends ElectroApi {

    protected function onDevise() {
        $this->resSendOK([
            'eevee' => 'Hi i\'m CreatePost agent.'
        ]);
    }
}
