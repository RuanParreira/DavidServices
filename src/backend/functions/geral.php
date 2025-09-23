<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../');
    exit;
}


// Função para formatar CPF/CNPJ
function formatCpfCnpj($value, $showPrefix = true): string
{
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

    $names = explode(' ', trim($fullName));

    // Se só tem um nome, retorna ele
    if (count($names) == 1) {
        return $names[0];
    }

    // Retorna primeiro e segundo nome
    return $names[0] . ' ' . $names[1];
}
