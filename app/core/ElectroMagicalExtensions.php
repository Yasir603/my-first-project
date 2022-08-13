<?php

trait ElectroMagicalExtensions {
    private function findLastEntityOrKill(
        $iterable,
        $msg,
        ?int $contract_code,
        $compromised=false
    ) {
        if (count($iterable) === 0) {
            if ($contract_code !== null) {
                $this->onKillContractSigned($contract_code);
            }
            if ($compromised) {
                $this->killAsCompromised([ $msg => true ]);
            } else {
                $this->killAsFailure([ $msg => true ]);
            }
        }
        return end($iterable);
    }

    private function killIfNull(
        $payload,
        string $msg,
        ?int $contract_code,
        bool $compromised=false
    ) {
        if ($payload === null) {
            if ($contract_code !== null) {
                $this->onKillContractSigned($contract_code);
            }
            if ($compromised) {
                $this->killAsCompromised([ $msg => true ]);
            } else {
                $this->killAsFailure([ $msg => true ]);
            }
        }
        return $payload;
    }

    private function killIfEmpty(
        $payload,
        string $msg,
        ?int $contract_code,
        bool $compromised=false
    ) {
        if (count($payload) === 0) {
            if ($contract_code !== null) {
                $this->onKillContractSigned($contract_code);
            }
            if ($compromised) {
                $this->killAsCompromised([ $msg => true ]);
            } else {
                $this->killAsFailure([ $msg => true ]);
            }
        }
        return $payload;
    }

    public function findLastPostEntityOrKillFailure(
        array $posts, 
        ?int $contract_code=null,
        $msg=''
    ): PostEntity {
        return $this->findLastEntityOrKill(
             $posts,
             $msg === '' ? 'failed_to_find_post_entity' : $msg,
             $contract_code
         );
    }

    public function findLastPostEntityOrKillCompromised(
        array $posts,
        ?int $contract_code=null,
        $msg=''
    ): PostEntity {
        return $this->findLastEntityOrKill(
            $posts,
            $msg === '' ? 'data_compromised_post_entity_must_exist_but_not_found' : $msg,
            $contract_code,
            true
        );
    }

    public function killFailureIfNullElseGetPostEntity(
        ?PostEntity $postEntity,
        ?int $contract_code=null,
         string $msg=''
    ): PostEntity {
        return $this->killIfNull(
            $postEntity, 
            $msg === '' ? 'post_entity_not_found' : $msg,
            $contract_code
        );
    }

    public function killCompromisedIfNullElseGetPostEntity(
        ?PostEntity $postEntity, 
        ?int $contract_code=null,
         string $msg=''
    ): PostEntity {
        return $this->killIfNull(
            $postEntity,
            $msg === '' ? 'data_compromised_post_entity_not_found' : $msg,
            $contract_code,
            true
        );
    }

    /**
     * @param PostEntity[] $postEntities
     * @param string $msg
     * @param int|null $contract_code
     * @return PostEntity[]
     */
    public function killFailureIfEmptyElseGetPostEntities(
        array $postEntities,
        ?int $contract_code=null,
        string $msg=''
    ): array {
        return $this->killIfEmpty(
            $postEntities,
            $msg === '' ? 'post_entities_not_found' : $msg,
            $contract_code
        );
    }

    /**
     * @param PostEntity[] $postEntities
     * @param string $msg
     * @param int|null $contract_code
     * @return PostEntity[]
     */
    public function killCompromisedIfEmptyElseGetPostEntities(
        array $postEntities,
        ?int $contract_code=null,
        string $msg=''
    ): array {
        return $this->killIfEmpty(
            $postEntities,
            $msg === '' ? 'data_compromised_post_entities_not_found' : $msg,
            $contract_code,
            true
        );
    }

    public function findLastImageEntityOrKillFailure(
        array $images, 
        ?int $contract_code=null,
        $msg=''
    ): ImageEntity {
        return $this->findLastEntityOrKill(
             $images,
             $msg === '' ? 'failed_to_find_image_entity' : $msg,
             $contract_code
         );
    }

    public function findLastImageEntityOrKillCompromised(
        array $images,
        ?int $contract_code=null,
        $msg=''
    ): ImageEntity {
        return $this->findLastEntityOrKill(
            $images,
            $msg === '' ? 'data_compromised_image_entity_must_exist_but_not_found' : $msg,
            $contract_code,
            true
        );
    }

    public function killFailureIfNullElseGetImageEntity(
        ?ImageEntity $imageEntity,
        ?int $contract_code=null,
         string $msg=''
    ): ImageEntity {
        return $this->killIfNull(
            $imageEntity, 
            $msg === '' ? 'image_entity_not_found' : $msg,
            $contract_code
        );
    }

    public function killCompromisedIfNullElseGetImageEntity(
        ?ImageEntity $imageEntity, 
        ?int $contract_code=null,
         string $msg=''
    ): ImageEntity {
        return $this->killIfNull(
            $imageEntity,
            $msg === '' ? 'data_compromised_image_entity_not_found' : $msg,
            $contract_code,
            true
        );
    }

    /**
     * @param ImageEntity[] $imageEntities
     * @param string $msg
     * @param int|null $contract_code
     * @return ImageEntity[]
     */
    public function killFailureIfEmptyElseGetImageEntities(
        array $imageEntities,
        ?int $contract_code=null,
        string $msg=''
    ): array {
        return $this->killIfEmpty(
            $imageEntities,
            $msg === '' ? 'image_entities_not_found' : $msg,
            $contract_code
        );
    }

    /**
     * @param ImageEntity[] $imageEntities
     * @param string $msg
     * @param int|null $contract_code
     * @return ImageEntity[]
     */
    public function killCompromisedIfEmptyElseGetImageEntities(
        array $imageEntities,
        ?int $contract_code=null,
        string $msg=''
    ): array {
        return $this->killIfEmpty(
            $imageEntities,
            $msg === '' ? 'data_compromised_image_entities_not_found' : $msg,
            $contract_code,
            true
        );
    }

    public function findLastUserEntityOrKillFailure(
        array $users, 
        ?int $contract_code=null,
        $msg=''
    ): UserEntity {
        return $this->findLastEntityOrKill(
             $users,
             $msg === '' ? 'failed_to_find_user_entity' : $msg,
             $contract_code
         );
    }

    public function findLastUserEntityOrKillCompromised(
        array $users,
        ?int $contract_code=null,
        $msg=''
    ): UserEntity {
        return $this->findLastEntityOrKill(
            $users,
            $msg === '' ? 'data_compromised_user_entity_must_exist_but_not_found' : $msg,
            $contract_code,
            true
        );
    }

    public function killFailureIfNullElseGetUserEntity(
        ?UserEntity $userEntity,
        ?int $contract_code=null,
         string $msg=''
    ): UserEntity {
        return $this->killIfNull(
            $userEntity, 
            $msg === '' ? 'user_entity_not_found' : $msg,
            $contract_code
        );
    }

    public function killCompromisedIfNullElseGetUserEntity(
        ?UserEntity $userEntity, 
        ?int $contract_code=null,
         string $msg=''
    ): UserEntity {
        return $this->killIfNull(
            $userEntity,
            $msg === '' ? 'data_compromised_user_entity_not_found' : $msg,
            $contract_code,
            true
        );
    }

    /**
     * @param UserEntity[] $userEntities
     * @param string $msg
     * @param int|null $contract_code
     * @return UserEntity[]
     */
    public function killFailureIfEmptyElseGetUserEntities(
        array $userEntities,
        ?int $contract_code=null,
        string $msg=''
    ): array {
        return $this->killIfEmpty(
            $userEntities,
            $msg === '' ? 'user_entities_not_found' : $msg,
            $contract_code
        );
    }

    /**
     * @param UserEntity[] $userEntities
     * @param string $msg
     * @param int|null $contract_code
     * @return UserEntity[]
     */
    public function killCompromisedIfEmptyElseGetUserEntities(
        array $userEntities,
        ?int $contract_code=null,
        string $msg=''
    ): array {
        return $this->killIfEmpty(
            $userEntities,
            $msg === '' ? 'data_compromised_user_entities_not_found' : $msg,
            $contract_code,
            true
        );
    }

    private function isNone($payload): bool {
        return $payload === null || (is_array($payload) && count($payload) === 0);
    }

    public function killCustomFailureIfAnyHaveSome(
        string $msg,
        ?int $contract_code,
        ...$args
    ): void {
        foreach ($args as $payload) {
            if (!$this->isNone($payload)) {
                if ($contract_code !== null) {
                    $this->onKillContractSigned($contract_code);
                }
                $this->killAsFailure([$msg => true]);
            }
        }
    }

    public function killCustomFailureIfAnyHasNone(string $msg, ?int $contract_code, ...$args): void {
        foreach ($args as $payload) {
            if ($this->isNone($payload)) {
                if ($contract_code !== null) {
                    $this->onKillContractSigned($contract_code);
                }
                $this->killAsFailure([$msg => true]);
            }
        }
    }

    public function killCustomFailureWhenAllHaveNone(string $msg, ?int $contract_code, ...$args): void {
        $every_one_have_none = true;
        foreach ($args as $payload) {
            if (!$this->isNone($payload)) {
                $every_one_have_none = false;
                break;
            }
        }
        if ($every_one_have_none) {
            if ($contract_code !== null) {
                $this->onKillContractSigned($contract_code);
            }
            $this->killAsFailure([$msg => true]);
        }
    }

    public function killCustomFailureWhenAllHaveSome(string $msg, ?int $contract_code, ...$args): void {
        $every_one_have_something = true;
        foreach ($args as $payload) {
            if ($this->isNone($payload)) {
                $every_one_have_something = false;
                break;
            }
        }
        if ($every_one_have_something) {
            if ($contract_code !== null) {
                $this->onKillContractSigned($contract_code);
            }
            $this->killAsFailure([$msg => true]);
        }
    }

    public function killFailureIfImageNotSaved(
        string $request_key,
        bool $saved,
        ?int $contract_code=null
    ): void {
        if (!$saved) {
            if ($contract_code !== null) {
                $this->onKillContractSigned($contract_code);
            }
            $this->killAsFailure([
                'failed_to_save_' . $request_key . '_file' => true
            ]);
        }
    }

    public function deleteFileTillItDoesNotDelete(string $path): void {
        while (true) {
            if (!file_exists($path)) {
                break;
            }
            unlink($path);
        }
    }

    public function killWithBadRequestExceptionIfTextualParamIsMissing(string $param): void {
        if (!isset($_POST[$param])) {
            $this->killAsBadRequestWithMissingParamException($param);
        }
    }

    public function killWithBadRequestExceptionIfMultipartParamIsMissing(string $param): void {
        if (!isset($_FILES[$param])) {
            $this->killAsBadRequestWithMissingParamException($param);
        }
    }
}
