<?php

namespace App\Exports;

use Box\Spout\Writer\Common\Creator\WriterEntityFactory;

class LogsExport
{
    protected $logs;

    public function __construct($logs)
    {
        $this->logs = $logs;
    }

    public function export()
    {
        $writer = WriterEntityFactory::createXLSXWriter();
        $writer->openToFile('logs.xlsx');

        // Write header row
        $headerRow = WriterEntityFactory::createRowFromArray([
            'ID',
            'Username',
            'Item Name',
            'RME Quantity',
            'Gudang4 Quantity',
            'Gudang12 Quantity',
            'Total Quantity',
            'Reason',
            'Date & Time',
        ]);
        $writer->addRow($headerRow);

        // Write data rows
        foreach ($this->logs as $index => $log) {
            $rowData = [
                $index + 1,
                $log->user->username,
                $log->itemName,
                $log->rmeQuantity,
                $log->gudang4Quantity,
                $log->gudang12Quantity,
                $log->rmeQuantity + $log->gudang4Quantity + $log->gudang12Quantity,
                $log->reason,
                $log->created_at->format('d/m/Y H:i:s'),
            ];

            $row = WriterEntityFactory::createRowFromArray($rowData);
            $writer->addRow($row);
        }

        $writer->close();
    }
}
