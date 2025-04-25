<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {

        $exceptions->report(function (Throwable $e) {
            if (app()->runningInConsole()) return;

            try {
                \App\Models\SystemError::create([
                    'level'   => 'error',
                    'code'    => method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500,
                    'message' => $e->getMessage(),
                    'trace'   => substr($e->getTraceAsString(), 0, 2000),
                    'url'     => request()->fullUrl(),
                    'file'    => $e->getFile(),
                    'line'    => $e->getLine(),
                    'context' => [
                        'ip' => request()->ip(),
                        'user_id' => auth()->id(),
                        'method' => request()->method(),
                        'input' => request()->except(['password', 'password_confirmation']),
                    ],
                ]);
            } catch (Throwable $ex) {
                logger()->error('Błąd przy zapisie błędu systemowego', ['message' => $ex->getMessage()]);
            }
        });

        $exceptions->render(function (Throwable $e) {
            if (config('app.debug')) {
                return null;
            }
            if ($e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
                return response()->view('errors.404', [], 404);
            }
            if ($e instanceof \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException ||
                $e instanceof \Illuminate\Auth\Access\AuthorizationException) {
                return response()->view('errors.403', [], 403);
            }
            if ($e instanceof \Illuminate\Session\TokenMismatchException) {
                return response()->view('errors.419', [], 419);
            }

            return response()->view('errors.500', [], 500);
        });
    })->create();
