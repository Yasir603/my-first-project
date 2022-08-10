package com.electrodragon.YasirFirstProject_admin.model.network.validator

import com.electrodragon.YasirFirstProject_admin.model.network.constant.ElectroResponseState
import com.electrodragon.YasirFirstProject_admin.model.network.response.RegisterUserData
import com.electrodragon.YasirFirstProject_admin.model.network.core.ElectroResponse
import com.electrodragon.YasirFirstProject_admin.model.network.core.BadRequest
import retrofit2.Response

interface RegisterUserValidatorCallbacks {
    fun onResponseUnsuccessful() // <***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>
    fun onUnderMaintenance() // <***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>
    fun onBadRequest(badRequest: BadRequest) // <***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>
    fun onUnauthorized() // <***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>
    fun onFailedToSaveImage() // <***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>
    fun onUserWithThisEmailAlreadyExist() // <***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>
    fun onFailedToInsertUserEntity() // <***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>
//    fun onRegisterUserMilestoneCompleted(thing: SomeType, thing2: SomeType)
}

class RegisterUserValidator {
    companion object {
        fun validate(
            response: Response<ElectroResponse<RegisterUserData>>,
            callbacks: RegisterUserValidatorCallbacks
        ) {
            when {
                response.isSuccessful -> {
                    response.body()?.let { electroResponse ->
                        when (electroResponse.responseState) {
                            ElectroResponseState.UNDER_MAINTENANCE -> callbacks.onUnderMaintenance()
                            ElectroResponseState.BAD_REQUEST -> {
                                val badRequest = BadRequest()
                                electroResponse.data?.exceptions?.let { exceptions ->
                                    exceptions.missingParam?.let { missingParam ->
                                        badRequest.missingParam = missingParam
                                    }
                                     exceptions.invalidValueOfParam?.let { invalidValueOfParam ->
                                         badRequest.invalidValueOfParam = invalidValueOfParam
                                     }
                                }
                                callbacks.onBadRequest(badRequest)
                            }
                            ElectroResponseState.UNAUTHORIZED -> {
                                callbacks.onUnauthorized()
                            }
                            ElectroResponseState.FAILURE -> {
                                electroResponse.data?.exceptions?.let { exceptions ->
                                    exceptions.failedToSaveImage?.let {
                                        callbacks.onFailedToSaveImage()
                                    }
                                    exceptions.userWithThisEmailAlreadyExist?.let {
                                        callbacks.onUserWithThisEmailAlreadyExist()
                                    }
                                    exceptions.failedToInsertUserEntity?.let {
                                        callbacks.onFailedToInsertUserEntity()
                                    }
                                }
                            }
                            else -> { // OK
                                electroResponse.data?.let { data ->
//                                    data.areThingsWorked?.let {
//                                        callbacks.onRegisterUserMilestoneCompleted(thing1, thing2)
//                                    }
                                }
                            }
                        }
                    }
                }
                else -> callbacks.onResponseUnsuccessful()
            }
        }
    }
}
