<?php

use App\Http\Middleware\TokenMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Process\Process;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware(TokenMiddleware::class)->group(function () {
    Route::get("/email/create", function () {
        $email = escapeshellarg(request()->get("email"));
        $password = escapeshellarg(request()->get("password"));
        Process::fromShellCommandline("cd /app && ./setup.sh email add {$email} {$password}")->run();
        Process::fromShellCommandline("cd /app && ./setup.sh config dkim")->run();
        return "Unknown";
    });

    Route::get("/email/update", function () {
        $email = escapeshellarg(request()->get("email"));
        $password = escapeshellarg(request()->get("password"));
        Process::fromShellCommandline("cd /app && ./setup.sh email update {$email} {$password}")->run();
        return "Unknown";
    });

    Route::get("/email/delete", function () {
        $email = escapeshellarg(request()->get("email"));
        Process::fromShellCommandline("cd /app && ./setup.sh email del {$email}")->run();
        return "Unknown";
    });

    Route::get("/email/alias/create", function () {
        $email = escapeshellarg(request()->get("email"));
        $recipient = escapeshellarg(request()->get("recipient"));
        Process::fromShellCommandline("cd /app && ./setup.sh email add {$email} {$recipient}")->run();
        Process::fromShellCommandline("cd /app && ./setup.sh config dkim")->run();
        return "Unknown";
    });

    Route::get("/email/alias/delete", function () {
        $email = escapeshellarg(request()->get("email"));
        $recipient = escapeshellarg(request()->get("recipient"));
        Process::fromShellCommandline("cd /app && ./setup.sh alias del {$email} {$recipient}")->run();
        return "Unknown";
    });
});
