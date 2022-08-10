package com.electrodragon.YasirFirstProject_admin.provider

class ElectroLibAccessProvider {
    external fun getMasterKey(): String
    external fun getSecretKey(): String
    external fun getServerBaseUrl(): String
    external fun getServerApiKey(): String

    companion object {
        init {
            System.loadLibrary("electro_lib")
        }
    }
}
