<?php

namespace Inensus\SunKingMeter\Http\Controllers;

use Illuminate\Routing\Controller;

use Inensus\MicroStarMeter\Http\Requests\MicroStarCredentialRequest;
use Inensus\MicroStarMeter\Http\Resources\MicroStarResource;
use Inensus\SunKingMeter\Meter\Services\SunKingCredentialService;


class SunKingCredentialController extends Controller
{

    public function __construct(private SunKingCredentialService $credentialService)
    {
    }

    public function show(): MicroStarResource
    {
        return MicroStarResource::make($this->credentialService->getCredentials());
    }
    public function update(MicroStarCredentialRequest $request): MicroStarResource
    {
        $credentials = $this->credentialService->updateCredentials($request->only([
            'id',
            'client_id',
            'client_secret'
        ]));
        return MicroStarResource::make($credentials);
    }
}
