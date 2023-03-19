<?php

namespace Tombenevides\Metavel\Traits;

use Closure;
use Illuminate\Support\Facades\Pipeline;

trait UrlGenerator
{
    public function getUrl(string $type, int $resource, array $params, bool $bordered, bool $titled, string $theme): string
    {
        $token = $this->getToken($type, $resource, $params);

        return config('metavel.base_url')
            ."/embed/$type/"
            .$token
            ."#bordered=$bordered&titled=$titled&theme=$theme";
    }

    private function getToken(string $type, int $resource, array $params): string
    {
        $payload = json_encode(
            [
                'resource' => [$type => $resource],
                'params' => $params,
                'exp' => config('metavel.expiration_time')
            ],
            JSON_FORCE_OBJECT
        );

        return $this->generateJwt($payload);
    }

    private function generateJwt(string $payload): string
    {
        return Pipeline::send($payload)
            ->through([
                function (string $payload, Closure $next) {
                    return $next($this->createBase64($payload));
                },
                function (string $payload, Closure $next) {
                    $headerInfo = json_encode([
                        "alg" => "HS256",
                        "typ" => "JWT"
                    ]);

                    return $next($this->createBase64($headerInfo) .'.'.$payload);
                },
                function (string $payload, Closure $next) {
                    $signature = hash_hmac('sha256', $payload, config('metavel.secret_key'), true);

                    return $next($payload .'.'.$this->createBase64($signature));
                }
            ])
            ->thenReturn();
    }

    private function createBase64(string $data): string
    {
        return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($data));
    }
}