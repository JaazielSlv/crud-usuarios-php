# CRUD Simples de Usuários em PHP 🚀

Um projeto web básico que implementa um sistema completo de gerenciamento de usuários. A aplicação permite Criar, Ler, Atualizar e Deletar (CRUD) registros de um banco de dados MySQL, utilizando PHP puro e uma interface HTML/CSS simples e funcional.

## ✨ Funcionalidades

* **Listar Usuários:** Visualização de todos os usuários cadastrados em uma tabela organizada.
* **Adicionar Novos Usuários:** Formulário para inserção de novos registros no banco de dados.
* **Editar Usuários:** Formulário pré-preenchido para atualizar as informações de um usuário existente.
* **Deletar Usuários:** Opção para remover um usuário do banco de dados, com uma etapa de confirmação.
* **Exibir Data de Criação:** A tabela mostra automaticamente a data e hora em que cada usuário foi cadastrado.


## 💻 Tecnologias Utilizadas

* **Backend:** PHP 8+ (com PDO para conexão segura ao banco de dados)
* **Frontend:** HTML5 e CSS3
* **Banco de Dados:** MySQL / MariaDB
* **Ambiente de Desenvolvimento:** XAMPP 

## 🔧 Pré-requisitos

Antes de começar, você vai precisar ter instalado em sua máquina:
* Um ambiente de servidor local como o [XAMPP].
* Um navegador web de sua preferência.
* Um editor de código como o [VS Code].

## ⚙️ Passo a Passo para Instalação e Uso

Siga atentamente os passos abaixo para rodar o projeto localmente.

### 1. Clonar o Repositório


```bash
git clone https://github.com/JaazielSlv/crud-usuarios-php.git
```


### 2. Mover os Arquivos

Mova a pasta do projeto (`crud-usuarios` ou o nome que você deu) para dentro da pasta `htdocs` do seu XAMPP. O caminho geralmente é:

```
C:\xampp\htdocs\crud-usuarios
```

### 3. Criar o Banco de Dados e a Tabela

Este é o passo mais importante!

1.  Inicie os módulos **Apache** e **MySQL** no seu painel de controle do XAMPP.
2.  Abra seu navegador e acesse o phpMyAdmin: `http://localhost/phpmyadmin`
3.  Clique em **"Novo"** na barra lateral esquerda para criar um novo banco de dados.
4.  Dê ao banco de dados o nome exato de `usuarios` e clique em "Criar".
5.  Após criar, selecione o banco `usuarios` na lista, clique na aba **"SQL"** e cole o código abaixo para criar a tabela já com a nova coluna de data:

```sql
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
```
6.  Clique no botão **"Executar"**. Sua tabela `usuarios` será criada corretamente. A coluna `data` será preenchida automaticamente pelo banco de dados sempre que um novo usuário for inserido.

### 4. Configuração da Conexão

O arquivo `conexao.php` já vem pré-configurado para o ambiente padrão do XAMPP (usuário `root` e sem senha). Se sua configuração for a padrão, **nenhuma alteração é necessária**.

### 5. Acessar a Aplicação

Agora que tudo está configurado, acesse o projeto pelo seu navegador através da seguinte URL:

```
http://localhost/crud-usuarios/
```
Pronto! Você verá a interface da aplicação e poderá começar a adicionar, editar e deletar usuários.

---

Feito por **[Jaaziel Silva]**.
