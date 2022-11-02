<?php
    session_start();
    $usuarios=[
        'manolo@mail.es'=>['Admin', "pass1"],
        'ana@correo.es'=>['Normal', 'pass2'],
        'lucas@email.es'=>['Normal', 'pass3']
    ];

    if(isset($_POST['btn'])){
        $error=false;
        //procesamos el formulario
        $email=trim($_POST['email']);
        $pass=$_POST['pass'];
        // validaciones básicas
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $error=true;
            $_SESSION['errMail']="*** El email debe tener un formato válido";
        }
        if(strlen($pass)<4){
            $error=true;
            $_SESSION['errPass']="*** El password debe tener al menos 4 caracteres";
        }
        if($error){
            //volvemos a pintar el formulario pero mostrando los errores
            header("Location:main.php");
            die();        
        }
        //validamos al user
        foreach($usuarios as $k=>$v){
            if($k==$email && $v[1]==$pass){
                //exito
                $_SESSION['email']=$email;
                $_SESSION['perfil']=$v[0];
                header("Location:portal.php");
                die();
            }
        }
        $_SESSION['errVal']="*** Email o password incorrectos.";
        header("Location:main.php");


    }else{

    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CDN Bootstrap -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <title>Document</title>
</head>

<body>
    <form name="a" method="POST" action="main.php">
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <div class="mb-md-5 mt-md-4 pb-5">

                                <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                                <p class="text-white-50 mb-5">Please enter your login and password!</p>

                                <div class="form-outline form-white mb-4">
                                    <input type="email" id="typeEmailX" class="form-control form-control-lg" name="email" />
                                    <?php
                                        if(isset($_SESSION['errMail'])){
                                            echo <<<CAD
                                            <div class="mt-2 text-danger" style="font-size:0.75rem">
                                            <b>{$_SESSION['errMail']}</b>
                                            </div>
                                            CAD;
                                            unset($_SESSION['errMail']);
                                        }
                                    ?>
                                    <label class="form-label" for="typeEmailX">Email</label>
                                </div>

                                <div class="form-outline form-white mb-4">
                                    <input type="password" id="typePasswordX" class="form-control form-control-lg" name="pass" />
                                    <?php
                                        if(isset($_SESSION['errPass'])){
                                            echo <<<CAD
                                            <div class="mt-2 text-danger" style="font-size:0.75rem">
                                            <b>{$_SESSION['errPass']}</b>
                                            </div>
                                            CAD;
                                            unset($_SESSION['errPass']);
                                        }
                                    ?>
                                    <label class="form-label" for="typePasswordX">Password</label>
                                </div>



                                <button name="btn" class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>

                                <?php
                                        if(isset($_SESSION['errVal'])){
                                            echo <<<CAD
                                            <div class="mt-2 text-danger">
                                            <b>{$_SESSION['errVal']}</b>
                                            </div>
                                            CAD;
                                            unset($_SESSION['errVal']);
                                        }
                                    ?>

                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
<?php } ?>