<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <div class="mt-5 mb-4">
        <div class="row gap-5">
            <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                <label for="" class="form-label">
                    <p class="mb-0 mt-md-2 mt-0">Status Tenaga</p>
                </label>
            </div>
            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                <select name="status_tenaga" id="" wire:model='status_tenaga'
                    class="form-control @error('status_tenaga') is-invalid @enderror">
                    <option value="">Pilih</option>
                    <option value="asn" {{ $status_tenaga == 'asn' ? 'selected' : '' }}>ASN</option>
                    <option value="non asn" {{ $status_tenaga == 'non asn' ? 'selected' : '' }}>Non ASN</option>
                </select>
            </div>
        </div>
    </div>
    @if ($status_tenaga == 'non asn')
        <div class="mb-4">
            <div class="row gap-5">
                <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                    <label for="" class="form-label">
                        <p class="mb-0 mt-md-2 mt-0">Tipe Non Asn</p>
                    </label>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                    <input type="text" class="form-control @error('niPtt_pkThl') is-invalid @enderror text-uppercase"
                        id="" aria-describedby="" name="status_tipe" autocomplete="false"
                        wire:model='status_tenaga' readonly>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <div class="row gap-5">
                <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                    <label for="" class="form-label">
                        <p class="mb-0 mt-md-2 mt-0">NI PTT-PK/THL</p>
                    </label>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                    <input type="text" class="form-control @error('niPtt_pkThl') is-invalid @enderror "
                        id="niPtt_pkThl" aria-describedby="niPtt_pkThl" name="niPtt_pkThl" autocomplete="false"
                        placeholder="Masukkan NI PTT-PK/THL" wire:model='niPtt_pkThl' required>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <div class="row gap-5">
                <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                    <label for="" class="form-label">
                        <p class="mb-0 mt-md-2 mt-0">Pendidikan Terakhir</p>
                    </label>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                    <input type="text" class="form-control @error('pendidikan_terakhir') is-invalid @enderror "
                        id="pendidikan_terakhir" aria-describedby="pendidikan_terakhir" name="pendidikan_terakhir"
                        autocomplete="false" placeholder="Masukkan Pendidikan Terakhir"
                        wire:model='pendidikan_terakhir' required>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <div class="row gap-5">
                <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                    <label for="" class="form-label">
                        <p class="mb-0 mt-md-2 mt-0">Tanggal Lulus</p>
                    </label>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                    <input type="date" class="form-control @error('tanggal_lulus') is-invalid @enderror "
                        id="tanggal_lulus" aria-describedby="tanggal_lulus" name="tanggal_lulus" autocomplete="false"
                        placeholder="Masukkan Tanggal Lulus" wire:model='tanggal_lulus' required>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <div class="row gap-5">
                <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                    <label for="" class="form-label">
                        <p class="mb-0 mt-md-2 mt-0">No Ijazah</p>
                    </label>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                    <input type="text" class="form-control @error('no_ijazah') is-invalid @enderror " id="no_ijazah"
                        aria-describedby="no_ijazah" name="no_ijazah" autocomplete="false"
                        placeholder="Masukkan No Ijazah" wire:model='no_ijazah' required>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <div class="row gap-5">
                <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                    <label for="" class="form-label">
                        <p class="mb-0 mt-md-2 mt-0">Jabatan</p>
                    </label>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                    <input type="text" class="form-control @error('jabatan') is-invalid @enderror " id="jabatan"
                        aria-describedby="jabatan" name="jabatan" autocomplete="false"
                        placeholder="Masukkan Jabatan ..." wire:model='jabatan' required>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <div class="row gap-5">
                <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                    <label for="" class="form-label">
                        <p class="mb-0 mt-md-2 mt-0">Tanggal Masuk</p>
                    </label>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                    <input type="date" class="form-control @error('tanggal_masuk') is-invalid @enderror "
                        id="tanggal_masuk" aria-describedby="tanggal_masuk" name="tanggal_masuk"
                        autocomplete="false" placeholder="Masukkan Tanggal Masuk ..." wire:model='tanggal_masuk' required>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <div class="row gap-5">
                <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                    <label for="" class="form-label">
                        <p class="mb-0 mt-md-2 mt-0">Izin Dalam Satu Tahun</p>
                    </label>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                    <input type="number" class="form-control @error('cuti_tahunan') is-invalid @enderror "
                        id="cuti_tahunan" aria-describedby="cuti_tahunan" name="cuti_tahunan" autocomplete="false"
                        placeholder="Masukkan izin dalam satu tahun" wire:model='cuti_tahunan' required>
                </div>
            </div>
        </div>
    @elseif($status_tenaga == 'asn')
        <div class="mb-4">
            <div class="row gap-5">
                <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                    <label for="" class="form-label">
                        <p class="mb-0 mt-md-2 mt-0">Tipe ASN</p>
                    </label>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                    <select name="status_tipe" wire:model='status_tipe' id=""
                        class="form-control @error('status_tipe')  @enderror" required>
                        <option value=""> Pilih</option>
                        <option value="pns" {{ $status_tipe == 'pns' ? 'selected' : '' }}> PNS</option>
                        <option value="pppk" {{ $status_tipe == 'pppk' ? 'selected' : '' }}> PPPK</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <div class="row gap-5">
                <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                    <label for="" class="form-label">
                        <p class="mb-0 mt-md-2 mt-0">TMT CPNS</p>
                    </label>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                    <input type="date" class="form-control @error('tmt_cpns') is-invalid @enderror "
                        id="tmt_cpns" aria-describedby="tmt_cpns" name="tmt_cpns" autocomplete="false"
                        placeholder="Masukkan TMT CPNS ..." wire:model='tmt_cpns' required>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <div class="row gap-5">
                <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                    <label for="" class="form-label">
                        <p class="mb-0 mt-md-2 mt-0">TMT PNS</p>
                    </label>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                    <input type="date" class="form-control @error('tmt_pns') is-invalid @enderror "
                        id="tmt_pns" aria-describedby="tmt_pns" name="tmt_pns" autocomplete="false"
                        placeholder="Masukkan TMT CPNS ..." wire:model='tmt_pns' required>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <div class="row gap-5">
                <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                    <label for="" class="form-label">
                        <p class="mb-0 mt-md-2 mt-0">TMT Pangakt Terakhir</p>
                    </label>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                    <input type="date" class="form-control @error('tmt_pangkat_terakhir') is-invalid @enderror "
                        id="tmt_pangkat_terakhir" aria-describedby="tmt_pangkat_terakhir" name="tmt_pangkat_terakhir"
                        autocomplete="false" placeholder="Masukkan TMT Pangkat Terakhir ..."
                        wire:model='tmt_pangkat_terakhir' required>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <div class="row gap-5">
                <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                    <label for="" class="form-label">
                        <p class="mb-0 mt-md-2 mt-0">Pangkat / Golongan</p>
                    </label>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                    <input type="text" class="form-control @error('pangkat_golongan') is-invalid @enderror "
                        id="pangkat_golongan" aria-describedby="pangkat_golongan" name="pangkat_golongan"
                        autocomplete="false" placeholder="Masukkan Pangkat Golongan ..."
                        wire:model='pangkat_golongan' required>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <div class="row gap-5">
                <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                    <label for="" class="form-label">
                        <p class="mb-0 mt-md-2 mt-0">Pendidikan Sesuai SK Terakhir</p>
                    </label>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                    <input type="text" class="form-control @error('pendidikan_terakhir') is-invalid @enderror "
                        id="pendidikan_terakhir" aria-describedby="pendidikan_terakhir" name="pendidikan_terakhir"
                        autocomplete="false" placeholder="Masukkan pendidikan Terakhir ..."
                        wire:model='pendidikan_terakhir' required>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <div class="row gap-5">
                <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                    <label for="" class="form-label">
                        <p class="mb-0 mt-md-2 mt-0">Sekolah / Perguruan Tinggi</p>
                    </label>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                    <input type="text" class="form-control @error('sekolah') is-invalid @enderror "
                        id="sekolah" aria-describedby="sekolah" name="sekolah" autocomplete="false"
                        placeholder="Masukkan Sekolah / Perguruan Tinggi ...." wire:model='sekolah' required>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <div class="row gap-5">
                <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                    <label for="" class="form-label">
                        <p class="mb-0 mt-md-2 mt-0">Tanggal Lulus</p>
                    </label>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                    <input type="date" class="form-control @error('tanggal_lulus') is-invalid @enderror "
                        id="tanggal_lulus" aria-describedby="tanggal_lulus" name="tanggal_lulus"
                        autocomplete="false" placeholder="Masukkan Tanggal Lulus" wire:model='tanggal_lulus' required>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <div class="row gap-5">
                <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                    <label for="" class="form-label">
                        <p class="mb-0 mt-md-2 mt-0">No Ijazah</p>
                    </label>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                    <input type="text" class="form-control @error('no_ijazah') is-invalid @enderror "
                        id="no_ijazah" aria-describedby="no_ijazah" name="no_ijazah" autocomplete="false"
                        placeholder="Masukkan No Ijazah ...." wire:model='no_ijazah' required>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <div class="row gap-5">
                <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                    <label for="" class="form-label">
                        <p class="mb-0 mt-md-2 mt-0">Jenis Tenaga</p>
                    </label>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                    <select name="jenis_tenaga" id="" wire:model='jenis_tenaga'
                        class="form-control @error('jenis_tenaga') is-invalid @enderror" required>
                        <option value="">Pilih</option>
                        <option value="struktural" {{ $jenis_tenaga == 'struktural' ? 'selected' : '' }}>Struktural
                        </option>
                        <option value="nakes" {{ $jenis_tenaga == 'nakes' ? 'selected' : '' }}>Fungsional / nakes
                        </option>
                        <option value="umum" {{ $jenis_tenaga == 'umum' ? 'selected' : '' }}>Umum / administrasi
                        </option>
                    </select>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <div class="row gap-5">
                <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                    <label for="" class="form-label">
                        <p class="mb-0 mt-md-2 mt-0">Jabatan</p>
                    </label>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                    <input type="text" class="form-control @error('jabatan') is-invalid @enderror "
                        id="jabatan" aria-describedby="jabatan" name="jabatan" autocomplete="false"
                        placeholder="Masukkan Jabatan ..." wire:model='jabatan'>
                </div>
            </div>
        </div>
        @if ($jenis_tenaga == 'nakes')
            <p class="text-success text-right">Note : kolom dibawah bisa di isi nanti di halaman str atau sip</p>
            <div class="mb-4">
                <div class="row gap-5">
                    <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                        <label for="" class="form-label">
                            <p class="mb-0 mt-md-2 mt-0">No STR</p>
                        </label>
                    </div>
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                        <input type="text" class="form-control @error('no_str') is-invalid @enderror "
                            id="no_str" aria-describedby="no_str" name="no_str" autocomplete="false"
                            placeholder="Masukkan No STR ..." wire:model='no_str'>
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <div class="row gap-5">
                    <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                        <label for="" class="form-label">
                            <p class="mb-0 mt-md-2 mt-0">Tanggal Terbit STR</p>
                        </label>
                    </div>
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                        <input type="date" class="form-control @error('tanggal_terbit_str') is-invalid @enderror "
                            id="tanggal_terbit_str" aria-describedby="tanggal_terbit_str" name="tanggal_terbit_str"
                            autocomplete="false" placeholder="Masukkan Tanggal Terbit STR ..."
                            wire:model='tanggal_terbit_str'>
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <div class="row gap-5">
                    <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                        <label for="" class="form-label">
                            <p class="mb-0 mt-md-2 mt-0">Masa Berlaku STR</p>
                        </label>
                    </div>
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                        <input type="date" class="form-control @error('masa_berakhir_str') is-invalid @enderror "
                            id="masa_berakhir_str" aria-describedby="masa_berakhir_str" name="masa_berakhir_str"
                            autocomplete="false" placeholder="Masukkan Masa Berlaku STR ..."
                            wire:model='masa_berakhir_str'>
                    </div>
                </div>
            </div>


            <div class="mb-4">
                <div class="row gap-5">
                    <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                        <label for="" class="form-label">
                            <p class="mb-0 mt-md-2 mt-0">No SIP</p>
                        </label>
                    </div>
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                        <input type="text" class="form-control @error('no_sip') is-invalid @enderror "
                            id="no_sip" aria-describedby="no_sip" name="no_sip" autocomplete="false"
                            placeholder="Masukkan No SIP ..." wire:model='no_sip'>
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <div class="row gap-5">
                    <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                        <label for="" class="form-label">
                            <p class="mb-0 mt-md-2 mt-0">Tanggal Terbit SIP</p>
                        </label>
                    </div>
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                        <input type="date" class="form-control @error('tanggal_terbit_sip') is-invalid @enderror "
                            id="tanggal_terbit_sip" aria-describedby="tanggal_terbit_sip" name="tanggal_terbit_sip"
                            autocomplete="false" placeholder="Masukkan Tanggal Terbit SIP ..."
                            wire:model='tanggal_terbit_sip'>
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <div class="row gap-5">
                    <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                        <label for="" class="form-label">
                            <p class="mb-0 mt-md-2 mt-0">Masa Berlaku SIP</p>
                        </label>
                    </div>
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                        <input type="date" class="form-control @error('masa_berlaku_sip') is-invalid @enderror "
                            id="masa_berlaku_sip" aria-describedby="masa_berlaku_sip" name="masa_berlaku_sip"
                            autocomplete="false" placeholder="Masukkan Masa berlaku SIP ..."
                            wire:model='masa_berlaku_sip'>
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <div class="row gap-5">
                    <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                        <label for="" class="form-label">
                            <p class="mb-0 mt-md-2 mt-0">Link Upload STR</p>
                        </label>
                    </div>
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                        <input type="text" class="form-control @error('link_str') is-invalid @enderror "
                            id="link_str" aria-describedby="link_str" name="link_str" autocomplete="false"
                            placeholder="Masukkan Link Upload STR" wire:model='link_str'>
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <div class="row gap-5">
                    <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                        <label for="" class="form-label">
                            <p class="mb-0 mt-md-2 mt-0">Link Upload SIP</p>
                        </label>
                    </div>
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                        <input type="text" class="form-control @error('link_sip') is-invalid @enderror "
                            id="link_sip" aria-describedby="link_sip" name="link_sip" autocomplete="false"
                            placeholder="Masukkan Link Upload SIP ..." wire:model='link_sip'>
                    </div>
                </div>
            </div>
        @elseif(old('jenis_tenaga', $jenis_tenaga) == 'umum')
        <div class="mb-4">
                <div class="row gap-5">
                    <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                        <label for="" class="form-label">
                            <p class="mb-0 mt-md-2 mt-0">Cuti Dalam Satu Tahun</p>
                        </label>
                    </div>
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                        <input type="number" class="form-control @error('cuti_tahunan') is-invalid @enderror "
                            id="cuti_tahunan" aria-describedby="cuti_tahunan" name="cuti_tahunan"
                            autocomplete="false" placeholder="Masukkan Cuti Dalam Satu Tahun"
                            wire:model='cuti_tahunan' required>
                    </div>
                </div>
            </div>
            <p class="text-success text-right">Note : kolom dibawah bisa di isi nanti</p>
            {{-- <div class="mb-4">
                <div class="row gap-5">
                    <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                        <label for="" class="form-label">
                            <p class="mb-0 mt-md-2 mt-0">Masa Kerja</p>
                        </label>
                    </div>
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                        <input type="text" class="form-control @error('masa_kerja') is-invalid @enderror "
                            id="masa_kerja" aria-describedby="masa_kerja" name="masa_kerja" autocomplete="false"
                            placeholder="Masukkan Masa Kerja ..." wire:model='masa_kerja'>
                    </div>
                </div>
            </div> --}}
            <div class="mb-4">
                <div class="row gap-5">
                    <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                        <label for="" class="form-label">
                            <p class="mb-0 mt-md-2 mt-0">No Karpeg</p>
                        </label>
                    </div>
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                        <input type="text" class="form-control @error('no_karpeg') is-invalid @enderror "
                            id="no_karpeg" aria-describedby="no_karpeg" name="no_karpeg" autocomplete="false"
                            placeholder="Masukkan No Karpeg ..." wire:model='no_karpeg'>
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <div class="row gap-5">
                    <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                        <label for="" class="form-label">
                            <p class="mb-0 mt-md-2 mt-0">No Taspen</p>
                        </label>
                    </div>
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                        <input type="text" class="form-control @error('no_taspen') is-invalid @enderror "
                            id="no_taspen" aria-describedby="no_taspen" name="no_taspen" autocomplete="false"
                            placeholder="Masukkan No Taspen ..." wire:model='no_taspen'>
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <div class="row gap-5">
                    <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                        <label for="" class="form-label">
                            <p class="mb-0 mt-md-2 mt-0">No NPWP</p>
                        </label>
                    </div>
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                        <input type="text" class="form-control @error('no_npwp') is-invalid @enderror "
                            id="no_npwp" aria-describedby="no_npwp" name="no_npwp" autocomplete="false"
                            placeholder="Masukkan No NPWP ..." wire:model='no_npwp'>
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <div class="row gap-5">
                    <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                        <label for="" class="form-label">
                            <p class="mb-0 mt-md-2 mt-0">No HP</p>
                        </label>
                    </div>
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                        <input type="text" class="form-control @error('no_hp') is-invalid @enderror "
                            id="no_hp" aria-describedby="no_hp" name="no_hp" autocomplete="false"
                            placeholder="Masukkan No HP ..." wire:model='no_hp'>
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <div class="row gap-5">
                    <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                        <label for="" class="form-label">
                            <p class="mb-0 mt-md-2 mt-0">Email</p>
                        </label>
                    </div>
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                        <input type="email" class="form-control @error('email') is-invalid @enderror "
                            id="email" aria-describedby="email" name="email" autocomplete="false"
                            placeholder="Masukkan Email ..." wire:model='email'>
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <div class="row gap-5">
                    <div class="col-md-5 col-sm-5 col-lg-5 col-xl-4">
                        <label for="" class="form-label">
                            <p class="mb-0 mt-md-2 mt-0">Pelatihan</p>
                        </label>
                    </div>
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-8">
                        <input type="text" class="form-control @error('pelatihan') is-invalid @enderror "
                            id="pelatihan" aria-describedby="pelatihan" name="pelatihan" autocomplete="false"
                            placeholder="Masukkan Pelatihan ..." wire:model='pelatihan'>
                    </div>
                </div>
            </div>
            
        @endif
    @endif

</div>
