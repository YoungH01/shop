<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .bg-image-vertical {
            position: relative;
            overflow: hidden;
            background-repeat: no-repeat;
            background-position: right center;
            background-size: auto 100%;
        }

        @media (min-width: 1025px) {
            .h-custom-2 {
                height: 100%;
            }
        }
    </style>
    <title>Document</title>
</head>
<body>
    
    <section class="vh-100">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6 text-black">
      
              <div class="px-5 ms-xl-4">
                <i class="fas fa-crow fa-2x me-3 pt-5 mt-xl-4" style="color: #709085;"></i>
                <span class="h1 fw-bold mb-0">BDHH</span>
              </div>
      
              <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">
      
                <form style="width: 23rem;" method="POST" action="{{route('login.implement')}}">
                @csrf
                  <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Log in</h3>
                  @if ($errors->has('message'))
                    <div class="bg-warning p-2 mb-3">
                        <span class="text-danger">{{ $errors->first('message') }}</span>
                    </div>
                  @endif
                  <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="form2Example18">Email address</label>
                    <input type="text" id="form2Example18" name="email" value="{{old('email')}}" class="form-control form-control-lg" />
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                  </div>
      
                  <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="form2Example28">Password</label>
                    <input type="password" name="password" id="form2Example28"  class="form-control form-control-lg" />
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                  </div>
      
                  <div class="pt-1 mb-4">
                    <button class="btn btn-info btn-lg btn-block" style="width: 100%" type="submit">Login</button>
                  </div>
      
                  <p class="small mb-5 pb-lg-2"><a class="text-muted" href="#!">Forgot password?</a></p>      
                </form>
      
              </div>
            </div>
            <div class="col-sm-6 px-0 d-none d-sm-block">
              <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img3.webp"
                alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
            </div>
          </div>
        </div>
      </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>