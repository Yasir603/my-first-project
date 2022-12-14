package com.electrodragon.YasirFirstProject_admin.model.network.validator

import com.electrodragon.YasirFirstProject_admin.model.network.constant.ElectroResponseState
import com.electrodragon.YasirFirstProject_admin.model.network.response.CreatePostData
import com.electrodragon.YasirFirstProject_admin.model.network.core.ElectroResponse
import com.electrodragon.YasirFirstProject_admin.model.network.core.BadRequest
import retrofit2.Response

interface CreatePostValidatorCallbacks {
    fun onResponseUnsuccessful() // <***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>
    fun onUnderMaintenance() // <***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>
    fun onBadRequest(badRequest: BadRequest) // <***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>
    fun onUnauthorized() // <***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>
    fun onFailedToInsertUserPost() // <***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>
    fun onNoUserFound() // <***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>
//    fun onCreatePostMilestoneCompleted(thing: SomeType, thing2: SomeType)
}

class CreatePostValidator {
    companion object {
        fun validate(
            response: Response<ElectroResponse<CreatePostData>>,
            callbacks: CreatePostValidatorCallbacks
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
                                }
                            }
                            ElectroResponseState.FAILURE -> {
                                electroResponse.data?.exceptions?.let { exceptions ->
                                    exceptions.failedToInsertUserPost?.let {
                                        callbacks.onFailedToInsertUserPost()
                                    }
                                }
                            }
                            else -> { // OK
                                electroResponse.data?.let { data ->
//                                    data.areThingsWorked?.let {
//                                        callbacks.onCreatePostMilestoneCompleted(thing1, thing2)
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
