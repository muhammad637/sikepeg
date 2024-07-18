<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DiklatResource extends JsonResource
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
        'ruangan_id' => $this->ruangan_id,
        'ruangan' => $this->ruangan->nama_ruangan,
        'nama_diklat' => $this->nama_diklat,
        'tanggal_mulai' => $this->tanggal_mulai,
        'tanggal_selesai' => $this->tanggal_selesai,
        'jumlah_hari' => $this->jumlah_hari,
        'jumlah_jam' => $this->jumlah_jam,
        'penyelenggara' => $this->penyelenggara,
        'tempat' => $this->tempat,
        'tahun' => $this->tahun,
        'no_sertifikat' => $this->no_sertifikat,
        'tanggal_sertifikat' => $this->tanggal_sertifikat,
        'link_sertifikat' => $this->link_sertifikat,
        'created_at' => $this->created_at,
        'updated_at' => $this->updated_at,
        ];
    }
}
