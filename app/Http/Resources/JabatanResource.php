<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JabatanResource extends JsonResource
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
            'pegawai_id' => $this->pegawai_id,
            'ruanganawal_id' => $this->ruanganawal_id,
            'ruanganawal' => $this->ruanganawal->nama_ruangan,
            'ruanganbaru_id' => $this->ruanganbaru_id,
            'ruanganbaru' => $this->ruanganbaru->nama_ruangan,
            'jabatan_sebelumnya' => $this->jabatan_sebelumnya,
            'jabatan_selanjutnya' => $this->jabatan_selanjutnya,
            'tanggal_berlaku' => $this->tanggal_berlaku,
            'no_sk' => $this->no_sk,
            'tanggal_sk' => $this->tanggal_sk,
            'link_sk' => $this->link_sk,
            'type' => $this->type,
        ];
    }
}
