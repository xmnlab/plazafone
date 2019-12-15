#!/bin/bash

createuser --host localhost --port 5432 -W -U postgres -s -P stoq
createdb --host localhost --port 5432 -W -U postgres -O stoq stoq
psql --host localhost --port 5432 -W -U stoq --dbname stoq < stoq5_bkp.dump 
stoqdbadmin configure -d stoq -H localhost -p 5432 -u stoq -w stoq
