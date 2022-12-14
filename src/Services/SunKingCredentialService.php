<?php

namespace Inensus\SunKingMeter\Meter\Services;


use Inensus\SunKingMeter\Models\SunKingCredential;


class SunKingCredentialService
{
    public function __construct(
       private SunKingCredential $credential
    ) {
    }

    /**
     * This function uses one time on installation of the package.
     *
     */
    public function createCredentials()
    {
        return $this->credential->newQuery()->firstOrCreate(['id' => 1], [
            'user_id' => null,
            'api_key' => null,
        ]);
    }

    public function getCredentials()
    {
        return $this->credential->newQuery()->first();
    }

    public function updateCredentials($credentials, $updateData)
    {
        $credentials->update($updateData);

        return $credentials->fresh();
    }

    public function getById($id)
    {
        return $this->credential->newQuery()->findOrFail($id);
    }

    public function isAccessTokenValid($credential)
    {
        $accessToken = $credential->getAccessToken();
          $tokenExpirationTime = $credential->getExpirationTime();

          return $accessToken && $tokenExpirationTime > time();
    }
}
