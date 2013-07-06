#!/bin/bash

# Setup mysql database
mysql -uroot -e 'CREATE DATABASE `magento`;'

# Determine base paths
BIN_DIR=$(dirname $(readlink -f $0))
BASE_DIR=$(dirname $BIN_DIR)

# Install build utilities
curl -sS https://raw.github.com/netz98/n98-magerun/master/n98-magerun.phar -o $BIN_DIR/magerun.phar
curl -sS https://raw.github.com/colinmollenhour/modman/master/modman -o $BIN_DIR/modman
chmod a+x $BIN_DIR/magerun.phar
chmod a+x $BIN_DIR/modman
cp $(dirname $BIN_DIR)/n98-magerun.yaml ~/.n98-magerun.yaml

# Install mage
cd $BIN_DIR
./magerun.phar install \
  --dbHost="localhost" --dbUser="root" --dbPass="" --dbName="magento" \
  --installSampleData="yes" \
  --useDefaultConfigParams="yes" \
  --magentoVersionByName="magento-ce-1.7.0.2" \
  --installationFolder="$BASE_DIR/public" --baseUrl="http://localhost.localdomain/"

# Setup MageTest in our test mage installation
cd $BASE_DIR/public
$BIN_DIR/modman init
$BIN_DIR/modman link $BASE_DIR
cp -r $BASE_DIR/tests/ .
cp $BASE_DIR/bootstrap.php .
cp $BASE_DIR/phpunit.xml.dist .
echo "CI Setup Complete"
