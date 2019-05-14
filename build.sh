#!/bin/bash
set -x
DIR=${PWD}
DIST_DIR='pasteme'
rm -rf ${DIST_DIR}
cd ${DIR}/Frontend
npm run build
cp -r ${DIST_DIR} ${DIR}
cd ${DIR}
rm config.json
mkdir -p ${DIR}/${DIST_DIR}/api
cp -r ${DIR}/Backend/lib ${DIR}/Backend/*.php ${DIR}/${DIST_DIR}/api
cp ${DIR}/config.example.json ${DIR}/${DIST_DIR}
rm -f ${DIR}/${DIST_DIR}/api/lib/config.php

