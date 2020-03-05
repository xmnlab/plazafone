#!/bin/bash

pasta_raiz='/home/plazafone/Dropbox/bkp/base-de-dados/psql/';

arquivo_nome=`date +%w`;

arquivo_nome=`echo $pasta_raiz'stoq'$arquivo_nome'_bkp.dump'`;

touch $arquivo_nome;

chmod 777 $arquivo_nome;

pg_dump stoq__backup_20191127_1826 -U stoq -h localhost > $arquivo_nome;

echo 'ok';


