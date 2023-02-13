<?php

include __DIR__ . '/includes/funciones.php';
include __DIR__ . '/includes/config/database.php';
$db = conectarDB();
incluirTemplate('header');

if(!$_POST == []){
  
    $mail = filter_var($_POST['mail'],FILTER_SANITIZE_EMAIL);
    $pass = filter_var($_POST['pass'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $errores = controlarErrores($mail,$pass);

    if(empty($errores)){
        
        
        $sql = "SELECT * FROM usuarios where email = '$mail'";
  
        $resultado = mysqli_query($db,$sql);
        
        $usuario = mysqli_fetch_assoc($resultado);
     
    
        if($mail == $usuario['email']){
          
            
            $passVerified = password_verify($pass,$usuario['pass']); //CONTROLA SI EL HASH DE LA BASE DE DATOS, COINCIDE CON LA CONTRASEÑA QUE ESTAMOS PONIENDO

            if($passVerified){
                session_start();
                $_SESSION['user'] = $usuario['email'];
                $_SESSION['login'] = true;
               header("Location: /admin/index.php");
            }else{
                $errores[]="La password es incorrecta";
            }
        }else{
            $errores[] = "El mail es incorrecto";
        }
    }
    }




function controlarErrores($mail,$pass) :array{
    $errores = [];
    if($mail === ''){
        $errores[] = "Falta ingresar un mail";
    }
    if($pass === ''){
        $errores[] = "Falta ingresar una contraseña";
    }
    return $errores;
}
?>

</header>
<section class="login">

    <div class="containerg-formlog">


        <div class="container-formlog">
    
            <picture>
                <source srcset="/build/img/LOGO.webp" type="image/webp">
                <img loading ="lazy" src="/build/img/LOGO.png" alt="Logo pagina">
            </picture>

            <form class = "form-login" action="#" method="POST">

                <div class="form-mail">
                    <label for="mail">Email</label>
                    <input type="text" name="mail" id="mail" placeholder="tumail@mail.com">
                </div>
            
                <div class="form-correo">
                    <label for="pass">Contraseña</label>
                    <input type="password" name="pass" id="pass" placeholder="password">
                </div>

                <div class="form-login">
                    <input class="btn-rojo" type="submit" name="btnLogin" id="btnLogin">
                </div>

            </form>

                    <div class="container-errores">
                        <?php if(!empty($errores)){
                                foreach ($errores as $error) {?>
                                <p><?php echo $error?></p>
                        <?php }}?>
                    </div>
        </div>


            <div class="fondo">
                <picture>
                
                    <source srcset="/build/img/catalogo.webp" type="image/webp">
                    <img loading ="lazy" src="/build/img/catalogo.jpg" alt="imagen catalogo">
                </picture>
            </div>

    </div>

     
  
</section>

<?php incluirTemplate('footer');?>