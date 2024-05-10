<?php

namespace App\Exports;

use Box\Spout\Writer\Common\Creator\WriterEntityFactory;

class InventoryExport
{
    protected $inventory;

    public function __construct($inventory)
    {
        $this->inventory = $inventory;
    }

    public function export()
    {
        $writer = WriterEntityFactory::createXLSXWriter();
        $writer->openToFile('inventory.xlsx');

        // Write header row
        $headerRow = WriterEntityFactory::createRowFromArray([
            'ID',
            'Item Name',
            'Specification',
            'RME Quantity',
            'Gudang4 Quantity',
            'Gudang12 Quantity',
            'Description',
            'Stock',
            'Visible',
            'Barcode',
        ]);
        $writer->addRow($headerRow);

        // Write data rows
        foreach ($this->inventory as $item) {
            $rowData = [
                $item->id,
                $item->itemName,
                $item->specification,
                $item->rmeQuantity,
                $item->gudang4Quantity,
                $item->gudang12Quantity,
                $item->description,
                $item->stock,
                $item->visible,
                $item->barcode,
            ];

            $row = WriterEntityFactory::createRowFromArray($rowData);
            $writer->addRow($row);
        }

        $writer->close();
    }
}
