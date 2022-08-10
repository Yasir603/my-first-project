package com.electrodragon.YasirFirstProject.di.api_client

import com.electrodragon.YasirFirstProject.model.network.client.ApiClient
import com.electrodragon.YasirFirstProject.model.network.service.*
import dagger.Module
import dagger.Provides
import dagger.hilt.InstallIn
import dagger.hilt.components.SingletonComponent
import retrofit2.Retrofit
import javax.inject.Singleton

@Module
@InstallIn(SingletonComponent::class)
class ApiClientModule {
    @Provides
    @Singleton
    fun provideApiClient(retrofit: Retrofit): ApiClient {
        return ApiClient(
        )
    }
}
