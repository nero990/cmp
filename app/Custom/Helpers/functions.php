<?php


function getPaginateSize() {
    try {
        return \App\Setting::get('paginate_size');
    } catch (Exception $e) {
        return 50;
    }
}


function normal_case($string)
{
    return ucwords(str_replace('_', ' ', $string));
}

function faker() {
    return Faker\Factory::create();
}

function is_json($string,$assoc=false){
    try{
        $v = json_decode($string,$assoc);
        return (json_last_error()===JSON_ERROR_NONE)?$v:false;
    }
    catch(\Exception $e){return false;}
}

function json_failure () {

}

function auditableJsonToString($key, $attribute, $modified) {
    if($attribute == $key){
        if(isset($modified['old']) && is_string($modified['old'])) $modified['old'] = json_decode($modified["old"], true);
        if(isset($modified['new']) && is_string($modified['new'])) $modified['new'] = json_decode($modified["new"], true);

        $modified['new'] = isset($modified['new']) ? implode(", ", $modified['new']) : NULL;


        $modified['old'] = isset($modified['old']) ? implode(", ", $modified['old']) : "NULL";

        $modified = auditableEmptyToNull($modified);

        if(isset($modified['new']) && isset($modified['old']) &&
            $modified['new'] == "" && $modified['old'] == "NULL") { return false; }
    }
    return $modified;
}

function auditableValueToText($key, $model, $attribute, $modified) {
    if($attribute == $key){
        $method = "get".studly_case($key)."Text";
        if(isset($modified['old'])) $modified['old'] = $model::$method($modified['old']);
        if(isset($modified['new'])) $modified['new'] = $model::$method($modified['new']);
    }
    return $modified;
}

function auditableEmptyToNull($modified, $attribute = null, $key = null) {
    if($attribute == $key)
        $modified['old'] = empty($modified['old']) ? "\"\"" : $modified['old'];

    return $modified;
}

function getAuditName ($auditable_type, $separator = " ", $plural = false) {
    $word = kebab_case(substr($auditable_type, 4));
    if($plural) $word = str_plural($word);
    return str_replace("-", $separator, $word);
}

function getAuditRoute ($audit) {
    $route ="";
    if($audit->auditable_type == 'App\Member') {
        $route = "families/";
    }
    $route .= getAuditName($audit->auditable_type, "-", true) . "/{$audit->auditable_id}/audits";
    return url($route);
}

function nameFile($type) {
    return date('Y_m_d_') . time() . "_" . rand(1111, 9999) . "_{$type}" ;
}