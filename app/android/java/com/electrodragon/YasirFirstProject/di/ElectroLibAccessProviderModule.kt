package com.electrodragon.YasirFirstProject.di

import com.electrodragon.YasirFirstProject.provider.ElectroLibAccessProvider
import dagger.Module
import dagger.Provides
import dagger.hilt.InstallIn
import dagger.hilt.components.SingletonComponent
import javax.inject.Singleton

@Module
@InstallIn(SingletonComponent::class)
class ElectroLibAccessProviderModule {
    @Provides
    @Singleton
    fun provideElectroLibAccessProviderModule(): ElectroLibAccessProvider {
        return ElectroLibAccessProvider()
    }
}
