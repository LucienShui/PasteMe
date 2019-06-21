#!/usr/bin/env bash

BASE=github.com/LucienShui/PasteMe/GoBackend/

TEST_CASE="
data
server
util
"

for each in ${TEST_CASE}; do
    go test -v ${BASE}${each}
    if [[ $? != 0 ]]; then
        exit 1
    fi
done
