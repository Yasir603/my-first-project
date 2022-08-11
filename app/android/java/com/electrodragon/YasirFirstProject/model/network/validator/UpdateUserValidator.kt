package com.electrodragon.YasirFirstProject.model.network.validator

import com.electrodragon.YasirFirstProject.model.network.constant.ElectroResponseState
import com.electrodragon.YasirFirstProject.model.network.response.UpdateUserData
import com.electrodragon.YasirFirstProject.model.network.core.ElectroResponse
import com.electrodragon.YasirFirstProject.model.network.core.BadRequest
import retrofit2.Response

interface UpdateUserValidatorCallbacks {
    fun onResponseUnsuccessful() // <***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>
    fun onUnderMaintenance() // <***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>
    fun onBadRequest(badRequest: BadRequest) // <***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>
    fun onUnauthorized() // <***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>
    fun onNoUserFound() // <***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>
    fun onFailedToUpdate() // <***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>
//    fun onUpdateUserMilestoneCompleted(thing: SomeType, thing2: SomeType)
}

class UpdateUserValidator {
    companion object {
        fun validate(
            response: Response<ElectroResponse<UpdateUserData>>,
            callbacks: UpdateUserValidatorCallbacks
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
                                    exceptions.noUserFound?.let {
                                        callbacks.onNoUserFound()
                                    }
                                    exceptions.failedToUpdate?.let {
                                        callbacks.onFailedToUpdate()
                                    }
                                }
                            }
                            else -> { // OK
                                electroResponse.data?.let { data ->
//                                    data.areThingsWorked?.let {
//                                        callbacks.onUpdateUserMilestoneCompleted(thing1, thing2)
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
