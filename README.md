Este foi o meu primerio codigo em php, aprendemos a linkar o back com o front end

Carlos_Buttke_2026

a ideia da atividade proposta na aula foi aprender e construir uma relação de entre um site e o banco de dados utilizando o XAMMP e linguagem utilizada foi o PHP .
além disso  fomos estimulados a também a praticarmos boas praticas relacionadas a organização de arquivos .

Na construção com o PHP também além do link para o banco também fizemos algumas linhas de validação 
como por exemplo para que somente possa entra no site se logar com alguma conta que já exista e se não estiver ele pode cadastrar se. e se acaso ele entre no site o sistema irá mostrar todos os cadastros existentes 

Conexão com o Banco de Dados: Estabelece a comunicação da aplicação PHP com o banco de dados MySQL (sistema_simples).


Autenticação de Usuários (Login): Recebe o usuário e senha, consulta o banco de dados para validar as credenciais e, em caso de sucesso, inicia uma sessão ativa.

Identificação do Usuário: Exibe na tela restrita o nome do usuário que está atualmente logado na sessão.

Cadastro de Novos Usuários (Create): Fornece um formulário na área restrita que permite inserir novos registros (novo usuário e senha) diretamente na tabela users do banco de dados.

Feedback de Ações: Emite alertas na tela informando se o cadastro do novo usuário foi realizado com sucesso ou se ocorreu um erro, e exibe mensagens de falha caso o login seja inválido.

Encerramento de Sessão (Logout): Permite que o usuário desconecte do sistema, destruindo os dados da sessão atual e redirecionando-o de volta para a tela inicial.

Implementação da Funcionalidade
A exclusão foi desenvolvida adicionando um botão "Excluir" ao lado de cada usuário na tabela de listagem. Esse botão passa o `id` do usuário via método GET para o arquivo responsável por processar a exclusão. O script recebe o ID, valida a informação e executa uma query `DELETE` no banco de dados utilizando Prepared Statements para garantir a segurança.