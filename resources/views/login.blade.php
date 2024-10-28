{{-- ================================ --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LSP-ERAPORT</title>
</head>
<body>
    <br>
    <center>
        <form action="/login-walas" method="POST">
            @csrf
            <table>
                <tr align="center">
                    <td colspan="3">LOGIN WALAS</td>
                </tr>
                <tr>
                    <td>NIG</td>
                    <td>:</td>
                    <td><input type="text" name="txt_nig" id=""></td>
                </tr>
                <tr>
                    <td>PASSWORD</td>
                    <td>:</td>
                    <td><input type="password" name="txt_pass" id=""></td>
                </tr>
                <tr>
                    <td colspan="3" align="center">
                        <button type="submit" name="button">LOGIN WALAS</button>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        {{ session('error') }}
                    </td>
                </tr>
            </table>
        </form>

        <br>
        <form action="/login-siswa" method="POST">
            @csrf
            <table>
                <tr align="center">
                    <td colspan="3">LOGIN STUDENT</td>
                </tr>
                <tr>
                    <td>NIS</td>
                    <td>:</td>
                    <td><input type="text" name="txt_nis" id=""></td>
                </tr>
                <tr>
                    <td>PASSWORD</td>
                    <td>:</td>
                    <td><input type="password" name="txt_pass" id=""></td>
                </tr>
                <tr>
                    <td colspan="3" align="center">
                        <button type="submit" name="button">LOGIN SISWA</button>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        {{ session('error') }}
                    </td>
                </tr>
            </table>
        </form>
    </center>
</body>
</html>