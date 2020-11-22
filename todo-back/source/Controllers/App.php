<?php

namespace Source\Controllers;

use PDO;
use PDOException;
use Source\Models\Banco;

class App
{
    public function index()
    {
        $tarefas = Banco::connect()->query("SELECT * FROM tarefas");
        echo json_encode($tarefas->fetchAll(PDO::FETCH_ASSOC)); 
    }

    public function deletarTarefa($data)
    {
        $idTarefa  = $data['id'];
        $deletar = Banco::connect()->prepare("DELETE FROM tarefas WHERE id = :id");
        $deletar->bindParam(":id", $idTarefa);
        $deletar->execute();
        if ($deletar-> rowCount() ==0){
            echo json_encode([
                "sucesso" => false,
                "mensagem" => "nenhuma tarefa encontrado com o id informado"
            ]);
        } else {
            echo json_encode([
                "sucesso" => true,
                "mensagem" => "tarefa deletada com sucesso"
            ]);
        }
    }
    public function cadastrar($data){
        $cadastrar = Banco::connect()->prepare("INSERT INTO tarefas VALUES(null, :tarefa, 'incompleta' , 'N')");
        $cadastrar->bindParam(":tarefa", $data['tarefa']);
        if($cadastrar->execute()){
            echo json_encode([
                "sucesso" => true,
                "mensagem" => "tarefa cadastrada com sucesso"
            ]);
        } else {
            echo json_encode([
                "sucesso" => false,
                "mensagem" => "Erro ao cadastrar tarefa"
            ]);
        }
    }
}
