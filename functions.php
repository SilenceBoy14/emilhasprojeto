<?php
require 'db.php';

// Função para obter todas as cidades
function getCidades() {
    global $con;
    $result = $con->query("SELECT * FROM cidades");
    
    $cidades = [];
    while ($row = $result->fetch_assoc()) {
        $cidades[] = $row; // Adiciona cada cidade ao array
    }
    
    return $cidades;
}

// Função para adicionar uma cidade
function addCidade($nome, $estado) {
    global $con;
    $stmt = $con->prepare("INSERT INTO cidades (nome, estado) VALUES (?, ?)");
    $stmt->bind_param("ss", $nome, $estado);  // 'ss' significa dois parâmetros do tipo string
    $stmt->execute();
    $stmt->close();
}

// Função para obter as melhorias de uma cidade
function getMelhoriasByCidade($idCidade) {
    global $con;
    $stmt = $con->prepare("SELECT * FROM melhorias WHERE id_cidade = ? ORDER BY data_criacao DESC");
    $stmt->bind_param("i", $idCidade);  // 'i' significa um parâmetro do tipo inteiro
    $stmt->execute();
    
    $result = $stmt->get_result();
    $melhorias = [];
    while ($row = $result->fetch_assoc()) {
        $melhorias[] = $row; // Adiciona cada melhoria ao array
    }
    
    $stmt->close();
    return $melhorias;
}

// Função para registrar uma melhoria
function addMelhoria($idCidade, $titulo, $descricao, $categoria,$datapub) {
    global $con;
    $stmt = $con->prepare("INSERT INTO melhorias (id_cidade, titulo, descricao, categoria, data_criacao) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $idCidade, $titulo, $descricao, $categoria,$datapub);  // 'isss' significa: int, string, string, string
    $stmt->execute();
    $stmt->close();
}

// Função para votar em uma melhoria
function votarMelhoria($idMelhoria, $idUsuario, $voto) {
    global $con;
    $stmt = $con->prepare("INSERT INTO votos (id_melhoria, id_usuario, voto) VALUES (?, ?, ?)");
    $stmt->bind_param("iii", $idMelhoria, $idUsuario, $voto); // 'iii' significa três parâmetros do tipo inteiro
    $stmt->execute();
    
    // Atualiza a relevância da melhoria
    $stmt = $con->prepare("UPDATE melhorias SET relevancia = relevancia + 1 WHERE id = ?");
    $stmt->bind_param("i", $idMelhoria);
    $stmt->execute();
    
    $stmt->close();
}

