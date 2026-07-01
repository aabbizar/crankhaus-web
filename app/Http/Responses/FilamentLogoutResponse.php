<?php

namespace App\Http\Responses;

use Filament\Http\Responses\Auth\Contracts\LogoutResponse as LogoutResponseContract;
use Illuminate\Http\RedirectResponse;

class FilamentLogoutResponse implements LogoutResponseContract
{
    /**
     * Setelah admin Sign Out dari Filament panel,
     * arahkan ke halaman utama katalog (/) bukan ke /admin/login.
     */
    public function toResponse($request): RedirectResponse
    {
        return redirect()->to('/');
    }
}
