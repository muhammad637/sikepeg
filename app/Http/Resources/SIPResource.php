<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SIPResource extends JsonResource
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
        'no_str' => $this->no_str,
        'no_sip' => $this->no_sip,
        'no_rekomendasi' => $this->no_rekomendasi,
        'penerbit_sip' => $this->penerbit_sip,
        'tanggal_terbit_sip' => $this->tanggal_terbit_sip,
        'masa_berakhir_sip' => $this->masa_berakhir_sip,
        'tempat_praktik' => $this->tempat_praktik,
        'link_sip' => $this->link_sip,
        'alamat_sip' => $this->alamat_sip,
        'created_at' => $this->created_at,
        'updated_at' => $this->updated_at,
    ];
    }
}
