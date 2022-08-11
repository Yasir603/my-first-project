package com.electrodragon.YasirFirstProject_admin.model.network.response

import com.electrodragon.YasirFirstProject_admin.model.network.constant.ApiResponseConstant
import com.google.gson.annotations.SerializedName

data class FetchUsersData (
        @SerializedName(ApiResponseConstant.EXCEPTIONS) val exceptions: FetchUsersResponseClasses.Exceptions?,
        @SerializedName("attribute_name") val attributeName: Boolean?
)

object FetchUsersResponseClasses {
    data class Exceptions( // <***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>
        @SerializedName(ApiResponseConstant.MISSING_PARAM) val missingParam: String?,
        @SerializedName(ApiResponseConstant.INVALID_VALUE_OF_PARAM) val invalidValueOfParam: String?
    ) // </***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>
}
