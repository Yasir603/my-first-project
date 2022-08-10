package com.electrodragon.YasirFirstProject.model.network.service

import com.electrodragon.YasirFirstProject.model.network.constant.ApiRequestConstant
import com.electrodragon.YasirFirstProject.model.network.response.RegisterUserData
import com.electrodragon.YasirFirstProject.model.network.core.ElectroResponse
import retrofit2.Call
import retrofit2.http.Field
import retrofit2.http.FormUrlEncoded
import retrofit2.http.POST

interface RegisterUserService {
    @FormUrlEncoded
    @POST("register_user.php")
    fun registerUser(
            @Field(ApiRequestConstant.API_KEY) api_key: String,
    ): Call<ElectroResponse<RegisterUserData>>
}
