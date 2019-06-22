#!/usr/bin/env bash

BASE=github.com/LucienShui/PasteMe/GoBackend/

TEST_CASE="
data
server
util
"

for each in ${TEST_CASE}; do
    go test -v -count=1 ${BASE}${each}
    if [[ $? != 0 ]]; then
        exit 1
    fi
done

echo "All test done"
