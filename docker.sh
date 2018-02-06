#!/bin/bash

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"


if [ ! -e "$DIR/data/config.php" ]; then
  cp "$DIR/data/config.php.example" "$DIR/data/config.php"
fi

docker run --rm -it --name "dev.lbry.tech" \
  -v "$DIR:/usr/src/lbry.tech" \
  -w "/usr/src/lbry.tech" \
  -p "127.0.0.1:8080:8080" \
  -u "$(id -u):$(id -g)" \
  php:7-alpine \
  php --server "0.0.0.0:8080" --docroot "web/" "index.php"
