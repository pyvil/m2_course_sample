<?php
/**
 * Registration
 *
 * @category  Smile
 * @package   Smile\Course
 * @author    Vitaliy Pyatin <vipya@smile.fr>
 * @copyright 2020 Smile
 */

use Magento\Framework\Component\ComponentRegistrar;

ComponentRegistrar::register(
    ComponentRegistrar::MODULE,
    'Smile_Course',
    __DIR__
);

/*
 *
php bin/magento setup:install --db-host="m2_contribute_mysql" --db-name="magento" --db-user="magento" --db-password="magento" --base-url="http://m2-contribute.loc:30080" --admin-user="admin" --admin-password="magent0" --admin-email="admin@m2-contribute.loc" --admin-firstname="Admin" --admin-lastname="Admin" --use-rewrites=1 --cleanup-database

php bin/magento bin/magento setup:upgrade

php bin/magento sampledata:deploy

bin/magento setup:db-declaration:generate-whitelist
 */
