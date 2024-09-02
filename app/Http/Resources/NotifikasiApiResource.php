<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class NotifikasiApiResource extends JsonResource
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
            'pesan' => $this->pesan,
            'jenis_notifikasi' => $this->jenis_notifikasi,
            'waktu' => Carbon::parse($this->created_at)->format('d/m/Y h:i:s'),
            // 'sip
           
        ];
    }
}
