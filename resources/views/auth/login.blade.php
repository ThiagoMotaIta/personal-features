<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ env('APP_NAME')}}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- BOOTSTRAP 5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

        <!-- FONTAWESOME -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Scripts Gerais -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    </head>
    <body>

        <section class="h-100 gradient-form" style="background-color: #eee;">
            <div class="container py-5 h-100">
              <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                  <div class="card rounded-3 text-black">
                    <div class="row g-0">
                      <div class="col-lg-6">
                        <div class="card-body p-md-5 mx-md-4">

                          <div class="text-center">
                            <img src="img/logo.png"
                              style="width: 185px;" alt="logo">
                            <h4 class="mt-1 mb-5 pb-1">LOGIN VENDEDOR</h4>
                          </div>

                          <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <p>
                                <!-- Session Status -->
                                <small><x-auth-session-status class="alert alert-danger" :status="session('status')" /></small>

                                <!-- Validation Errors -->
                                <small><x-auth-validation-errors class="alert alert-danger" :errors="$errors" /></small>
                            </p>

                            <div class="form-outline mb-4">
                              <x-label for="email" :value="__('Email')" />
                              <x-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus />
                            </div>

                            <div class="form-outline mb-4">
                                <x-label for="password" :value="__('Password')" />
                                <x-input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
                            </div>

                            <div class="text-left pt-1 mb-3 pb-1">
                                <x-button type="submit" class="btn btn-primary">
                                   <i class="fa fa-sign-in"></i> Entrar
                                </x-button>
                            </div>

                            <hr/>

                            <div class="d-flex align-items-center justify-content-center pb-4">
                              <p class="mb-0 me-2">Ainda não tem conta?</p>
                              <a class="btn btn-outline-danger" href="register"><i class="fa fa-user"></i> Criar</a>
                            </div>

                          </form>

                        </div>
                      </div>
                      <div class="col-lg-6 d-flex align-items-center alert-primary">
                        <div class="text-primary px-3 py-4 p-md-5 mx-md-4">
                          <h4 class="mb-4">BEM-VINDO(A)</h4>
                          <p class="small mb-0">Este é o portal de oportunidades de vendas da <strong>VITAMINAWEB</strong>. Faça seu login ou caso ainda não possua uma conta, crie uma.</p>
                          <br/>
                          <a href="./" class="btn btn-sm btn-light">
                            <i class="fa fa-arrow-left"></i> Voltar
                         </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </section>

    </body>
</html>
