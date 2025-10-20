<?php

  namespace App\Providers;

  use Illuminate\Support\Facades\Gate;
  use Illuminate\Support\ServiceProvider;
  
  class AuthServiceProvider extends ServiceProvider
{

  public function boot(): void{
    Gate::define('admin', fn($user) => $user->role === 'admin');
  }

}