<?php

namespace Saleh7\Zatca;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

use DateTime;

class DocumentReference implements XmlSerializable
{
    private $id;
    private $uuid;
    private $issueDate;
    private $issueTime;
    private $invoiceType;


    /**
     * @param mixed $id
     * @return DocumentReference
     */
    public function setId(?string $id): DocumentReference
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param mixed $uuid
     * @return DocumentReference
     */
    public function setUUID(?string $uuid): DocumentReference
    {
        $this->uuid = $uuid;
        return $this;
    }

    /**
     * @param DateTime $issueDate
     * @return DocumentReference
     */
    public function setIssueDate(DateTime $issueDate): DocumentReference
    {
        $this->issueDate = $issueDate;
        return $this;
    }

    /**
     * @param DateTime $issueDate
     * @return DocumentReference
     */
    public function setIssueTime(DateTime $issueTime): DocumentReference
    {
        $this->issueTime = $issueTime;
        return $this;
    }

    /**
     * @param mixed $invoiceType
     * @return DocumentReference
     */
    public function setInvoiceType(?string $invoiceType): DocumentReference
    {
        $this->invoiceType = $invoiceType;
        return $this;
    }

    /**
     * The xmlSerialize method is called during xml writing.
     *
     * @param Writer $writer
     * @return void
     */
    public function xmlSerialize(Writer $writer): void
    {
        $invoiceTypeCode = InvoiceTypeCode::INVOICE_PREPAYMENT;

        // id
        if ($this->id !== null) {
            $writer->write([Schema::CBC . 'ID' => $this->id]);
        }
        // uuid
        if ($this->uuid !== null) {
            $writer->write([Schema::CBC . 'UUID' => $this->uuid]);
        }
        // issueDate
        if ($this->issueDate !== null) {
            $writer->write([Schema::CBC . 'IssueDate' => $this->issueDate->format('Y-m-d')]);
        }
        // issueTime
        if ($this->issueTime !== null) {
            $writer->write([Schema::CBC . 'IssueTime' => $this->issueTime->format('H:i:s')]);
        }
        // documentTypeCode
        if ($this->invoiceType !== null) {
            $writer->write([Schema::CBC . 'DocumentTypeCode' => $invoiceTypeCode]);
        }
    }
}
