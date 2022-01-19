<?php

if (!function_exists('ApiErrorResponse')) {
    function ApiErrorResponse($message, $key = null)
    {
        if (!is_null($key)) {
            $data = [
                'status' => true,
                'message' => [
                    $key => $message
                ],
                'data' => null,
            ];
        } else {
            $data = [
                'status' => true,
                'message' => [
                    'error' => $message
                ],
                'data' => null,
            ];
        }

        return response()->json($data, 400);
    }
}


if (!function_exists('filter_strip_tags')) {

    function filter_strip_tags($field)
    {
        return trim(strip_tags($field));
    }
}

if (!function_exists('encode_html_entities')) {

    function encode_html_entities($field)
    {
        return trim(htmlentities($field));
    }
}

if (!function_exists('decode_html_entities')) {

    function decode_html_entities($field)
    {
        return trim(html_entity_decode($field));
    }
}


if (!function_exists('generateToken')) {

    function generateToken($data)
    {
        $plaintext = $data;
        $key = env('APP_KEY');
        $ivlen = openssl_cipher_iv_length($cipher = "AES-128-CBC");
        $iv = openssl_random_pseudo_bytes($ivlen);
        $ciphertext_raw = openssl_encrypt($plaintext, $cipher, $key, $options = OPENSSL_RAW_DATA, $iv);
        $hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary = true);
        return base64_encode($iv . $hmac . $ciphertext_raw);
    }
}


if (!function_exists('decodeToken')) {

    function decodeToken($data)
    {
        $c = base64_decode($data);
        $key = env('APP_KEY');
        $ivlen = openssl_cipher_iv_length($cipher = "AES-128-CBC");
        $iv = substr($c, 0, $ivlen);
        $hmac = substr($c, $ivlen, $sha2len = 32);
        $ciphertext_raw = substr($c, $ivlen + $sha2len);
        $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options = OPENSSL_RAW_DATA, $iv);
        $calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary = true);
        if (hash_equals($hmac, $calcmac)) // timing attack safe comparison
        {
            return $original_plaintext;
        }
    }
}


if (!function_exists('customPagination')) {
    function customPagination($page, $data_count, $limit = 1)
    {
        $total_results = $data_count;
        $total_pages = ceil($total_results / $limit);
        $remaining_pages = ((($total_pages - $page) - 1) > 0 ? (($total_pages - $page) - 1) : 0);
        $current_page = (int)($page + 1);

        return [
            "total_result" => $total_results,
            "total_pages" => $total_pages,
            "remaining_pages" => $remaining_pages,
            "current_page" => $current_page
        ];
    }
}

if (!function_exists('base64ToImage')) {
    function base64ToImage($image): string
    {
        $filename = '';
        if (!empty($image)) {
            $dir = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'files/images';
            $image_parts = explode(";base64,", $image);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $filename = uniqid() . '.' . $image_type;
            $file = $dir . DIRECTORY_SEPARATOR . $filename;
            file_put_contents($file, $image_base64);
        }

        return $filename;
    }
}
