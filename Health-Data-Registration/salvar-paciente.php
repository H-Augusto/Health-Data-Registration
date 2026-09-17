<?php
require_once __DIR__ . '/conexao.php';
require_once __DIR__ . '/criptografia.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Acesso inválido.');
}

$pdo = conectarBD();

try {
    $pdo->beginTransaction();

    $origemRacialCriptografada = criptografar($_POST['origem_racial'] ?? '');
    $religiaoCriptografada     = criptografar($_POST['religiao'] ?? '');

    // Inserção na tabela dados_pessoais
    $stmt = $pdo->prepare("
        INSERT INTO dados_pessoais
            (cpf, nome, data_nascimento, sexo, estado_civil, endereco, telefone, rg, email, sistema_de_saude)
        VALUES
            (:cpf, :nome, :data_nascimento, :sexo, :estado_civil, :endereco, :telefone, :rg, :email, :sistema_de_saude)
    ");
    $stmt->execute([
        ':cpf'              => $_POST['cpf'],
        ':nome'             => $_POST['nome'],
        ':data_nascimento'  => $_POST['data_nascimento'],
        ':sexo'             => $_POST['sexo'],
        ':estado_civil'     => $_POST['estado_civil'] ?: null,
        ':endereco'         => $_POST['endereco'],
        ':telefone'         => $_POST['telefone'],
        ':rg'               => $_POST['rg'],
        ':email'            => $_POST['email'],
        ':sistema_de_saude' => $_POST['sistema_de_saude'] ?? 'Particular',
    ]);

    $cpf = $_POST['cpf'];

    // Inserção na tabela dado_sensivel
    $stmt = $pdo->prepare("
        INSERT INTO dado_sensivel (cpf, origem_racial, religiao)
        VALUES (:cpf, :origem_racial, :religiao)
    ");
    $stmt->execute([
        ':cpf'           => $cpf,
        ':origem_racial' => $origemRacialCriptografada,
        ':religiao'      => $religiaoCriptografada,
    ]);

   // Inserção na tabela dados_saude
    $stmt = $pdo->prepare("
        INSERT INTO dados_saude
            (cpf, exames, anamnese, pressao_arterial, peso, frequencia_cardiaca,
             relatorios_clinicos, medicamentos_em_uso, diagnosticos)
        VALUES
            (:cpf, :exames, :anamnese, :pressao_arterial, :peso, :frequencia_cardiaca,
             :relatorios_clinicos, :medicamentos_em_uso, :diagnosticos)
    ");
    $stmt->execute([
        ':cpf'                  => $cpf,
        ':exames'               => $_POST['exames'] ?: null,
        ':anamnese'             => $_POST['anamnese'] ?: null,
        ':pressao_arterial'     => $_POST['pressao_arterial'] ?: null,
        ':peso'                 => $_POST['peso'] ?: null,
        ':frequencia_cardiaca'  => $_POST['frequencia_cardiaca'] ?: null,
        ':relatorios_clinicos'  => $_POST['relatorios_clinicos'] ?: null,
        ':medicamentos_em_uso'  => $_POST['medicamentos_em_uso'] ?: null,
        ':diagnosticos'         => $_POST['diagnosticos'] ?: null,
    ]);

    // Inserção na tabela historico_medico
    $stmt = $pdo->prepare("
        INSERT INTO historico_medico
            (cpf, doenca_cronica, tratamentos, hospitalizacao, procedimentos_realizados)
        VALUES
            (:cpf, :doenca_cronica, :tratamentos, :hospitalizacao, :procedimentos_realizados)
    ");
    $stmt->execute([
        ':cpf'                      => $cpf,
        ':doenca_cronica'           => $_POST['doencas_cronicas'] ?? '',
        ':tratamentos'              => $_POST['tratamentos_anteriores'] ?? '',
        ':hospitalizacao'           => $_POST['hospitalizacoes'] ?? '',
        ':procedimentos_realizados' => $_POST['procedimentos_realizados'] ?: null,
    ]);

    $pdo->commit();
    echo "Cadastro salvo com sucesso! Os dados sensíveis foram gravados criptografados.";

} catch (Exception $e) {
    $pdo->rollBack();
    echo "Erro ao salvar cadastro: " . $e->getMessage();
}