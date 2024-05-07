INSTALAÇÃO
docker-compose up e visitar http://localhost:8080/
Fiz uma gambiarra pra rodar migrations e seeders na primeira visita da home

O container aparecerá em laranja em um docker app, mas é só porque composer roda inicialmente e depois para (3/4 containers rodando após isso)

invez do típico .env.example, o .env está presente no repo pra pular a configuração inicial. Apenas por ser um projeto básico que não sairá disso.

$config['base_url'] = 'http://localhost:8080/';
alterar se necessário, application>config>config.php linha 26

Obs: Insano a tamanho pequeno do projeto em MB comparado com uma aplicação Laravel kkkk


Alguns ajustes que só ficaram no "para fazer", entre outroas:
Tornar os forms asíncronos;
Fazer as mensagens de erro aparecer nos campos específicos dos forms;
Tratamento de exceções com try e catch;
Não deu tempo para sequer catucar muito a classe FPDF mas acentos (ex:Vinícius) não funcionam no momento, "TFPDF" apareceu em uma pesquisa rápida mas não deu tempo para interagir com isso;