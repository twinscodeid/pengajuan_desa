export type SuratIjinKegiatan = {
    nama: string,
    alamat: string,
    tanggal_kegiatan: string,
    tempat_kegiatan: string,
    no_hp: string,
    jenis_kelamin: string,
    tujuan_kegiatan: string
    image_pengantar_rt_rw: File[]
}

export type LaporanMasyarakat = {
    nama: string,
    jenis_kelamin: string,
    alamat: string,
    laporan: string
}

export type BantuanSosial = {
    nama: string,
    nik: string,
    tanggal_lahir: string,
    jenis_kelamin: string,
    status_perkawinan: string,
    agama: string,
    kewarganegaraan: string,
    alamat: string,
    pekerjaan: string,
    no_hp: string,
    image_pengantar_rt_rw: File[]
}
