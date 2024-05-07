INSTALAÇÃO

docker-compose up e visitar http://localhost:8080/

Fiz uma gambiarra pra rodar migrations e seeders na primeira visita da home

O container aparecerá em laranja em um docker app, mas é só porque composer roda inicialmente e depois para (3/4 containers rodando após isso)

invez do típico .env.example, o .env está presente no repo pra pular a configuração inicial. Apenas por ser um projeto básico que não sairá disso.

$config['base_url'] = 'http://localhost:8080/';
alterar se necessário, application>config>config.php linha 26

______________

OBSERVAÇÔES

Insano a tamanho pequeno do projeto em MB comparado com uma aplicação Laravel kkkk

Mesmo sendo um projeto solo e básico eu subi vários commits, então dá pra acompanhar bem o que foi feito e quando.

______________

Alguns dos ajustes que só ficaram no "para fazer":

Tornar os forms asíncronos;

Fazer as mensagens de erro aparecer nos campos específicos dos forms;

Tratamento de exceções com try e catch;

Erro de utf-8 na classe FPDF, acentos não funcionam no momento, "TFPDF" apareceu em uma pesquisa rápida mas não deu tempo para interagir com isso ou saber exatamente qual é o problema / solução.