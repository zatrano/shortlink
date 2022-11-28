<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Cache\RateLimiter;
use Illuminate\Support\Facades\DB;

class LinkVisit
{
    /**
     * Sınırlayıcı
     *
     * @var \Illuminate\Cache\RateLimiter
     */
    protected $limiter;

    /**
     * @param \Illuminate\Cache\RateLimiter $limiter
     */
    public function __construct(RateLimiter $limiter)
    {
        $this->limiter = $limiter;
    }

    /**
     * Gelen isteği işle
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param int $hitDelayInMinutes Aynı kullanıcı aynı URL'ye kaç dakika sonra girerse yeni ziyaret sayılacak.
     * @return mixed
     */
    public function handle($request, Closure $next, $hitDelayInMinutes = 60)
    {
        /** @var string $key URL ve ziyaretçi IPsinden oluşturulan anahtar */
        $key = sha1($request->fullUrl() . '|' . $request->ip());

        // Kullanıcı bu url'yi daha önce (1 kere) ziyaret etmemişse
        if (!$this->limiter->tooManyAttempts($key, 1)) {
            // Burada sayfanın ziyaret değerini arttırıyoruz. Örneğin:
            DB::table('short_links')->where('code', $request->segment(1))->increment('visit');
        }

        // Kullanıcının bu URL'yi ziyaret ettiğini önbelleğe işliyoruz. Bir dahaki girişte
        // $hitDelayInMinutes kadar süre geçmemişse ziyaret sayısı artmayacak
        $this->limiter->hit($key, $hitDelayInMinutes);

        // İsteğe devam ediyoruz
        return $next($request);
    }
}