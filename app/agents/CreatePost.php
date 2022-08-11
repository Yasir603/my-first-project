<?php
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
class CreatePost extends ElectroApi {

       const USER_UID = 'username';
       const VIDEO = 'video';
       const TEXT = 'text';

    protected function onAssemble() {
      $this->killWithBadRequestExceptionIfTextualParamIsMissing(self::USER_UID);
      $this->killWithBadRequestExceptionIfMultipartParamIsMissing(self::VIDEO);
    }

    protected function onDevise() {

      $userEntity = $this->killCompromisedIfNullElseGetUserEntity(
      $this->getAppDB()->getUserDao()->getUserWithUid($_POST[self::USER_UID]),
      null ,
      "no_user_found"
    );

    $generatedName = "";
    $SavedVideo = VideoUploader::withSrc($_FILES[self::VIDEO]['tmp_name'])
        ->destinationDir($this->getStatusVideoDirPath())
        ->generateUniqueName($_FILES[self::VIDEO]['name'])
        ->mapGeneratedName($generatedName)
        ->compressQuality(75)
        ->save();

    if (!$SavedVideo) {
        $this->killFailureWithMsg('failed_to_save_video');
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
