<?php
    //INICIALIZAÇÂO
    require_once("menu.php");
    
    session_start();
    if(!isset($_SESSION["cadastros"])) {
        $_SESSION["cadastros"] = array();
    }
    setlocale(LC_ALL, "pt_BR", "ptb");
    
    //OBTER DADOS DO FORUMLARIO
    $nome = $_REQUEST["nome"];
    $estado = $_REQUEST["estado"];
    $observacoes = $_REQUEST["observacoes"];
    $telefone = $_REQUEST["telefone"];
    $cpf = $_REQUEST["cpf"];
    $email = $_REQUEST["email"];
    $site = $_REQUEST["site"];
    $data = $_REQUEST["data"];
    
    
    
    $sexo = null;
    if(isset($_REQUEST["sexo"])){
        $sexo = $_REQUEST["sexo"];
    }
    
    $aceito = false;
    if(isset($_REQUEST["aceito"])) {
        $aceito = true;
    }
    
    //VALIDAÇÃO
    $camposValidados = true;
    
    if($sexo == null){
        echo "Selecione uma opcao para o campo sexo ! <br/>";
        $camposValidados = false;
    }
    
    if($estado== -1){
        echo "Por favor , selecione uma opcao para o estado ! <br/>";
        $camposValidados = false;
    }
    
    
    $nome = trim ($nome);
    if(empty($nome)){
        echo "Preencha o nome no campo ! <br/>";
        $camposValidados = false;
    }
    
    if(!ctype_alpha ($nome)){
        echo "Digite somente letras !<br/>";
        $camposValidados = false;        
    }
    
    $observacoes = trim ($observacoes);
    if(empty($observacoes)){
        echo "Preencha as observacoes no campo ! <br/>";
        $camposValidados = false;
    }
    
    else if(!ctype_alnum ($observacoes)){
        echo "Digite letras e numeros !<br/>";
        $camposValidados = false;        

    }
    
    $telefone = trim ($telefone);
    if(empty($telefone)){
        echo "Preencha o telefone no campo ! <br/>";
        $camposValidados = false;
    }
    
    \\expressoes regulares
    
    else if(preg_match("/^\d{4}-\d{4}$/", $telefone)){
        echo "O formato do telefone está inválido. <br/> Por favor digite novamente!";
        $camposValidados = false;
    }
    
    if(!ctype_digit ($telefone)){
        echo "Digite somente numeros !<br/>";
        $camposValidados = false;
    }

    
    $cpf = trim ($cpf);
    if(empty($cpf)){
        echo "Preencha o cpf no campo ! <br/>";
        $camposValidados = false;
    }
  
  \\expressoes regulares
  
    else if(!preg_match("/^\d{3}\\.\d{3}\\.\d{3}\\-\d{2}$/", $cpf)) {
        echo "O formato do cpf está inválido. <br/> Por favor digite novamente!";
        $camposValidados = false;
    }
    
    $email = trim ($email);
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        echo "Email invalido! <br/>";
            $camposValidados = false;
    }
        
    $site = trim ($site);
    if(!filter_var($site,FILTER_VALIDATE_URL)){
        echo "Site invalido! <br/>";
            $camposValidados = false;
        }
        
    $data = trim($data);
    if(empty($data)) {
        echo "Preencha o campo data !<br/>";
        $camposValidados = false;
    }
    
    \\expressoes regulares
    
    else if(!preg_match("/^\d{2}\\/\d{2}/\d{4}$/", $data)) {
        echo "O formato da data está inválido. <br/> Utilize o formato dd/mm/aaaa";
        $camposValidados = false;
    }
    
    
    //CADASTRO
    if($camposValidados){
        $pessoa = array();
        $pessoa["nome"] = $nome;
        $pessoa["sexo"] = $sexo;
        $pessoa["aceito"] = $aceito;
        $pessoa["estado"] = $estado;
        $pessoa["observacoes"] = $observacoes;
        $pessoa["telefone"] = $telefone;
        $pessoa["cpf"] = $cpf;
        $pessoa["email"] = $email;
        $pessoa["site"] = $site;
        $pessoa["data"] = $data;
        

        
        array_push($_SESSION["cadastros"], $pessoa);
        
        echo "Cadastro efetuado com sucesso. <br/>Cadastre outra pessoa!";
    }
    else{
        echo "<br/>";
        echo "<input type='button' value='Voltar' onclick='history.go(-1)' />";
    }
?>
