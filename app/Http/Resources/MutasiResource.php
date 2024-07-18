<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MutasiResource extends JsonResource
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
            'ruangan_awal_id' => $this->ruangan_awal_id,
            'ruangan_tujuan_id' => $this->ruangan_tujuan_id,
            'ruangan_awal' => $this->ruanganAwal->nama_ruangan,
            'ruangan_tujuan' => $this->ruanganTujuan->nama_ruangan,
            'instansi_awal' => $this->instansi_awal,
            'instansi_tujuan' => $this->instansi_tujuan,
            'jenis_mutasi' => $this->jenis_mutasi,
            'tanggal_berlaku' => $this->tanggal_berlaku,
            'no_sk' => $this->no_sk,
            'tanggal_sk' => $this->tanggal_sk,
            'link_sk' => $this->link_sk,
        ];
    }
}
