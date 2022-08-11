package com.electrodragon.YasirFirstProject.model.network.service

import com.electrodragon.YasirFirstProject.model.network.constant.ApiRequestConstant
import com.electrodragon.YasirFirstProject.model.network.response.UpdateUserData
import com.electrodragon.YasirFirstProject.model.network.core.ElectroResponse
import retrofit2.Call
import retrofit2.http.Field
import retrofit2.http.FormUrlEncoded
import retrofit2.http.POST

interface UpdateUserService {
    @FormUrlEncoded
    @POST("update_user.php")
    fun updateUser(
            @Field(ApiRequestConstant.API_KEY) api_key: String,
    ): Call<ElectroResponse<UpdateUserData>>
}
