#!/bin/bash

codedoc_url="host.docker.internal:2220"

# Verificar se o ID do trace foi passado como parâmetro
if [ -z "$1" ]; then
  exit 1
fi

# Atribuir o primeiro parâmetro ao ID do trace
id_trace=$1

# Diretório a ser monitorado
diretorio_monitorado=/tmp

# Arquivo de saída
arquivo_saida="$diretorio_monitorado/trace.txt"

# URL da rota Laravel
url_rota="http://$codedoc_url/api/v1/traces/$id_trace/file/upload"


# Função para remover arquivos existentes
remover_arquivos_existente() {
    rm -f "$arquivo_saida" "$diretorio_monitorado"/trace.*.xt.gz "$diretorio_monitorado"/trace.*.xt
}


# Fazer upload do arquivo para a rota Laravel
curl -X POST -F "trace_file=@$arquivo_saida" "$url_rota"

echo "Saindo do script..."

remover_arquivos_existente

exit 0
