<?php

/**
 * 调换数组键与值
 * @param $data
 * @return array|null
 */
function transfer_array($data) {
    return array_flip($data);
}