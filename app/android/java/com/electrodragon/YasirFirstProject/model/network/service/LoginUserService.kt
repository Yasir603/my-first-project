package com.electrodragon.YasirFirstProject.model.network.service

import com.electrodragon.YasirFirstProject.model.network.constant.ApiRequestConstant
import com.electrodragon.YasirFirstProject.model.network.response.LoginUserData
import com.electrodragon.YasirFirstProject.model.network.core.ElectroResponse
import retrofit2.Call
import retrofit2.http.Field
import retrofit2.http.FormUrlEncoded
import retrofit2.http.POST

interface LoginUserService {
    @FormUrlEncoded
    @POST("login_user.php")
    fun loginUser(
            @Field(ApiRequestConstant.API_KEY) api_key: String,
    ): Call<ElectroResponse<LoginUserData>>
}
