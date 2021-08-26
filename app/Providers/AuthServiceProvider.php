<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        
        view()->composer('*', function ($view) 
        {
            Gate::before(function ($user, $ability) {
                if ($user->tipo == 3) {
                    return true;
                }
            });   

            if (Auth::check()) {
                $permissions = DB::table('profile')->where('id',Auth::user()->profile_id)->first();
            
                $permissions->permission = json_decode($permissions->permission);
    
                foreach ($permissions->permission as $permission) {
                    if ($permission->tag == 'usuarios') {
                        Gate::define('usuarios-edit', function(User $user) use ($permission) {                             
                            if ($permission->edit == 1) {
                                return true;                
                            }            
                            return false;
                        });

                        Gate::define('usuarios-view', function(User $user) use ($permission) {
                            if ($permission->list == 1) {
                                return true;
                            }
                            return false;
                        });
        
                        Gate::define('usuarios-remove', function(User $user) use ($permission) {                                
                            if ($permission->remove == 1) {
                                return true;                
                            }            
                            return false;
                        });
        
                        Gate::define('usuarios-create', function(User $user) use ($permission) {                                
                            if ($permission->create == 1) {
                                return true;                
                            }            
                            return false;
                        });
                        
                    }

                    if ($permission->tag == 'permissoes') {
                        Gate::define('permissoes-edit', function(User $user) use ($permission) {                             
                            if ($permission->edit == 1) {
                                return true;                
                            }            
                            return false;
                        });

                        Gate::define('permissoes-view', function(User $user) use ($permission) {
                            if ($permission->list == 1) {
                                return true;
                            }
                            return false;
                        });
        
                        Gate::define('permissoes-remove', function(User $user) use ($permission) {                                
                            if ($permission->remove == 1) {
                                return true;                
                            }            
                            return false;
                        });
        
                        Gate::define('permissoes-create', function(User $user) use ($permission) {                                
                            if ($permission->create == 1) {
                                return true;                
                            }            
                            return false;
                        });
                    }

                    if ($permission->tag == 'horario') {
                        Gate::define('horario-edit', function(User $user) use ($permission) {                             
                            if ($permission->edit == 1) {
                                return true;                
                            }            
                            return false;
                        });

                        Gate::define('horario-view', function(User $user) use ($permission) {
                            if ($permission->list == 1) {
                                return true;
                            }
                            return false;
                        });
        
                        Gate::define('horario-remove', function(User $user) use ($permission) {                                
                            if ($permission->remove == 1) {
                                return true;                
                            }            
                            return false;
                        });
        
                        Gate::define('horario-create', function(User $user) use ($permission) {                                
                            if ($permission->create == 1) {
                                return true;                
                            }            
                            return false;
                        });
                    }

                    if ($permission->tag == 'atendimento') {
                        Gate::define('atendimento-edit', function(User $user) use ($permission) {                             
                            if ($permission->edit == 1) {
                                return true;                
                            }            
                            return false;
                        });

                        Gate::define('atendimento-view', function(User $user) use ($permission) {
                            if ($permission->list == 1) {
                                return true;
                            }
                            return false;
                        });

                        Gate::define('atendimento-remove', function(User $user) use ($permission) {                                
                            if ($permission->remove == 1) {
                                return true;                
                            }            
                            return false;
                        });
        
                        Gate::define('atendimento-create', function(User $user) use ($permission) {                                
                            if ($permission->create == 1) {
                                return true;                
                            }            
                            return false;
                        });
                    }

                    if ($permission->tag == 'processo') {
                        Gate::define('processo-edit', function(User $user) use ($permission) {                             
                            if ($permission->edit == 1) {
                                return true;                
                            }            
                            return false;
                        });

                        Gate::define('processo-view', function(User $user) use ($permission) {
                            if ($permission->list == 1) {
                                return true;
                            }
                            return false;
                        });

                        Gate::define('processo-remove', function(User $user) use ($permission) {                                
                            if ($permission->remove == 1) {
                                return true;                
                            }            
                            return false;
                        });
        
                        Gate::define('processo-create', function(User $user) use ($permission) {                                
                            if ($permission->create == 1) {
                                return true;                
                            }            
                            return false;
                        });
                    }

                    if ($permission->tag == 'fale-conosco') {
                        Gate::define('fale-conosco-edit', function(User $user) use ($permission) {                             
                            if ($permission->edit == 1) {
                                return true;                
                            }            
                            return false;
                        });

                        Gate::define('fale-conosco-view', function(User $user) use ($permission) {
                            if ($permission->list == 1) {
                                return true;
                            }
                            return false;
                        });

                        Gate::define('fale-conosco-remove', function(User $user) use ($permission) {                                
                            if ($permission->remove == 1) {
                                return true;                
                            }            
                            return false;
                        });
        
                        Gate::define('fale-conosco-create', function(User $user) use ($permission) {                                
                            if ($permission->create == 1) {
                                return true;                
                            }            
                            return false;
                        });
                    }

                    if ($permission->tag == 'relatorios') {
                        Gate::define('relatorios-edit', function(User $user) use ($permission) {                             
                            if ($permission->edit == 1) {
                                return true;                
                            }            
                            return false;
                        });

                        Gate::define('relatorios-view', function(User $user) use ($permission) {
                            if ($permission->list == 1) {
                                return true;
                            }
                            return false;
                        });

                        Gate::define('relatorios-remove', function(User $user) use ($permission) {                                
                            if ($permission->remove == 1) {
                                return true;                
                            }            
                            return false;
                        });
        
                        Gate::define('relatorios-create', function(User $user) use ($permission) {                                
                            if ($permission->create == 1) {
                                return true;                
                            }            
                            return false;
                        });
                    }
                
                }
            }
    
 
        });
    }
}
