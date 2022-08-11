package com.electrodragon.YasirFirstProject_admin.model.network.client

import com.electrodragon.YasirFirstProject_admin.model.network.service.*

class ApiClient(
    val createPostService: CreatePostService,
    val deleteUserService: DeleteUserService,
    val fetchUsersService: FetchUsersService,
    val loginUserService: LoginUserService,
    val registerUserService: RegisterUserService,
    val updateUserService: UpdateUserService
)
