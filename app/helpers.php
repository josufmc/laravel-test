<?php

function activeMenu($url){
    return request()->is($url) ? 'active' : '';
}