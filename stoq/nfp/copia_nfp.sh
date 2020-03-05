#!/bin/bash

scp -p plazafone@10.1.1.2:/home/plazafone/.stoq/cat52/* /home/plazafone/.stoq/cat52.plz/

cd /home/plazafone/dev/xmn/

python corretorNfp.py
