<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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
            'pangkat_golongan' => $this->pangkatGolongan ? $this->pangkatGolongan->nama : 'testing',
            'pangkat_golongan_sebelumnya_id' => $this->pangkat_golongan_sebelumnya_id,
            'pangkat_golongan_sebelumnya' => $this->pangkat_golonganSebelumnya ? $this->pangkat_golonganSebelumnya->nama : 'testing',
            'ruangan_id' => $this->ruangan_id,
            'ruangan' => $this->ruangan ? $this->ruangan->nama_ruangan : null,
            'tmt_sebelumnya' => $this->tmt_sebelumnya,
            'tmt_pangkat_dari' => Carbon::parse($this->tmt_pangkat_dari)->format('d-m-Y') ,
            'tmt_pangkat_sampai' => Carbon::parse($this->tmt_pangkat_sampai)->format('d-m-Y'),
            'no_sk' => $this->no_sk,
            'tanggal_sk' => Carbon::parse($this->tanggal_sk)->format('d-m-Y') ,
            'penerbit_sk' => $this->penerbit_sk,
            'link_sk' => $this->link_sk,
            'status_tipe' => $this->status_tipe,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

}
