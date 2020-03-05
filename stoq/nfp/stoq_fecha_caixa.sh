#!/bin/bash

psql -U stoq -h localhost -d stoq -W -f /home/plazafone/dev/xmn/arquivos/stoq_fecha_caixa.sql

echo 'processo realizado';


