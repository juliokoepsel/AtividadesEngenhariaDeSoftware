<?php
require_once './model/Administrador.php';
require_once './model/DaoAdministrador.php';
require_once './control/ControlAdministrador.php';
$ctrlAdmin = new ControlAdministrador();
session_start();
if (!$_SESSION['email'] || $_SESSION['email'] != $ctrlAdmin->selecionar(1)->email) {
    header("Location: index.php");
}

require_once './model/Cliente.php';
require_once './model/DaoCliente.php';
require_once './control/ControlCliente.php';

$control = new ControlCliente();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($control->inserir($_POST['cpf'], $_POST['nome'], $_POST['nascimento'], $_POST['endereco'], $_POST['email'], $_POST['senha'])) {
        $mensagem = "Cliente registrado com sucesso";
        unset($_POST);
    } else {
        $erros = "";
        foreach ($control->getErros() as $e) {
            $erros = $erros . $e . "<br>";
        }
    }
}

$yesterday = date("Y-m-d", strtotime('yesterday'));

?>
<!DOCTYPE HTML>
<html lang="en">
    
    <?php include 'head.php'; ?>
    
    <body>

        <?php include 'header.php'; ?>

        <section class="bg-6 h-500x main-slider pos-relative">
            <div class="triangle-up pos-bottom"></div>
            <div class="container h-100">
                <div class="dplay-tbl">
                    <div class="dplay-tbl-cell center-text color-white pt-90">
                        <h5><b>A MELHOR PIZZA DO MUNDO</b></h5>
                        <h3 class="mt-30 mb-15">Registrar Cliente</h3>
                    </div><!-- dplay-tbl-cell -->
                </div><!-- dplay-tbl -->
            </div><!-- container -->
        </section>

        <section class="story-area left-text center-sm-text">
            <div class="container">
                <div class="heading">
                    <img class="heading-img" src="images/heading_logo.png" alt="">
                    <h2>Registrar Cliente</h2>
                    <?php if (isset($mensagem)) { ?>
                        <div class="alert alert-success">
                            <h5 class="mt-10 mb-30"><?php echo $mensagem; ?></h5>
                        </div>
                    <?php } ?>
                    <?php if (isset($erros)) { ?>
                        <div class="alert alert-danger">
                            <h5 class="mt-10 mb-30"><?php echo $erros; ?></h5>
                        </div>
                    <?php } ?>
                </div>

                <form action="" method="POST" id="form" class="form-style-1 placeholder-1">
                    <div class="row">
                        <div class="col-md-6">CPF: <br> <input class="mb-20" name="cpf" id="cpf" required="required" type="text" placeholder="CPF" value="" maxlength="11">  </div>
                        <div class="col-md-6">Nome: <br> <input class="mb-20" name="nome" id="nome" required="required" type="text" placeholder="Nome" value="">  </div>
                        <div class="col-md-6">Nascimento: <br> <input class="mb-20" name="nascimento" id="nascimento" required="required" type="date" placeholder="Nascimento" value="<?php echo $yesterday; ?>" max="<?php echo $yesterday; ?>">  </div>
                        <div class="col-md-6">Endereço: <br> <input class="mb-20" name="endereco" id="endereco" required="required" type="text" placeholder="Endereço" value="">  </div>
                        <div class="col-md-6">Email: <br> <input class="mb-20" name="email" id="email" required="required" type="email" placeholder="Email" value="">  </div>
                        <div class="col-md-6">Senha: <br> <input class="mb-20" name="senha" id="senha" required="required" type="password" placeholder="Senha" value="">  </div>
                    </div><!-- row -->
                    <div style="text-align: center">
                        <button type="submit" style="color: white"><h6 class="center-text mtb-30"><a class="btn-primaryc plr-25"><b>REGISTRAR</b></a></h6></button>
                    </div>
                </form>
            </div><!-- container -->
        </section>

        <?php include 'footer.php'; ?>

        <!-- SCIPTS -->
        <script src="plugin-frameworks/jquery-3.2.1.min.js"></script>
        <script src="plugin-frameworks/bootstrap.min.js"></script>
        <script src="plugin-frameworks/swiper.js"></script>
        <script src="common/scripts.js"></script>

    </body>
</html>