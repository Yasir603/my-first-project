package com.electrodragon.YasirFirstProject_admin.model.network.response

import com.electrodragon.YasirFirstProject_admin.model.network.constant.ApiResponseConstant
import com.google.gson.annotations.SerializedName

data class LoginUserData (
        @SerializedName(ApiResponseConstant.EXCEPTIONS) val exceptions: LoginUserResponseClasses.Exceptions?,
        @SerializedName("attribute_name") val attributeName: Boolean?
)

object LoginUserResponseClasses {
    data class Exceptions( // <***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>
        @SerializedName(ApiResponseConstant.MISSING_PARAM) val missingParam: String?,
        @SerializedName(ApiResponseConstant.INVALID_VALUE_OF_PARAM) val invalidValueOfParam: String?,
        @SerializedName("invalid_email") val invalidEmail: Boolean?,
        @SerializedName("data_compromised_user_entity_not_found") val dataCompromisedUserEntityNotFound: Boolean?
    ) // </***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>
}
