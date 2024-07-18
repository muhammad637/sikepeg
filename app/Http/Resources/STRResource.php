<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class STRResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'pegawai_id' => $this->pegawai_id,
            'no_sip' => $this->no_sip,
            'no_str' => $this->no_str,
            'kompetensi' => $this->kompetensi,
            'no_sertikom' => $this->no_sertikom,
            'penerbit_str' => $this->penerbit_str,
            'tanggal_terbit_str' => $this->tanggal_terbit_str,
            'masa_berakhir_str' => $this->masa_berakhir_str,
            'link_str' => $this->link_str,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];

    }
}
