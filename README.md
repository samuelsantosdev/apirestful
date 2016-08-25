# **ApiRESTFUL**
Projeto administração de api rest

|Versão|Recurso|
|------|-------|
|Alpha|Api e Área de administração|

##Métodos API 

|Descrição|Metodo|Request|Response|
|----|----|----|----|
|Criar conta|POST Customer/CreateAccount|createaccount|account|
|Meus acessos|GET Customer/Lookup|token|methods|
|Todas as contas|GET Customer/GetAccounts|token|account|
|Contas Deletadas|GET Customer/GetAccountsDeleted|token|methods|
|Visualizar Conta|GET Customer/GetAccount|token|account|
|Atualizar Conta|POST Customer/UpdateAccount|updateaccount|account|
|Deletar Conta|POST Customer/DeleteAccount|deleteaccount|message|
|Novo Token|POST Authentication/GetToken|auth|token|
|Atualizar Token|POST Authentication/RefreshToken|refreshtoken|token|

##Segurança
Ao gerar o token em Authentication/GetToken, usar o "refreshtoken" para atualizar o token de 5 em 5 minutos
Método para atualizar o token Authentication/RefreshToken com o "refreshtoken" citado acima
Com 15 minutos de inatividade o Token e seu RefreshToken perdem validade

##Resquests
\apirestful\application\modules\api\requests

##Responses
\apirestful\application\modules\api\responses
