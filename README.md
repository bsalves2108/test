# Teste CakePHP Agenda

## Instalação

1. Caso não tenha o composer, baixe através do link: [Composer](https://getcomposer.org/doc/00-intro.md).
2. Execute `sudo chmod 777 setup.sh`.
3. Execute `sudo sh setup.sh`.
4. Acesse o site: `http://api.agenda.localhost/`
5. Caso o site apresente falhas, siga os próximos passos:
   1. Alterar o host e porta do arquivo .env para
      1. DATABASE_PORT=5333
      2. DATABASE_HOST=(Seu ip da rede)
   2. Execute: `bin/cake server` e acesse: `http://localhost:8765`.
6. Caso a instalação apresente falha, rode novamente o passo 2, se persistir o erro entre em contato
