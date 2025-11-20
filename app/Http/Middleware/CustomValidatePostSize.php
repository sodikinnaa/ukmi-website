<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Symfony\Component\HttpFoundation\Response;

class CustomValidatePostSize
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Set custom post_max_size untuk middleware ini
        $maxSize = $this->getPostMaxSize();

        if ($maxSize > 0 && $request->server('CONTENT_LENGTH') > $maxSize) {
            throw new PostTooLargeException('The POST data is too large. Maximum allowed size is 200MB.');
        }

        return $next($request);
    }

    /**
     * Determine the server 'post_max_size' as bytes.
     * Custom implementation dengan limit 200MB
     *
     * @return int
     */
    protected function getPostMaxSize(): int
    {
        // Coba baca dari ini_get terlebih dahulu
        $postMaxSize = ini_get('post_max_size');
        
        // Jika sudah lebih besar dari 200MB, gunakan nilai tersebut
        $currentMax = $this->parseSize($postMaxSize);
        $customMax = 200 * 1024 * 1024; // 200MB in bytes
        
        // Gunakan yang lebih besar antara nilai PHP dan custom 200MB
        return max($currentMax, $customMax);
    }

    /**
     * Parse size string to bytes
     *
     * @param string $size
     * @return int
     */
    protected function parseSize(string $size): int
    {
        if (is_numeric($size)) {
            return (int) $size;
        }

        $metric = strtoupper(substr($size, -1));
        $size = (int) $size;

        return match ($metric) {
            'K' => $size * 1024,
            'M' => $size * 1024 * 1024,
            'G' => $size * 1024 * 1024 * 1024,
            default => $size,
        };
    }
}

