<?php
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
class CreatePost extends ElectroApi {

       const USER_UID = 'user_uid';
       const VIDEO = 'video';
       const TEXT = 'text';

    protected function onAssemble() {
      $this->killWithBadRequestExceptionIfTextualParamIsMissing(self::USER_UID);
    }

    protected function onDevise() {

        $this->killCompromisedIfNullElseGetUserEntity(
          $this->getAppDB()->getUserDao()->getUserWithUid($_POST[self::USER_UID]),
          null ,
          "no_user_found"
        );



        $tmp = explode(".", $_FILES[self::VIDEO]['name']);

        $newName = time() . rand(0, 99999) . "." . end($tmp);
        if ($_FILES[self::VIDEO]["size"] > 10485760) {
            echo json_encode(array('status' => 'error', 'size' => 'File size is greater then 10 MB TRY AGAIN.'));
        } else {
              if (! move_uploaded_file($_FILES[self::VIDEO]['tmp_name'], $this->getUserAvatarImageDirPath() . $newName)) {
                  echo json_encode(array('status' => 'error', 'msg' => 'File could not be uploaded.'));
                  die();
              }
        }
        $Post_time = Carbon::now();

        $postEntity = $this->killFailureIfNullElseGetPostEntity(
            $this->getAppDB()->getPostDao()->insertPost(
                new PostEntity(
                    Uuid::uuid4()->toString(),
                    $_POST[self::USER_UID],
                    $newName,
                    $_POST[self::TEXT],
                    $Post_time,
                    $Post_time
                )
            ),
            null ,
            "failed_to_insert_user_Post"
        );


        $this->resSendOK([
          'Post' => [
            'uid' => $postEntity->getUid(),
            'user_uid' => $postEntity->getUserUid(),
            'text' => $postEntity->getText(),
            'video' => $this->createLinkForStatusVideo($postEntity->getVideo())
              ]
        ]);
    }
}
