<?php
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
class CreatePost extends ElectroApi {

       const USER_UID = 'username';
       const VIDEO = 'video';
       const TEXT = 'text';

    protected function onAssemble() {
      $this->killWithBadRequestExceptionIfTextualParamIsMissing(self::USER_UID);
    }

    protected function onDevise() {

      $userEntity = $this->killCompromisedIfNullElseGetUserEntity(
      $this->getAppDB()->getUserDao()->getUserWithUid($_POST[self::USER_UID]),
      null ,
      "no_user_found"
    );

        $extArray = ["mp4","avi","3gp","mov","mpeg"];

        $fileInfo = pathinfo($_FILES[VIDEO]['name']);

        $tmp = explode(".", $_FILES[VIDEO]['name']);

        $size = ($_FILES[VIDEO]["size"]/10).'MB';

        $newName = time() . rand(0, 99999) . "." . end($tmp);
        if ($_FILES[VIDEO]["size"] > 10485760) {

            echo json_encode(array('status' => 'error', 'size' => 'File size is greater then 10 MB TRY AGAIN.'));
        }
        else {
              if (! move_uploaded_file($_FILES[VIDEO]['tmp_name'], $this->getStatusVideoDirPath . $newName)) {
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
                    $_POST[self::VIDEO],
                    $_POST[self::TEXT],
                    $generatedName,
                    $Post_time,
                    $Post_time
                )
            ), null ,
            "failed_to_insert_user_Post"
        );
        $this->resSendOK([
          'Post' => [
            'uid' => $postEntity->getUid(),
            'user_uid' => $postEntity->getUserUid(),
            'text' => $postEntity->getText(),
            'video' => $this->createLinkForStatusVideo($postEntity->getVideo())
        ]);
    }
}
