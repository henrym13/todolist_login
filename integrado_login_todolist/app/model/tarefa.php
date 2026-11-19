<?php 

require_once __DIR__ . '/../config/database.php';

class Tarefa{
    private $conn; 

    public function __construct(){
        $db = new Database();
        $this->conn = $db->conectar();
    }

    # Listar

    
public function listar($id_u){

    $tarefas = [];

    $sql = "SELECT * FROM tarefas
            WHERE id_u = ?
            ORDER BY data_criacao DESC";

    $stmt = $this->conn->prepare($sql);

    $stmt->bind_param("i", $id_u);

    $stmt->execute();

    $resultado = $stmt->get_result();

    while($row = $resultado->fetch_assoc()){
        $tarefas[] = $row;
    }

    return $tarefas;
}


    # Criar

   
public function criar($descricao, $id_u){

    $sql = "INSERT INTO tarefas (descricao, id_u)
            VALUES (?, ?)";

    $stmt = $this->conn->prepare($sql);

    $stmt->bind_param("si", $descricao, $id_u);

    return $stmt->execute();
}


    #Excluir 

    
public function excluir($id, $id_u){

    $sql = "DELETE FROM tarefas
            WHERE id = ? AND id_u = ?";

    $stmt = $this->conn->prepare($sql);

    $stmt->bind_param("ii", $id, $id_u);

    return $stmt->execute();
}


    # Editar

   
public function editar($descricao, $id, $id_u){

    $sql = "UPDATE tarefas
            SET descricao = ?
            WHERE id = ? AND id_u = ?";

    $stmt = $this->conn->prepare($sql);

    $stmt->bind_param("sii", $descricao, $id, $id_u);

    return $stmt->execute();
}
}

?>