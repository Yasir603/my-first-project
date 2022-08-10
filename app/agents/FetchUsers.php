<?php

class FetchUsers extends ElectroApi {

    protected function onDevise() {
        $this->resSendOK([
            'eevee' => 'Hi i\'m FetchUsers agent.'
        ]);
    }
}
