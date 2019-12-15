#!/bin/bash

PSQL_PARAM_POSTGRES="--host localhost --port 5432 -W -U postgres"
PSQL_PARAM_STOQ="--host localhost --port 5432 -W -U stoq"

dropdb $PSQL_PARAM_POSTGRES stoq
createdb $PSQL_PARAM_POSTGRES -O stoq stoq
psql $PSQL_PARAM_STOQ --dbname stoq < stoq5_bkp.dump
psql $PSQL_PARAM_STOQ --dbname stoq < patch/2019-12.patch
stoqdbadmin configure -d stoq -H localhost -p 5432 -u stoq -w stoq
