package com.electrodragon.YasirFirstProject.model.network.response

import com.electrodragon.YasirFirstProject.model.network.constant.ApiResponseConstant
import com.google.gson.annotations.SerializedName

data class AddImageData (
        @SerializedName(ApiResponseConstant.EXCEPTIONS) val exceptions: AddImageResponseClasses.Exceptions?,
        @SerializedName("attribute_name") val attributeName: Boolean?
)

object AddImageResponseClasses {
    data class Exceptions( // <***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>
        @SerializedName(ApiResponseConstant.MISSING_PARAM) val missingParam: String?,
        @SerializedName(ApiResponseConstant.INVALID_VALUE_OF_PARAM) val invalidValueOfParam: String?,
        @SerializedName("no_user_found") val noUserFound: Boolean?,
        @SerializedName("failed_to_save_image") val failedToSaveImage: Boolean?
    ) // </***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>
}
