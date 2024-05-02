<?php

namespace App\Domain\ValueObject\Partner;

final class Document
{
    private const MAX_SIZE = 14;
    private string $document;

    public function __construct(string $document)
    {
        $this->document = $document;
    }

    public function validateDocument(): string
    {
        if (
            !$this->isDocument()
            || !$this->hasAllDigitsEquals()
        ) {
            return 'CNPJ Inválido';
        }

        return 'CNPJ Válido';
    }

    public function toDocumentFormated(): string
    {
        return substr($this->document, 0, 2) . '.' .
            substr($this->document, 2, 3) . '.' .
            substr($this->document, 5, 3) . '/' .
            substr($this->document, 8, 4) . '-' .
            substr($this->document, 12);
    }

    public function getDocument(): string
    {
        return $this->document;
    }

    private function isDocument(): bool
    {
        $document = preg_replace('/[^0-9]/', '', $this->document);
        return strlen($document) === self::MAX_SIZE;
    }

    private function hasAllDigitsEquals(): bool
    {
        return preg_match('/(\d)\1{13}/', $this->document);
    }
}
