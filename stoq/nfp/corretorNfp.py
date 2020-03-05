#!/usr/bin/python

import string
import sys
import os

os.system('clear')

sucesso = 1

print "\nBEM VINDO AO PROGRAMA DE CORRECAO DE NOTA FISCAL PAULISTA\n"

mes = raw_input('INFORME O NUMERO DO MES A SER CORRIGIDO: ')

if int(mes) < 1 or int(mes) > 12:
    print "MES INVALIDO!"
    sucesso = 0

ano = raw_input('INFORME O NUMERO FINAL DO ANO A SER CORRIGIDO: ')

if int(ano) < 1 or int(ano) > 20:
    print "ANO INVALIDO!"
    sucesso = 0

if sucesso == 1:
    comando = "php /home/plazafone/dev/xmn/corretorNfp.php " + mes + " " + ano
    os.system(comando)

raw_input("\nPRESSIONE <ENTER> PARA ENCERRAR O PROGRAMA\n")

sys.exit()
