package com.electrodragon.YasirFirstProject.model.network.client

import com.electrodragon.YasirFirstProject.model.network.service.*

class ApiClient(
    val addImageService: AddImageService,
    val createPostService: CreatePostService,
    val deleteUserService: DeleteUserService,
    val fetchUsersService: FetchUsersService,
    val loginUserService: LoginUserService,
    val registerUserService: RegisterUserService,
    val updateUserService: UpdateUserService
)
