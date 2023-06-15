<?php
    require_once 'class-pessoa.php';
    $p = new Pessoa("crudpdo","localhost","root","123456");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Pessoa</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <?php
        if(isset($_POST['nome'])){
            $nome = addslashes($_POST['nome']);
            $telefone = addslashes($_POST['telefone']);
            $email = addslashes($_POST['email']);
            if(!empty($nome) && !empty($telefone) && !empty($email)){
                if(!$p->cadastrarPessoa($nome,$telefone,$email)){
                    echo "Email já cadastrado!";
                } 
               
               
            }else{
                echo "Preencha todos os campos";
            }
        }
    ?>
    <section id="esquerda">
        
        <form method="POST">
        <h2>Cadastrar Pessoa</h2>
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome">
            <label for="telefone">telefone</label>
            <input type="text" name="telefone" id="telefone">
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
            <input type="submit" value="Cadastrar">
        </form>
    </section>
    <section id="direita">
    <table>
            <tr>
                <th>NOME</th>
                <th>TELEFONE</th>
                <th>EMAIL</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
        <?php
            $dados = $p->buscarDados();
          if(count($dados) > 0){
            for ($i=0; $i < count($dados); $i++) { 
                echo "<tr>";
                foreach ($dados[$i] as $key => $value) {
                    if($key != "id"){
                        echo "<td>".$value."</td>";
                    }
                }
                ?>
                

                <td><a href="#">Editar</a></td>
                <td><a href="index.php?id=<?php echo $dados[$i]['id']; ?>">Excluir</a></td>
            <?php
                echo "<tr>";
            }
          
            }else{
                echo "Não existe pessoas cadastradas!";
            }
        ?>
       
            
        </table>
    </section>
</body>
</html>

<?php  
    if(isset($_GET['id'])){
        $id_pessoa = addslashes($_GET['id']);
        $p->excluirPessoa($id_pessoa);
        header("location: index.php");
    }
?>