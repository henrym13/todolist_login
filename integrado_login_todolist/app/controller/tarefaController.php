<?php 

require_once __DIR__ . '/../model/tarefa.php';

class tarefaController{
    private $tarefaModel; 

    public function __construct(){
        $this->tarefaModel = new Tarefa(); 
    }

   
public function index(){

    if(!isset($_SESSION['id'])){
        header("Location: index.php");
        exit;
    }

    $tarefas = $this->tarefaModel->listar($_SESSION['id']);

    include __DIR__ . '/../view/listar.php';
}


   
public function criar(){

    if(!isset($_SESSION['id'])){
        header("Location: index.php");
        exit;
    }

    if(isset($_POST['descricao']) &&
       !empty(trim($_POST['descricao']))){

        $this->tarefaModel->criar(
            $_POST['descricao'],
            $_SESSION['id']
        );
    }

    header("Location: index.php?action=tarefas");
    exit;
}

    
public function excluir(){

    if(!isset($_SESSION['id'])){
        header("Location: index.php");
        exit;
    }

    if(isset($_GET['id'])){
        $this->tarefaModel->excluir(
            $_GET['id'],
            $_SESSION['id']
        );
    }

    header("Location: index.php?action=tarefas");
    exit;
}


   
public function editar(){

    if(!isset($_SESSION['id'])){
        header("Location: index.php");
        exit;
    }

    if(isset($_POST['descricao'], $_POST['id']) &&
       !empty(trim($_POST['descricao']))){

        $this->tarefaModel->editar(
            $_POST['descricao'],
            $_POST['id'],
            $_SESSION['id']
        );
    }

    header("Location: index.php?action=tarefas");
    exit;
}

}

?>