<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../asset/css/style.css">
    <link rel="stylesheet" href="../asset/css/bootstrap.min.css">
    <title>Store Sphere Inc.</title>
</head>

<body>
    <section class="register_section">
        <div class="register">
            <div class="register-page">
                <div class="register-form">
                    <h2 class="text-center">Sign Up</h2>
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="inputBox">
                                    <label>NIM</label>
                                    <input type="number" class="form-control" name="nim" id="nim"
                                        placeholder="1234567890">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="inputBox">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" name="nama" id="nama"
                                        placeholder="Nama Lengkap">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="inputBox">
                                    <label>E-Mail</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="example@gmail.com">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="inputBox">
                                    <label>Nomor HP</label>
                                    <input type="number" class="form-control" name="no-hp" id="no-hp"
                                        placeholder="081912324532">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="inputBox">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" format="yyyy-mm-dd" class="form-control" name="tanggal-lahir"
                                        id="tanggal-lahir" placeholder="yyyy/mm/dd">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="inputBox">
                                    <label>Jenis Kelamin</label>
                                    <select class="form-select" id="gender">
                                        <option selected disabled>Jenis Kelamin</option>
                                        <option>Laki - Laki</option>
                                        <option>Perempuan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="inputBox">
                                    <label>Provinsi Sekolah</label>
                                    <input type="text" class="form-control" name="provinsi-sekolah"
                                        id="provinsi-sekolah" placeholder="DKI Jakarta">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="inputBox">
                                    <label>Line ID</label>
                                    <input type="text" class="form-control" name="lineID" id="lineID"
                                        placeholder="@example">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="inputBox">
                                    <label>Pendidikan Terakhir</label>
                                    <input type="text" class="form-control" name="pendidikan" id="pendidikan"
                                        placeholder="SMA">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="inputBox">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="password" id="password"
                                        placeholder="Password">
                                </div>
                            </div>
                        </div>
                        <div class="submit">
                            <button type="submit" class="btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>