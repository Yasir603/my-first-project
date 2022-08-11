package com.electrodragon.YasirFirstProject_admin.model.network.service

import com.electrodragon.YasirFirstProject_admin.model.network.constant.ApiRequestConstant
import com.electrodragon.YasirFirstProject_admin.model.network.response.AddImageData
import com.electrodragon.YasirFirstProject_admin.model.network.core.ElectroResponse
import retrofit2.Call
import retrofit2.http.Field
import retrofit2.http.FormUrlEncoded
import retrofit2.http.POST

interface AddImageService {
    @FormUrlEncoded
    @POST("add_image.php")
    fun addImage(
            @Field(ApiRequestConstant.API_KEY) api_key: String,
    ): Call<ElectroResponse<AddImageData>>
}