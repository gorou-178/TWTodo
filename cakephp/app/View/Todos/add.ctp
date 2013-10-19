<?php
/**
 * Created by JetBrains PhpStorm.
 * User: anaisatoshi
 * Date: 2013/10/07
 * Time: 22:07
 * To change this template use File | Settings | File Templates.
 */
    echo json_encode(compact('message'), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);