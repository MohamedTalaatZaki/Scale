<?php

namespace App\Exports;

class TestedTruckExport extends AbstractProjectExport
{

    protected $data;
    protected $headings;

    public function __construct($data)
    {
        $this->data = $data;
        $this->headings= array_keys((array)$this->data[0]);

    }
    public function collection()
    {
        
        $data=[];
        foreach ($this->data as $el) {
            $truck=[];
            foreach ($this->headings as $header) {
                $truck[]=$el->$header;
            }
            $data[]=$truck;
        }
        return collect($data);
    }

    public function map($data): array
    {
        return $data;
    }

    public function get_headers()
    {
        return $this->headings;
    }

}
