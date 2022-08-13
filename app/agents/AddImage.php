<?php

use Carbon\Carbon;
use Ramsey\Uuid\Uuid;

class AddImage extends ElectroApi {

    const USER_UID = 'user_uid';
    const IMAGE = 'image';

    protected function onAssemble() {
        $this->killWithBadRequestExceptionIfTextualParamIsMissing(self::USER_UID);
        $this->killWithBadRequestExceptionIfMultipartParamIsMissing(self::IMAGE);
    }


    protected function onDevise() {

        $this->killCustomFailureIfAnyHasNone(
            "no_user_found",
            null ,
            $this->getAppDB()->getUserDao()->getUserWithUid($_POST[self::USER_UID])
        );


        $extension=array('jpeg','jpg','png','gif');
	      foreach ($_FILES[self::IMAGE]['tmp_name'] as $key => $value) {
	    	$filename=$_FILES[self::IMAGE]['name'][$key];
	    	$filename_tmp=$_FILES[self::IMAGE]['tmp_name'][$key];
	    	echo '<br>';
	    	$ext=pathinfo($filename,PATHINFO_EXTENSION);

	    	$finalimg='';
	    	if(in_array($ext,$extension))
		    {
		     	if(!file_exists($this->getUserAvatarImageDirPath() .$filename))
		    	{
		        	move_uploaded_file($filename_tmp, $this->getUserAvatarImageDirPath() .$filename);
		        	$finalimg=$filename;
		     	}else
		    	{
			     	 $filename=str_replace('.','-',basename($filename,$ext));
				     $newfilename=$filename.time().".".$ext;
				     move_uploaded_file($filename_tmp, $this->getUserAvatarImageDirPath() .$newfilename);
				     $finalimg=$newfilename;
		    	}

			        //insert
              $this->getAppDB()->getImageDao()->insertImage(
              new ImageEntity(
              Uuid::uuid4()->toString(),
              $finalimg,
              $_POST[self::USER_UID],
              Carbon::now(),
              Carbon::now()
              ));
	        }




          }


        $this->resSendOK([
            'image' => 'images save successfully.'
        ]);
    }
}
