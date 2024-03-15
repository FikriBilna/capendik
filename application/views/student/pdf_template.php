<!DOCTYPE html>
<html lang="en">

<head>
    <title>Rapor <?= $student['firstname'] ?></title>
    <style>
        .title {
            background-color: #BBC3A4;
            color: white;
            padding: 10px;
            width: max-content;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 5px;
        }

        h2 {
            margin: 0;
            color: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        #student {
            border-collapse: collapse;
            border: none;
        }

        #student td {
            border: none;
            background-color: #ffff;
            padding: 3;
            justify-content: left;
            font-weight: normal;
        }

        #student th {
            border: none;
            background-color: #ffff;
            padding: 3;
        }

        th,
        td {
            padding: 0.5rem;
            border: 1px solid #ccc;
            font-weight: bold;
        }

        th {
            background-color: #F2EFE5;
            text-align: center;
            color: black;
            font-weight: bold;
        }

        .competencies {
            margin-top: 2rem;
        }

        .signatures {
            margin-top: 3rem;
            display: flex;
            justify-content: space-between;
            border-top: 1px solid #ccc;
            padding-top: 1rem;
        }

        .row {
            display: flex;
        }

        .column {
            flex: 50%;
        }

        .column table {
            border: none;
        }

        #button-pdf {
            background-color: red;
            color: white;
            border: none;
            border-radius: 8px;
            margin-bottom: 10px;
            padding: 10px;
            cursor: pointer;
        }

        #button-back {
            background-color: rgb(179, 3, 233);
            color: white;
            border: none;
            border-radius: 8px;
            margin-bottom: 10px;
            padding: 9px;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <button onclick="generate()" id="button-pdf">Print PDF</button>
    <a href="<?php base_url('admin/nilairapor/generateRapor/' . $student['id']) ?>" id="button-back">Back</a>
    <div id="isi">
        <div class="title">
            <h2>Format Laporan Hasil Belajar (Rapor)</h2>
        </div>
        <div class="row">
            <div class="column">
                <table id="student">
                    <tbody>
                        <tr>
                            <td><strong>Nama Peserta Didik</strong></td>
                            <td>:</td>
                            <td><?= $student['firstname'] ?></td>
                        </tr>
                        <tr>
                            <td><strong>NISN</strong></td>
                            <td>:</td>
                            <td><?= $student['nisn'] ?></td>
                        </tr>
                        <tr>
                            <td><strong>Sekolah</strong></td>
                            <td>:</td>
                            <td>SD Cerdas Berkarakter</td>
                        </tr>
                        <tr>
                            <td><strong>Alamat</strong></td>
                            <td>:</td>
                            <td><?= $student['current_address'] ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="column">
                <table id="student">
                    <tbody>
                        <tr>
                            <td><strong>Kelas</strong></td>
                            <td>:</td>
                            <td><?= $student['class'] ?></td>
                        </tr>
                        <tr>
                            <td><strong>Fase</strong></td>
                            <td>:</td>
                            <td><?= $student['section'] ?></td>
                        </tr>
                        <tr>
                            <td><strong>Semester</strong></td>
                            <td>:</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td><strong>Tahun Ajaran</strong></td>
                            <td>:</td>
                            <td><?= $session ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th width="30%">Mata Pelajran</th>
                    <th>Nilai Akhir</th>
                    <th>Capaian Kompetensi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($listRapor as $list) { ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= $list['subjectName'] ?></td>
                        <td><?= $list['nilai_rapor'] ?></td>
                        <td><?= $list['deskripsi'] ?></td>
                    </tr>
                <?php $no++;
                } ?>
            </tbody>
        </table>
        <table>
            <thead>
                <tr>
                    <th width="2%">No</th>
                    <th width="30%">Ekstrakulikuler</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($listEkskul as $list) { ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= $list['ekskul_name'] ?></td>
                        <td><?= $list['ket'] ?></td>
                    </tr>
                <?php $no++;
                } ?>
            </tbody>
        </table>
        <div class="row">
            <div class="column">
                <table>
                    <thead>
                        <tr>
                            <th colspan="2" style="text-align: center;">Ketidakhadiran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Sakit</td>
                            <td>..hari</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="column">
                <center>
                    <h5>Tempat, Tanggal Rapor</h5>
                </center>
            </div>
        </div>
        <div class="row">
            <div class="column">
                <center>
                    <h5>TTD Orang Tua Peserta Didik</h5>
                </center>
            </div>
            <div class="column">
                <center>
                    <h5>TTD Wali Kelas</h5>
                </center>
            </div>
        </div>
        <center>
            <h5>TTD Kepala Sekolah</h5>
        </center>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.js"></script>


    <script>
        function generate() {
            var element = document.getElementById('isi');
            console.log(element);

            html2pdf(element, {
                    margin: 5,
                    filename: '<?php echo $student['firstname'] ?>-rapor.pdf',
                    image: {
                        type: 'jpeg',
                        quality: 0.98
                    },
                    html2canvas: {
                        scale: 2
                    }
                })
                .from(element)
                .outputPdf();
        }
    </script>
</body>

</html>