<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class CutiResource extends JsonResource
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
            'jenis_cuti' => $this->jenis_cuti,
            'alasan_cuti' => $this->alasan_cuti,
            'mulai_cuti' => Carbon::parse($this->mulai_cuti)->format('Y/m/d'),
            'selesai_cuti' => Carbon::parse($this->selesai_cuti)->format('Y/m/d'),
            'no_hp' => $this->no_hp,
            'alamat' => $this->alamat,
            'jumlah_hari' => $this->jumlah_hari,
            'link_cuti' => $this->link_cuti,
            'status_cuti' => $this->status_cuti ?? 'pending',
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
