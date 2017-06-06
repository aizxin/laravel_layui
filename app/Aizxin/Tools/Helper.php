<?php
/**
 *  递归迭代无限级分类
 */
if (! function_exists('sort_parent')) {
    /**
     *  [sort_parent description]
     */
    function sort_parent($menus,$pid=0)
    {
        $arr = [];
        if (empty($menus)) {
            return '';
        }
        foreach ($menus as $key => $v) {
            if ($v['parent_id'] == $pid) {
                $v['child'] = sort_parent($menus,$v['id']);
                $arr[] = $v;
            }
        }
        return $arr;
    }
}
/**
 *  递归迭代无限级分类
 */
if (! function_exists('area_sort_parent')) {
    /**
     *  [area_sort_parent description]
     */
    function area_sort_parent($menus,$pid=0)
    {
        $arr = [];
        if (empty($menus)) {
            return '';
        }
        foreach ($menus as $key => $v) {
            if ($v['parent_id'] == $pid) {
                $v['children'] = area_sort_parent($menus,$v['code']);
                $arr[] = $v;
            }
        }
        return $arr;
    }
}
/**
 *  aizxin_paginate
 */
if (! function_exists('aizxin_paginate')) {
    /**
     *  [aizxin_paginate description]
     */
    function aizxin_paginate($results)
    {
        $response = [
            'pagination' => [
                'total' => $results['total'],
                'per_page' => $results['per_page'],
                'current_page' => $results['current_page'],
                'last_page' => $results['last_page'],
                'from' => $results['from'],
                'to' => $results['to']
            ],
            'data' => $results['data']
        ];
        return $response;
    }
}
/**
 *  qiniu_by_curl
 */
if (! function_exists('qiniu_by_curl')) {
    /**
     *  [qiniu_by_curl description]
     */
    function qiniu_by_curl($remote_server,$post_string,$upToken) {
        $headers = array();
        $headers[] = 'Content-Type:image/png';
        $headers[] = 'Authorization:UpToken '.$upToken;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$remote_server);
        //curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER ,$headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
}
/**
 * 响应成功
 * @param string $message
 * @return \Illuminate\Http\Response
 */
if (! function_exists('respondWithSuccess')) {
    /**
     *  [qiniu_by_curl description]
     */
    function respondWithSuccess($data, $message = '', $code = 200, $status = 'success')
    {
        return response()->json([
            'status' => $status,
            'code' => $code,
            'message' => $message,
            'result' => $data,
        ]);
    }
}
/**
 * 响应成功
 * @param string $message
 * @return \Illuminate\Http\Response
 */
if (! function_exists('respondApiSuccess')) {
    /**
     *  [qiniu_by_curl description]
     */
    function respondApiSuccess($data, $message = '', $code = 200)
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
            'result' => $data,
        ]);
    }
}
/**
 * 响应错误
 * @param string $message
 * @param int $code
 * @param string $status
 * @return Response
 */
if (! function_exists('respondWithErrors')) {

    function respondWithErrors($message = '', $code = 422, $status = 'error')
    {
        return response()->json([
            'status' => $status,
            'code' => $code,
            'message' => $message,
        ]);
    }
}
/**
 * 响应错误
 * @param string $message
 * @param int $code
 * @param string $status
 * @return Response
 */
if (! function_exists('respondApiErrors')) {

    function respondApiErrors($message = '', $code = 422)
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
        ]);
    }
}
/**
 * 响应所有的validation验证错误
 * @param  \Illuminate\Validation\Validator $validator the validator that failed to pass
 * @return \Illuminate\Http\Response the Aizxinropriate response containing the error message
 */
if (! function_exists('respondWithFailedValidation')) {

    function respondWithFailedValidation(\Illuminate\Validation\Validator $validator)
    {
        return respondWithErrors($validator->messages()->first(), 422);
    }
}

