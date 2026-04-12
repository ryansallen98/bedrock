#!/usr/bin/env bash

set -euo pipefail

shutdown() {
  /usr/local/lsws/bin/lswsctrl stop || true
  exit 0
}

trap shutdown INT TERM

if [[ -z "$(ls -A -- "/usr/local/lsws/conf/")" ]]; then
  cp -R /usr/local/lsws/.conf/* /usr/local/lsws/conf/
fi

if [[ -z "$(ls -A -- "/usr/local/lsws/admin/conf/")" ]]; then
  cp -R /usr/local/lsws/admin/.conf/* /usr/local/lsws/admin/conf/
fi

chown -R 994:994 /usr/local/lsws/conf
chown -R 994:1001 /usr/local/lsws/admin/conf

/usr/local/lsws/bin/lswsctrl start

while true; do
  if ! /usr/local/lsws/bin/lswsctrl status | grep -q 'litespeed is running with PID'; then
    exit 1
  fi

  sleep 60
done
