# coding: latin-1
from pydaruma.pydaruma import iImprimirTexto_DUAL_DarumaFramework
from ctypes import create_string_buffer


Texto = create_string_buffer(2000)
Texto = ''.join([
    "<ce>Avan�ando 5 Linhas</ce><sl>5</sl>Inserindo<sp>10</sp>10 espa�os em Branco<sl>2</sl>",
    "Formata��o Normal</ce><l></l>DARUMA AUTOMA��O!!<sl>2</sl><ce>Negr+Ital+Subl+Expand</ce><l></l>",
    "<b><i><s><e>DARUMA AUTOMA��O!!</b></i></s></e><sl>2</sl><ce>Negr+Ital+Subl+Condensado</ce><l></l>",
    "<b><i><s><c>DARUMA AUTOMA��O!!</b></i></s></c><sl>2</sl><ce>Negr+Ital+Subl+Normal</ce><l></l>",
    "<b><i><s><n>DARUMA AUTOMA��O!!</b></i></s></n><sl>2</sl><ce>Expandido</ce><l></l>",
    "<e>DARUMA AUTOMA��O!!</e><sl>2</sl><ce>Condensado</ce><l></l>",
    "<c>DARUMA AUTOMA��O!!</c><sl>2</sl><ce>Negrito+Expandido</ce><l></l>",
    "<b><e>DARUMA AUTOMA��O!!</b></e><sl>2</sl><ce>It�lico+Expandido</ce><l></l>",
    "<i><e>DARUMA AUTOMA��O!!</i></e><sl>2</sl><ce>Sublinhado+Expandido</ce><l></l>",
    "<s><e>DARUMA AUTOMA��O!!</s></e><sl>2</sl><ce>Negrito+Condensado</ce><l></l>",
    "<b><c>DARUMA AUTOMA��O!!</b></c><sl>2</sl><ce>It�lico+Condensado</ce><l></l>",
    "<i><c>DARUMA AUTOMA��O!!</i></c><sl>2</sl><ce>Sublinhado+Condensado</ce><l></l>",
    "<s><c>DARUMA AUTOMA��O!!</s></c><sl>2</sl><ce>Negrito+Normal</ce><l></l>",
    "<b><n>DARUMA AUTOMA��O!!</n></b><l></l>"
])
iImprimirTexto_DUAL_DarumaFramework(Texto,0)
