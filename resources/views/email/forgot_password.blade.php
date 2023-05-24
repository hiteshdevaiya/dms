@include('email.header')
<tbody>
    <tr>
        <td style="background: #fff;padding: 20px;font-weight: 700;font-size: 16px;color: #000;">Reset Password</td>
    </tr>
    <tr>
        <td style="background: #fff;padding:0 20px 5px;color: #000;">Hello <span>{{ucfirst($data->name)}},</span></td>
    </tr>
    <tr>
        <td style="background: #fff;padding:0 20px 0px;color: #000;">You are receiving this email because we received a password reset request for your account.</td>
    </tr>
    <tr>
        <td style="text-align: center;background: #fff; padding:20px 20px 20px;color: #000;">
            <table style="margin: auto;">
                <tbody>
                    <tr>
                        <td bgcolor="#000" style="text-align: center;cursor: pointer;">
                            <a href="{{$link ?? ''}}" style="text-decoration: none; color: #ffffff; border: 0;padding: 10px;display: inline-block;width: 130px;" border="0">Reset Password</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td style="background: #fff;padding:0 20px 5px;color: #000;">This password reset link will expire in 60 minutes.</td>
    </tr>
    <tr>
        <td style="background: #fff;padding:0 20px 20px;color: #000;">If you did not request a password reset, no further action is required.</td>
    </tr>
</tbody>
@include('email.footer')
