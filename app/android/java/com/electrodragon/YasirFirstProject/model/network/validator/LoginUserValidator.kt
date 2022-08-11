package com.electrodragon.YasirFirstProject.model.network.validator

import com.electrodragon.YasirFirstProject.model.network.constant.ElectroResponseState
import com.electrodragon.YasirFirstProject.model.network.response.LoginUserData
import com.electrodragon.YasirFirstProject.model.network.core.ElectroResponse
import com.electrodragon.YasirFirstProject.model.network.core.BadRequest
import retrofit2.Response

interface LoginUserValidatorCallbacks {
    fun onResponseUnsuccessful() // <***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>
    fun onUnderMaintenance() // <***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>
    fun onBadRequest(badRequest: BadRequest) // <***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>
    fun onUnauthorized() // <***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>
    fun onInvalidEmail() // <***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>
    fun onDataCompromisedUserEntityNotFound() // <***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>
//    fun onLoginUserMilestoneCompleted(thing: SomeType, thing2: SomeType)
}

class LoginUserValidator {
    companion object {
        fun validate(
            response: Response<ElectroResponse<LoginUserData>>,
            callbacks: LoginUserValidatorCallbacks
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
                            ElectroResponseState.COMPROMISED -> {
                                electroResponse.data?.exceptions?.let { exceptions ->
                                    exceptions.invalidEmail?.let {
                                        callbacks.onInvalidEmail()
                                    }
                                    exceptions.dataCompromisedUserEntityNotFound?.let {
                                        callbacks.onDataCompromisedUserEntityNotFound()
                                    }
                                }
                            }
                            else -> { // OK
                                electroResponse.data?.let { data ->
//                                    data.areThingsWorked?.let {
//                                        callbacks.onLoginUserMilestoneCompleted(thing1, thing2)
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
