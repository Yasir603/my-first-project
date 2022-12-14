package com.electrodragon.YasirFirstProject.model.network.response

import com.electrodragon.YasirFirstProject.model.network.constant.ApiResponseConstant
import com.google.gson.annotations.SerializedName

data class RegisterUserData (
        @SerializedName(ApiResponseConstant.EXCEPTIONS) val exceptions: RegisterUserResponseClasses.Exceptions?,
        @SerializedName("attribute_name") val attributeName: Boolean?
)

object RegisterUserResponseClasses {
    data class Exceptions( // <***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>
        @SerializedName(ApiResponseConstant.MISSING_PARAM) val missingParam: String?,
        @SerializedName(ApiResponseConstant.INVALID_VALUE_OF_PARAM) val invalidValueOfParam: String?,
        @SerializedName("failed_to_save_image") val failedToSaveImage: Boolean?,
        @SerializedName("user_with_this_email_already_exist") val userWithThisEmailAlreadyExist: Boolean?,
        @SerializedName("failed_to_insert_user_entity") val failedToInsertUserEntity: Boolean?
    ) // </***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>
}
