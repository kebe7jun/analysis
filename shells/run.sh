#!/bin/bash
/usr/bin/php5 $(cd "$(dirname "$0")"; pwd)"/../saveData.php" | cat >> $(cd "$(dirname "$0")"; pwd)"/../logs/server.log"
/bin/date | cat >>  $(cd "$(dirname "$0")"; pwd)"/../logs/server.log"

