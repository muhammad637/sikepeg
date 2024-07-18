<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KenaikanPangkatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'pegawai_id' => $this->pegawai_id,
            'pangkat_golongan_id' => $this->pangkat_golongan_id,
            'pangkat_golongan_id' => $this->pangkatGolongan->nama,
            'pangkat_golongan_sebelumnya_id' => $this->pangkat_golongan_sebelumnya_id,
            'pangkat_golongan_sebelumnya' => $this->pangkat_golonganSebelumnya->nama,
            'ruangan_id' => $this->ruangan_id,
            'ruangan' => $this->ruangan->nama_ruangan,
            'tmt_sebelumnya' => $this->tmt_sebelumnya,
            'tmt_pangkat_dari' => $this->tmt_pangkat_dari,
            'tmt_pangkat_sampai' => $this->tmt_pangkat_sampai,
            'no_sk' => $this->no_sk,
            'tanggal_sk' => $this->tanggal_sk,
            'penerbit_sk' => $this->penerbit_sk,
            'link_sk' => $this->link_sk,
            'status_tipe' => $this->status_tipe,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
