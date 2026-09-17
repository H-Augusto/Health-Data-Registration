<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Saúde</title>
</head>
<body>
    <h1>Cadastro de Saúde</h1>
    <form action="salvar-paciente.php" method="POST">
 
        <fieldset>
            <legend>Dados Pessoais</legend>
            <label>Nome</label><br>
            <input type="text" name="nome" required><br><br>
 
            <label>Data de nascimento</label><br>
            <input type="date" name="data_nascimento" required><br><br>
 
            <label>Sexo</label><br>
            <select name="sexo" required>
                <option value="Masculino">Masculino</option>
                <option value="Feminino">Feminino</option>
                <option value="Outro">Outro</option>
            </select><br><br>
 
            <label>Estado civil</label><br>
            <select name="estado_civil">
                <option value="Solteiro(a)">Solteiro(a)</option>
                <option value="Casado(a)">Casado(a)</option>
                <option value="Viuvo(a)">Viúvo(a)</option>
                <option value="Separado(a)">Separado(a)</option>
                <option value="Divorciado(a)">Divorciado(a)</option>
            </select><br><br>
 
            <label>Endereço</label><br>
            <input type="text" name="endereco" required><br><br>
 
            <label>Telefone</label><br>
            <input type="text" name="telefone" required placeholder="(00) 00000-0000"><br><br>
 
            <label>CPF</label><br>
            <input type="text" name="cpf" required placeholder="000.000.000-00"><br><br>
 
            <label>RG</label><br>
            <input type="text" name="rg" required><br><br>
 
            <label>E-mail</label><br>
            <input type="email" name="email" required><br><br>
 
            <label>Convênio ou plano de saúde</label>
            <select name="sistema_de_saude">
                <option value="Convenio medico">Convênio médico</option>
                <option value="Sus">SUS</option>
                <option value="Plano de saude">Plano de saúde</option>
                <option value="Particular">Particular</option>
            </select><br><br>
        </fieldset>
 
        <fieldset>
            <legend>Dados de Saúde</legend>
            <label>Exames</label><br>
            <textarea name="exames"></textarea><br><br>
 
            <label>Anamnese</label><br>
            <textarea name="anamnese"></textarea><br><br>
 
            <label>Pressão arterial</label><br>
            <input type="text" name="pressao_arterial" placeholder="120/80"><br><br>
 
            <label>Peso (kg)</label><br>
            <input type="number" step="0.01" name="peso"><br><br>
 
            <label>Frequência cardíaca (bpm)</label><br>
            <input type="number" name="frequencia_cardiaca"><br><br>
 
            <label>Relatórios clínicos</label><br>
            <textarea name="relatorios_clinicos"></textarea><br><br>
 
            <label>Medicamentos em uso</label><br>
            <textarea name="medicamentos_em_uso"></textarea><br><br>
 
            <label>Diagnósticos</label><br>
            <textarea name="diagnosticos"></textarea>
        </fieldset>
 
        <fieldset>
            <legend>Histórico Médico</legend>
            <label>Doenças crônicas</label><br>
            <textarea name="doencas_cronicas"></textarea><br><br>
 
            <label>Tratamentos anteriores</label><br>
            <textarea name="tratamentos_anteriores"></textarea><br><br>
 
            <label>Hospitalizações</label><br>
            <textarea name="hospitalizacoes"></textarea><br><br>
 
            <label>Procedimentos realizados</label><br>
            <textarea name="procedimentos_realizados"></textarea>
        </fieldset>
 
        <fieldset>
            <legend>Dados Sensíveis (serão criptografados)</legend>
            <label>Origem racial ou étnica</label><br>
            <input type="text" name="origem_racial"><br><br>
 
            <label>Religião</label><br>
            <input type="text" name="religiao">
        </fieldset>
 
        <br>
        <button type="submit">Salvar cadastro</button>
    </form>
</body>
</html>