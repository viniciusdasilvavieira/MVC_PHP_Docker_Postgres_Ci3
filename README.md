
# CRUD Escola e relatório em PDF

- **Name:** Vinícius S. Vieira
- **Email:** b249viniciusvieira@gmail.com
- **GitHub:** [https://github.com/viniciusdasilvavieira/]
- **LinkedIn:** [https://www.linkedin.com/in/vin%C3%ADcius-s-vieira-a152a612b/]

## CodeIgniter 3 App

______________

INSTALAÇÃO

Rodar o comando docker-compose up e visitar http://localhost:8080/;

A aplicação aparecerá em laranja em um docker app, mas é só porque composer roda inicialmente e depois para (3/4 containers ativos após isso);

A ideia é não precisar usar o comando composer install nem acionar migrações;

Em vez do típico .env.example, o .env está presente no repo para pular a configuração inicial. Apenas por ser um projeto básico que não sairá disso;

$config['base_url'] = 'http://localhost:8080/';
alterar se necessário; application>config>config.php linha 26

______________

OBSERVAÇÔES

Mesmo sendo um projeto solo pequeno eu subi vários commits, então dá pra acompanhar o que foi feito e quando. Visite o histórico de commits!;

Responsividade: O uso de bootstrap tornou fácil realizar ajustes rápidos de responsividade com tamanhos condicionais para 'col'

Insano a tamanho pequeno do projeto em MB comparado com uma aplicação Laravel kkkk;

______________

Alguns dos ajustes que só ficaram no "para fazer":

Tornar os forms asíncronos;

Fazer as mensagens de erro aparecerem nos campos específicos dos forms;

Tratamento de exceções com try e catch;

Erro de utf-8 na classe FPDF, acentos não funcionam no momento, "tFPDF" apareceu em uma pesquisa rápida mas não deu tempo para interagir com isso ou saber exatamente qual é o problema / solução;