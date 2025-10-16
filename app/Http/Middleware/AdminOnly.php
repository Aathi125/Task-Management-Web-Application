public function handle(Request $request, Closure $next) {
  abort_unless(auth()->check() && auth()->user()->role === 'admin', 403);
  return $next($request);
}