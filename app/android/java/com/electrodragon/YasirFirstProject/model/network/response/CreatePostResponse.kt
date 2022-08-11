package com.electrodragon.YasirFirstProject.model.network.response

import com.electrodragon.YasirFirstProject.model.network.constant.ApiResponseConstant
import com.google.gson.annotations.SerializedName

data class CreatePostData (
        @SerializedName(ApiResponseConstant.EXCEPTIONS) val exceptions: CreatePostResponseClasses.Exceptions?,
        @SerializedName("attribute_name") val attributeName: Boolean?
)

object CreatePostResponseClasses {
    data class Exceptions( // <***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>
        @SerializedName(ApiResponseConstant.MISSING_PARAM) val missingParam: String?,
        @SerializedName(ApiResponseConstant.INVALID_VALUE_OF_PARAM) val invalidValueOfParam: String?,
        @SerializedName("failed_to_insert_user_Post") val failedToInsertUserPost: Boolean?,
        @SerializedName("no_user_found") val noUserFound: Boolean?
    ) // </***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>
}
