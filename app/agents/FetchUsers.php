<?php

class FetchUsers extends ElectroApi {

    protected function onDevise() {

      $userEntities = $this->getAppDB()->getUserDao()->getAllUser();
      $users = [];

         foreach ($userEntities as $userEntity) {

           array_push($users,/** @_ */
             [
                 'uid' => $userEntity->getUid(),
                 'username' => $userEntity->getUsername(),
                 'email' => $userEntity->getEmail(),
                 'password' => $userEntity->getPassword(),
                 'image' => $this->createLinkForUserAvatarImage($userEntity->getAvatar()),
                 'registration_time' => $userEntity->getCreatedAt()
             ]
           );
         }


        $this->resSendOK([
            'users' => $users
        ]);
    }
}
