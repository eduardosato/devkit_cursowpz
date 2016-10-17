<?php

/* CONTATO */ 
class enviarEmail{

    var $to;
    var $subject;
    var $cc;
    var $nome;
    var $telefone;
    var $assunto;
    var $email;
    var $mensagem;

    public function EnviarContato(){

        //Para quem vai
        $to = $this->to;

        //Assunto
        $subject = $this->subject;

        //headers
        $headers = "From: " . strip_tags($this->email) . "\r\n";
        $headers .= "Reply-To: ". strip_tags($this->email) . "\r\n";
        $headers .= "CC: {$this->cc}\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        //mensagens
        $message = '<html><body>';
        $message .= "<strong>Contato recebido pelo site</strong>";
        $message .= "<p><strong>Nome: </strong>{$this->nome}</p>";
        $message .= "<p><strong>E-mail: </strong>{$this->email}</p>";
        $message .= "<p><strong>Telefone: </strong>{$this->telefone}</p>";
        $message .= "<p><strong>Assunto: </strong>{$this->assunto}</p>";
        $message .= "<p><strong>Mensagem: </strong>{$this->mensagem}</p>";
        $message .= '</body></html>';
        
        if(mail($to, $subject, $message, $headers)){
            echo "<script>swal('Obrigado!', 'em breve entraremos em contato!', 'success')</script>";
        } else {
            echo "<script>swal('Erro!', 'Tente novamente mais tarde!', 'error')</script>";
        }


    }

}
if($_POST['nome'] && $_POST['telefone'] && $_POST['email'] && $_POST['msg'] && $_POST['g-recaptcha-response']){
    $envia = new enviarEmail;
    $envia->nome = $_POST['nome'];
    $envia->telefone = $_POST['telefone'];
    $envia->assunto = $_POST['assunto'];
    $envia->email = $_POST['email'];
    $envia->mensagem = $_POST['msg'];
    $envia->to = "eduardo@eduardosato.com.br";
    $envia->cc = "atendimento@agencia.mobi";
    $envia->subject = "[Lube Hotel] Contato pelo Site";
    $envia->EnviarContato();
}

function upload($upload) {
 
    //Dou novo nome ao arquivo
    $extensao = substr($upload['name'], -3);
    $NovoNome = md5(time() . 'batman') . '.' . $extensao;
    //Caminho upload
    if ($local) {
        $caminho = $local . "/" . $NovoNome;
    } else {
        $caminho = $_SERVER['DOCUMENT_ROOT'] . "/uploads/$NovoNome";
    }

    //enviar o arquivo
    if (!(copy($upload["tmp_name"], $caminho))) {
        $resposta = "<div class=\"alert alert-error\"><strong>Oh não!</strong> teste novamente mais tarde.</div>";
        die();
    } else {
        return $NovoNome;
    }
}

/* CURRICULO */
class enviarCurriculo{
 
        var $to;
        var $subject;
        var $cc;
        var $nome;
        var $email;
        var $telefone;
        var $celular;
        var $cidade;
        var $mensagem;
        var $anexo;
 
        public function EnviarArquivo(){
 
            //Para quem vai
            $to = $this->to;

            //Assunto
            $subject = $this->subject;

            //headers
            $headers = "From: " . strip_tags($this->email) . "\r\n";
            $headers .= "Reply-To: ". strip_tags($this->email) . "\r\n";
            $headers .= "CC: {$this->cc}\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

            //mensagens
            $message = '<html><body>';
            $message .= "<strong>Curriculo</strong>";
            $message .= "<p><strong>Nome: </strong>{$this->nome}</p>";
            $message .= "<p><strong>E-mail: </strong>{$this->email}</p>";
            $message .= "<p><strong>Telefone: </strong>{$this->telefone}</p>";
            $message .= "<p><strong>Celular: </strong>{$this->celular}</p>";
            $message .= "<p><strong>Cidade: </strong>{$this->cidade}</p>";
            $message .= "<p><strong>Mensagem: </strong>{$this->mensagem}</p>";
            $message .= "{$this->arquivo}";
            $message .= '</body></html>';

            if(mail($to, $subject, $message, $headers)){
                echo "<script>swal('Obrigado!', 'em breve entraremos em contato!', 'success')</script>";
            } else {
                echo "<script>swal('Erro!', 'Tente novamente mais tarde!', 'error')</script>";
            }
        }
 
}
 
if($_POST['nomeC'] && $_POST['telefoneC'] && $_POST['emailC']){
        $envia = new enviarCurriculo;
        $envia->nome = $_POST['nomeC'];
        $envia->email = $_POST['emailC'];
        $envia->telefone = $_POST['telefoneC'];
        $envia->celular = $_POST['celular'];
        $envia->cidade = $_POST['cidade'];
        $envia->mensagem = $_POST['msg'];
        if($_FILES['arquivo'][size] > 0){
            $anexo = upload($_FILES['arquivo']);
            $envia->mensagem .= "<p><strong>Arquivo:</strong> <a href='http://www.tecinco.com.br/uploads/".$anexo."'>Arquivo</a></p>";
        }
        $envia->to = "eduardo@eduardosato.com.br";
        $envia->cc = "atendimento@agencia.mobi";
        $envia->subject = "[TECINCO] Curriculo";
        $envia->EnviarArquivo();
}

$conexao = mysql_pconnect(constant('DB_HOST'), constant('DB_USER'), constant('DB_PASSWORD')) or die(mysql_error());
$banco = mysql_select_db(constant('DB_NAME'));

if($_POST['nomenews'] || $_POST['emailnews']){
    $nome = mysql_escape_string($_POST['nomenews']);
    $email = mysql_escape_string($_POST['emailnews']);
    $sql = "INSERT INTO wp_email (nome,email) values ('{$nome}','{$email}')";
    $query = mysql_query($sql) or die(mysql_error());
    if($query){
        echo "<script>swal('Obrigado!', 'Seu e-mail foi adicionado!', 'success')</script>";
    }else{
        echo "<script>swal('Erro!', 'Tente novamente mais tarde!', 'error')</script>";
    }
}

?>