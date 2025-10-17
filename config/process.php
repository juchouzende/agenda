<?php

  session_start();

  include_once("connection.php");
  include_once("url.php");

  $data = $_POST;

  // MODIFICAÇÕES NO BANCO
  if(!empty($data)) {

    // Criar contato
    if($data["type"] === "create") {

      $name = $data["name of the pet"];
      $name = $data["name of the responsable"];
      $name = $data["pet breed"];
      $phone = $data["phone"];
      $observations = $data["observations"];

      $query = "INSERT INTO contacts (name, phone, observations) VALUES (:name, :phone, :observations)";

      $stmt = $conn->prepare($query);

      $stmt->bindParam(":name of the pet", $name);
      $stmt->bindParam(":name of the responsable", $name);
      $stmt->bindParam(":pet breed", $name);
      $stmt->bindParam(":phone", $phone);
      $stmt->bindParam(":observations", $observations);

      try {

        $stmt->execute();
        $_SESSION["msg"] = "Paciente registrado com sucesso!";
    
      } catch(PDOException $e) {
        // erro na conexão
        $error = $e->getMessage();
        echo "Erro: $error";
      }

    } else if($data["type"] === "edit") {

      $name = $data["name of the pet"];
      $name = $data["name of the responsable"];
      $name = $data["pet breed"];
      $phone = $data["phone"];
      $observations = $data["observations"];
      $id = $data["id"];

      $query = "UPDATE contacts 
                SET name = :nome do pet, phone = :phone, observations = :observations 
                WHERE id = :id";

      $stmt = $conn->prepare($query);

      $stmt->bindParam(":name of the pet", $name);
      $stmt->bindParam(":name of the responsable", $name);
      $stmt->bindParam(":pet breed", $name);
      $stmt->bindParam(":phone", $phone);
      $stmt->bindParam(":observations", $observations);
      $stmt->bindParam(":id", $id);

      try {

        $stmt->execute();
        $_SESSION["msg"] = "Paciente atualizado com sucesso!";
    
      } catch(PDOException $e) {
        // erro na conexão
        $error = $e->getMessage();
        echo "Erro: $error";
      }

    } else if($data["type"] === "delete") {

      $id = $data["id"];

      $query = "DELETE FROM contacts WHERE id = :id";

      $stmt = $conn->prepare($query);

      $stmt->bindParam(":id", $id);
      
      try {

        $stmt->execute();
        $_SESSION["msg"] = "Paciente removido com sucesso!";
    
      } catch(PDOException $e) {
        // erro na conexão
        $error = $e->getMessage();
        echo "Erro: $error";
      }

    }

    // Redirect HOME
    header("Location:" . $BASE_URL . "../index.php");

  // SELEÇÃO DE DADOS
  } else {
    
    $id;

    if(!empty($_GET)) {
      $id = $_GET["id"];
    }

    // Retorna o dado de um contato
    if(!empty($id)) {

      $query = "SELECT * FROM contacts WHERE id = :id";

      $stmt = $conn->prepare($query);

      $stmt->bindParam(":id", $id);

      $stmt->execute();

      $contact = $stmt->fetch();

    } else {

      // Retorna todos os contatos
      $contacts = [];

      $query = "SELECT id, name as 'nome do pet', phone, observations FROM contacts";

      $stmt = $conn->prepare($query);

      $stmt->execute();
      
      $contacts = $stmt->fetchAll();

    }

  }

  // FECHAR CONEXÃO
  $conn = null;