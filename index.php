<?php
// Inclui o arquivo de conexão com o banco de dados
require 'conexao.php';

// --- LÓGICA DE PROCESSAMENTO (Ações de Adicionar, Editar, Deletar) ---

$usuario_para_editar = null;

// Lógica para ADICIONAR ou ATUALIZAR um usuário 
// na primeira parte no if verifica se tem um ID é uma ATUALIZAÇÃO
// na segunda parte no else é uma CRIAÇÃO
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $id = $_POST['id'] ?? null;

    if ($id) {
        $stmt = $pdo->prepare("UPDATE usuarios SET name = ?, email = ? WHERE id = ?");
        $stmt->execute([$name, $email, $id]);
    }

    else {
        $stmt = $pdo->prepare("INSERT INTO usuarios (name, email) VALUES (?, ?)");
        $stmt->execute([$name, $email]);
    }

    //limpar o formulário
    $_POST = [];
    header("Location: index.php");
    exit;
}

// Lógica para DELETAR um usuário
if (isset($_GET['acao']) && $_GET['acao'] === 'deletar') {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: index.php");
    exit;
}

// Lógica para buscar os dados de um usuário para EDIÇÃO
if (isset($_GET['acao']) && $_GET['acao'] === 'editar') {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
    $stmt->execute([$id]);
    $usuario_para_editar = $stmt->fetch();
}

//  LÓGICA DE LEITURA Sempre busca todos os usuários para listar
$stmt = $pdo->query("SELECT * FROM usuarios ORDER BY name ASC");
$usuarios = $stmt->fetchAll();

?>
<!-- html da pagina so para apresentação -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuários</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1,
        h2 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .actions a {
            margin-right: 10px;
        }

        form {
            margin-top: 30px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: #f9f9f9;
        }

        form input[type="text"],
        form input[type="email"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ddd;
            box-sizing: border-box;
        }

        form button {
            background: #28a745;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        form button.editar {
            background: #ffc107;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Gerenciamento de Usuários</h1>

        <h2><?php echo $usuario_para_editar ? 'Editar Usuário' : 'Adicionar Novo Usuário'; ?></h2>
        <form action="index.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $usuario_para_editar['id'] ?? ''; ?>">

            <label for="name">Nome:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($usuario_para_editar['name'] ?? ''); ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($usuario_para_editar['email'] ?? ''); ?>" required>

           
            <button type="submit" class="<?php echo $usuario_para_editar ? 'editar' : ''; ?>">
                <?php echo $usuario_para_editar ? 'Atualizar' : 'Salvar'; ?>
            </button>
        </form>

        <h2>Usuários Cadastrados</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Data de Criação</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?php echo $usuario['id']; ?></td>
                        <td><?php echo htmlspecialchars($usuario['name']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['email']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['data']); ?></td>
                        <td class="actions">
                            <a href="index.php?acao=editar&id=<?php echo $usuario['id']; ?>">Editar</a>
                            <a href="index.php?acao=deletar&id=<?php echo $usuario['id']; ?>" onclick="return confirm('Tem certeza que deseja deletar este usuário?');">Deletar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>

</html>