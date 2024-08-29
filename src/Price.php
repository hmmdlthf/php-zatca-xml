<?php
namespace Saleh7\Zatca;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

class Price implements XmlSerializable
{
    private $priceAmount;
    private $baseQuantity;
    private $allowanceCharges;
    private $unitCode = UnitCode::UNIT;

    /**
     * @param float $priceAmount
     * @return Price
     */
    public function setPriceAmount(?float $priceAmount): Price
    {
        $this->priceAmount = $priceAmount;
        return $this;
    }

    /**
     * @param float $baseQuantity
     * @return Price
     */
    public function setBaseQuantity(?float $baseQuantity): Price
    {
        $this->baseQuantity = $baseQuantity;
        return $this;
    }

    /**
     * @param string $unitCode
     * See also: src/UnitCode.php
     * @return Price
     */
    public function setUnitCode(?string $unitCode): Price
    {
        $this->unitCode = $unitCode;
        return $this;
    }

    /**
     * @return AllowanceCharge[]
     */
    public function getAllowanceCharges(): ?array
    {
        return $this->allowanceCharges;
    }

    /**
     * @param AllowanceCharge[] $allowanceCharges
     * @return Price
     */
    public function setAllowanceCharges(?array $allowanceCharges): Price
    {
        $this->allowanceCharges = $allowanceCharges;
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
        $writer->write([
            [
                'name' => Schema::CBC . 'PriceAmount',
                'value' => number_format($this->priceAmount, 4, '.', ''),
                'attributes' => [
                    'currencyID' => GeneratorInvoice::$currencyID
                ]
            ],
        ]);
        if ($this->baseQuantity !== null) {
            $writer->write(
                [
                    'name' => Schema::CBC . 'BaseQuantity',
                    'value' => number_format($this->baseQuantity, 4, '.', ''),
                    'attributes' => [
                        'unitCode' => $this->unitCode
                    ]
                ]
            );
        }
        // AllowanceCharge
        if ($this->allowanceCharges !== null) {
            foreach ($this->allowanceCharges as $allowanceCharge) {
                $writer->write([
                    Schema::CAC . 'AllowanceCharge' => $allowanceCharge
                ]);
            }
        }
    }
}
