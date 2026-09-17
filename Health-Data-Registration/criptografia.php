<?php


define('CRYPTO_METODO', 'aes-256-cbc');

define('CRYPTO_CHAVE', getenv('APP_CRYPTO_KEY') ?: 'minha-chave-super-secreta-32bytes!!');

function criptografar(string $textoPuro): string
{
    $ivLength = openssl_cipher_iv_length(CRYPTO_METODO);
    $iv = openssl_random_pseudo_bytes($ivLength);

    $cifrado = openssl_encrypt(
        $textoPuro,
        CRYPTO_METODO,
        CRYPTO_CHAVE,
        OPENSSL_RAW_DATA,
        $iv
    );

    if ($cifrado === false) {
        throw new RuntimeException('Falha ao criptografar dado sensível.');
    }


    return base64_encode($iv . $cifrado);
}

function descriptografar(string $valorArmazenado): string
{
    $dadosBrutos = base64_decode($valorArmazenado);
    $ivLength = openssl_cipher_iv_length(CRYPTO_METODO);

    $iv = substr($dadosBrutos, 0, $ivLength);
    $cifrado = substr($dadosBrutos, $ivLength);

    $textoPuro = openssl_decrypt(
        $cifrado,
        CRYPTO_METODO,
        CRYPTO_CHAVE,
        OPENSSL_RAW_DATA,
        $iv
    );

    if ($textoPuro === false) {
        throw new RuntimeException('Falha ao descriptografar dado sensível.');
    }

    return $textoPuro;
}