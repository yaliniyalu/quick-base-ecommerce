<?php

require_once __DIR__ . "/http.php";
global $http;


function qb_query_parse($result) {
    $list = [];

    $fields = [];
    foreach ($result['fields'] as $field) {
        $fields[$field['id']] = $field;
    }

    foreach ($result['data'] as $item) {
        $data = [];
        foreach ($item as $key => $value) {
            $field = $fields[$key];

            if ($field['type'] == 'file') {
                $val = $value['value']['url'];
            }
            else {
                $val = $value['value'];
            }

            $data[$fields[$key]['label']] = $val;
        }

        $list[] = $data;
    }

    return $list;
}

function qb_query_parsed($from, $select, $where = null, $sortBy = null, $groupBy = null, $skip = 0, $top = 999) {
    global $http;

    $response = $http->post("records/query", [
        "json" => array_filter([
            "from" => $from,
            "select" =>$select,
            "where" => $where,
            "sortBy" => $sortBy,
            "groupBy" => $groupBy,
            "options" => [
                "skip" => $skip,
                "top" => $top
            ]
        ])
    ]);

    return qb_query_parse(json_decode($response->getBody(), true));
}

function qb_query_report_parsed($reportId, $tableId, $skip = 0, $top = 999) {
    global $http;

    $response = $http->post("reports/{$reportId}/run?tableId={$tableId}&skip={$skip}&top={$top}");

    return qb_query_parse(json_decode($response->getBody(), true));
}

function qb_insert($to, $data, $fieldsToReturn = []) {
    global $http;

    $encoded = [];
    foreach ($data as $key => $value) {
        $encoded[$key] = ['value' => $value];
    }

    $response = $http->post("records", [
        "json" => [
            "to" => $to,
            "data" => [$encoded],
            "fieldsToReturn" => $fieldsToReturn
        ]
    ]);

    $res = json_decode($response->getBody(), true);

    if (count($res['metadata']['createdRecordIds'])) {
        return $res['metadata']['createdRecordIds'][0];
    }

    if (count($res['metadata']['unchangedRecordIds'])) {
        return $res['metadata']['unchangedRecordIds'][0];
    }

    if (count($res['metadata']['updatedRecordIds'])) {
        return $res['metadata']['updatedRecordIds'][0];
    }

    return null;
}

function qb_insert_multi($to, $data, $fieldsToReturn = []) {
    global $http;

    $inserts = [];
    foreach ($data as $insert) {
        $encoded = [];
        foreach ($insert as $key => $value) {
            $encoded[$key] = ['value' => $value];
        }

        $inserts[] = $encoded;
    }

    $response = $http->post("records", [
        "json" => [
            "to" => $to,
            "data" => $inserts,
            "fieldsToReturn" => $fieldsToReturn
        ]
    ]);

    $res = json_decode($response->getBody(), true);
    return $res['metadata']['createdRecordIds'];
}