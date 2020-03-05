#!/bin/bash

pasta_raiz='/home/plazafone/Dropbox/bkp/base-de-dados/mysql/';

arquivo_nome=`date +%w`;

arquivo_nome=`echo $pasta_raiz'sos_plazafone'$arquivo_nome'.dump'`;

touch $arquivo_nome;

chmod 755 $arquivo_nome;

mysqldump plazafone -u backup --password=backup > $arquivo_nome;

echo 'backup mysql sos realizado com sucesso';


