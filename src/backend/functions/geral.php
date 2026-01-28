<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../');
    exit;
}


// Função para formatar CPF/CNPJ
function formatCpfCnpj($value, $showPrefix = true): string
{
    // Retorna vazio se for null ou vazio
    if (empty($value)) {
        return '';
    }

    $digits = preg_replace('/\D/', '', $value);
    if (strlen($digits) === 11) {
        // CPF
        return ($showPrefix ? 'CPF: ' : '') . preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $digits);
    } elseif (strlen($digits) === 14) {
        // CNPJ
        return ($showPrefix ? 'CNPJ: ' : '') . preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $digits);
    }
    return $value;
}

// Função para formatar número de telefone
function formatNumber($value): string
{
    $digits = preg_replace('/\D/', '', $value);
    if (strlen($digits) === 10) {
        // Formato (XX) XXXX-XXXX
        return preg_replace('/(\d{2})(\d{4})(\d{4})/', '($1) $2-$3', $digits);
    } elseif (strlen($digits) === 11) {
        // Formato (XX) XXXXX-XXXX
        return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $digits);
    }
    return $value;
}


// Pegar o Primeiro e Segundo Nome do Técnico
function getFirstTwoNames($fullName)
{
    if (empty($fullName)) {
        return '';
    }

    $fullName = trim($fullName);
    // normaliza para minúsculas e converte para Title Case com suporte a multibyte
    $fullName = mb_convert_case(mb_strtolower($fullName, 'UTF-8'), MB_CASE_TITLE, 'UTF-8');

    $names = preg_split('/\s+/', $fullName);

    if (count($names) === 1) {
        return $names[0];
    }

    $second = $names[1];

    // Se o segundo nome tiver até 3 caracteres e houver terceiro nome, inclui o terceiro
    if (mb_strlen($second, 'UTF-8') <= 3 && isset($names[2])) {
        return $names[0] . ' ' . $second . ' ' . $names[2];
    }

    return $names[0] . ' ' . $second;
}

function toTitleCase($text): string
{
    if (empty($text)) {
        return '';
    }
    $text = trim($text);
    return mb_convert_case(mb_strtolower($text, 'UTF-8'), MB_CASE_TITLE, 'UTF-8');
}
