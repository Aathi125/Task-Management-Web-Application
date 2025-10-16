use Illuminate\Support\Facades\Gate;

public function boot(): void{
  Gate::define('admin', fn($user) => $user->role === 'admin');
}