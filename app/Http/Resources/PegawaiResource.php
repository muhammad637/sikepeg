<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PegawaiResource extends JsonResource
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
            'nik' => $this->nik,
            'nip_nippk' => $this->nip_nippk,
            'gelar_depan' => $this->gelar_depan,
            'gelar_belakang' => $this->gelar_belakang,
            'nama_depan' => $this->nama_depan,
            'nama_belakang' => $this->nama_belakang,
            'nama_lengkap' => $this->nama_lengkap,
            'jenis_kelamin' => $this->jenis_kelamin,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir,
            'alamat' => $this->alamat,
            'usia' => $this->usia,
            'agama' => $this->agama,
            'no_wa' => $this->no_wa,
            'status_pegawai' => $this->status_pegawai,
            'ruangan_id' => $this->ruangan_id,
            'ruangan' => $this->ruangan->nama_ruangan,
            'tahun_pensiun' => $this->tahun_pensiun,
            'pendidikan_terakhir' => $this->pendidikan_terakhir,
            'tanggal_lulus' => $this->tanggal_lulus,
            'no_ijazah' => $this->no_ijazah,
            'jabatan' => $this->jabatan,
            'cuti_tahunan' => $this->cuti_tahunan,
            'tahun_cuti' => $this->tahun_cuti,
            'sisa_cuti_tahunan' => $this->sisa_cuti_tahunan,
            'masa_kerja' => $this->masa_kerja,
            'status_tenaga' => $this->status_tenaga,
            'status_tipe' => $this->status_tipe,
            'tmt_cpns' => $this->tmt_cpns,
            'tmt_pns' => $this->tmt_pns,
            'tmt_pppk' => $this->tmt_pppk,
            'tmt_pangkat_terakhir' => $this->tmt_pangkat_terakhir,
            'pangkat_golongan_id' => $this->pangkat_golongan_id,
            'sekolah' => $this->sekolah,
            'jenis_tenaga' => $this->jenis_tenaga,
            'niPtt_pkThl' => $this->niPtt_pkThl,
            'tanggal_masuk' => $this->tanggal_masuk,
            'no_karpeg' => $this->no_karpeg,
            'no_taspen' => $this->no_taspen,
            'no_npwp' => $this->no_npwp,
            'no_hp' => $this->no_hp,
            'email' => $this->email,
            'pelatihan' => $this->pelatihan,
            'password' => $this->password,
            'status_nonaktif' => $this->status_nonaktif
        ];
    }
}
