#!/bin/bash
if [ "$1" == "" ]; then
echo "Please run this shell bringing a url, like ./"$0" http://localhost/getData.php"
else
echo "<?php include 'conf/DealData.php'; \$data = new DealData(); \$data->getAndSaveData('"$1"'); ?>" > saveData.php
echo "0,10,20,30,40,50 * 3,4,5,6,7 * * /bin/sh "$(cd "$(dirname "$0")"; pwd)"/shells/run.sh" > tmp
crontab  tmp
echo "Ok, the server will get data from "$1
rm tmp
fi
